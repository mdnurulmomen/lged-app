<?php

namespace App\Http\Controllers\AuditReport;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuditQACTwoReportController extends Controller
{
    public function downloadAuditReport(Request $request)
    {
        ini_set("pcre.backtrack_limit", "999999999999");
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 0);

        $scope = $request->scope ?: 'apotti_air';
        $porisistos_html = [];

        if ($scope != 'apotti_air') {
            $apottis = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_report.air.get-air-wise-porisistos'),
                [
                    'air_id' => $request->air_id,
                    'air_type' => 'qac-2',
                    'cdesk' => $this->current_desk_json()
                ])->json();
            $porisishto_counter = 1;
            if (isSuccess($apottis)) {
                foreach ($apottis['data'] as $apotti) {
                    $onucched_no = $apotti['onucched_no'];
                    foreach ($apotti['apotti_porisishtos'] as $porisishto) {
                        if ($porisishto['porisishto_type'] == 'summary'){
                            $porisistos_html[] = '<span>অনুচ্ছেদ নম্বর-'.enTobn($onucched_no).'</span>'.$porisishto['details'];
                        }else{
                            $porishisto_no = count($apotti['apotti_porisishtos'])>1?enTobn($onucched_no).'.'.enTobn($porisishto_counter):enTobn($onucched_no);
                            $porisistos_html[] = '<span>পরিশিষ্ট নম্বর-'.$porishisto_no.'</span><br><span>অনুচ্ছেদ নম্বর-'.enTobn($onucched_no).'</span>'.$porisishto['details'];
                            $porisishto_counter++;
                        }
                    }
                    $porisishto_counter = 1;
                }
            } else {
                $porisistos_html = [];
            }
        }
        $auditReport = $request->air_description;

        if ($scope == 'apotti_air') {
            $pdf = \PDF::loadView(
                'modules.audit_quality_control.qac_02.books.book_qac2_apotti_air',
                ['auditReport' => $auditReport],
                [],
                ['orientation' => 'P', 'format' => 'A4']
            );
            $fileName = 'QAC2 Report ' . date('D_M_j_Y') . '.pdf';
            return $pdf->stream($fileName);
        } elseif ($scope == 'porishisto_air') {
            $pdf = \PDF::loadView(
                'modules.audit_quality_control.qac_02.books.book_porishisto_air',
                ['porisistos' => $porisistos_html, 'auditReport' => $auditReport],
                [],
                ['orientation' => 'P', 'format' => 'A4']
            );
            $fileName = 'QAC2 Report ' . date('D_M_j_Y') . '.pdf';
            return $pdf->stream($fileName);
        } elseif ($scope == 'full_air') {
            $pdf = \PDF::loadView(
                'modules.audit_quality_control.qac_02.books.book_qac2_full_air',
                ['porisistos' => $porisistos_html, 'auditReport' => $auditReport],
                [],
                ['orientation' => 'P', 'format' => 'A4']
            );
            $fileName = 'QAC2 Report ' . date('D_M_j_Y') . '.pdf';
            return $pdf->stream($fileName);
        }
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function downloadAuditReportOld(Request $request)
    {
        $auditReport = $request->air_description;
        $coverPage = $auditReport[0];
        $indexPage = $auditReport[1];
        $partOneCoverPage = $auditReport[2];
        $inductionPage = $auditReport[3];
        $chapterOneCoverPage = $auditReport[4];
        $executiveSummaryPage = $auditReport[11];
        $abbreviationOfWordPage = $auditReport[12];
        $chapterTwoCoverPage = $auditReport[13];
        $auditOnnuchedSumaryPage = $auditReport[14];
        $auditOnnuchedDetailsCoverPage = $auditReport[15];
        $auditOnnuchedDetailsPage = $auditReport[16];
        $partTwoCoverPage = $auditReport[17];
        $appendicesCoverPage = $auditReport[18];
        $appendicesDetailsPage = $auditReport[19];

        unset($auditReport[0], $auditReport[1], $auditReport[2], $auditReport[3], $auditReport[4], $auditReport[11],
            $auditReport[12],$auditReport[13],$auditReport[14],$auditReport[15],$auditReport[16],
            $auditReport[17],$auditReport[18],$auditReport[19]);

        $pdf = \PDF::loadView('modules.audit_quality_control.qac_02.partials.audit_report_book',
            [
                'coverPage' => $coverPage,
                'indexPage' => $indexPage,
                'partOneCoverPage' => $partOneCoverPage,
                'inductionPage' => $inductionPage,
                'chapterOneCoverPage' => $chapterOneCoverPage,
                'executiveSummaryPage' => $executiveSummaryPage,
                'abbreviationOfWordPage' => $abbreviationOfWordPage,
                'chapterTwoCoverPage' => $chapterTwoCoverPage,
                'auditOnnuchedSumaryPage' => $auditOnnuchedSumaryPage,
                'auditOnnuchedDetailsCoverPage' => $auditOnnuchedDetailsCoverPage,
                'auditOnnuchedDetailsPage' => $auditOnnuchedDetailsPage,
                'partTwoCoverPage' => $partTwoCoverPage,
                'appendicesCoverPage' => $appendicesCoverPage,
                'appendicesDetailsPage' => $appendicesDetailsPage,
                'auditReport' => $auditReport,
            ], [] , ['orientation' => 'P', 'format' => 'A4']);

        $fileName = 'qac2_report_' . date('D_M_j_Y') . '.pdf';
        return $pdf->stream($fileName);
    }


    public function previewAuditReport(Request $request)
    {
        $airReports = $request->air_description;
        $cover = $airReports[0];
        array_shift($airReports);
        return view('modules.audit_quality_control.qac_02.partials.preview_audit_report',
            compact('airReports', 'cover'));
    }
}
