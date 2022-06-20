<?php

namespace App\Http\Controllers\AuditReport;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuditQACOneReportController extends Controller
{
    public function downloadAuditReport(Request $request)
    {
        ini_set("pcre.backtrack_limit", "999999999999");
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 0);

        /*$auditReport = $request->air_description;
        $pdf = \PDF::loadView('modules.audit_quality_control.qac_01.partials.audit_qac1_report_book',
            ['auditReport' => $auditReport], [] , ['orientation' => 'P', 'format' => 'A4']);

        $fileName = 'qac1_report_' . date('D_M_j_Y') . '.pdf';
        return $pdf->stream($fileName);*/

        $scope = $request->scope ?: 'apotti_air';
        $porisistos_html = [];

        if ($scope != 'apotti_air') {
            $apottis = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_report.air.get-air-wise-porisistos'), ['air_id' => $request->air_id, 'all' => '1', 'cdesk' => $this->current_desk_json()])->json();

            $porisishto_counter = 1;
            if (isSuccess($apottis)) {
                foreach ($apottis['data'] as $apotti) {
                    $onucched_no = $apotti['onucched_no'];
                    foreach ($apotti['apotti_porisishtos'] as $porisishto) {
                        $porishisto_no = count($apotti['apotti_porisishtos'])>1?enTobn($onucched_no).'.'.enTobn($porisishto_counter):enTobn($onucched_no);
                        $porisistos_html[] = '<span>পরিশিষ্ট নম্বর-'.$porishisto_no.'</span><br><span>অনুচ্ছেদ নম্বর-'.enTobn($onucched_no).'</span>'.$porisishto['details'];
                        $porisishto_counter++;
                    }
                    $porisishto_counter = 1;
                }
            } else {
                $porisistos_html = [];
            }
        }
        $auditReport = $request->air_description;

        if ($scope == 'forwarding_letter') {
            $pdf = \PDF::loadView(
                'modules.audit_quality_control.qac_01.books.book_forwarding_air',
                ['auditReport' => $auditReport],
                [],
                ['orientation' => 'P', 'format' => 'A4']
            );
            $fileName = 'QAC1 Report Forwarding' . date('D_M_j_Y') . '.pdf';
            return $pdf->stream($fileName);
        } elseif ($scope == 'apotti_air') {
            $pdf = \PDF::loadView(
                'modules.audit_quality_control.qac_01.books.book_qac1_apotti_air',
                ['auditReport' => $auditReport],
                [],
                ['orientation' => 'P', 'format' => 'A4']
            );
            $fileName = 'QAC1 Report ' . date('D_M_j_Y') . '.pdf';
            return $pdf->stream($fileName);
        } elseif ($scope == 'porishisto_air') {
            $pdf = \PDF::loadView(
                'modules.audit_quality_control.qac_01.books.book_porishisto_air',
                ['porisistos' => $porisistos_html, 'auditReport' => $auditReport],
                [],
                ['orientation' => 'P', 'format' => 'A4']
            );
            $fileName = 'QAC1 Report ' . date('D_M_j_Y') . '.pdf';
            return $pdf->stream($fileName);
        } elseif ($scope == 'full_air') {
            $pdf = \PDF::loadView(
                'modules.audit_quality_control.qac_01.books.book_qac1_air',
                ['porisistos' => $porisistos_html, 'auditReport' => $auditReport],
                [],
                ['orientation' => 'P', 'format' => 'A4']
            );
            $fileName = 'QAC1 Report ' . date('D_M_j_Y') . '.pdf';
            return $pdf->stream($fileName);
        }
    }


    public function previewAuditReport(Request $request)
    {
        $airReports = $request->air_description;
        $forwardingLetter = $airReports[0];
        $cover = $airReports[1];
        unset($airReports[0],$airReports[1]);
        return view('modules.audit_quality_control.qac_01.partials.preview_audit_qac1_report',
            compact('airReports', 'forwardingLetter','cover'));
    }
}
