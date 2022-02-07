<?php

namespace App\Http\Controllers\AuditReport;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuditQACTwoReportController extends Controller
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function downloadAuditReport(Request $request)
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
