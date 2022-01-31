<?php

namespace App\Http\Controllers\AuditReport;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuditQACOneReportController extends Controller
{
    public function downloadAuditReport(Request $request)
    {
        $auditReport = $request->air_description;
        $coverPage = $auditReport[0];
        $indexPage = $auditReport[1];
        $partOneCoverPage = $auditReport[2];
        $partTwoFirstCoverPage = $auditReport[15];
        $auditOnnuchedSFISumaryPage = $auditReport[16];
        $auditOnnuchedSFIDetailsPage = $auditReport[17];
        $partTwoSecondCoverPage = $auditReport[18];
        $auditOnnuchedNONSFISumaryPage = $auditReport[19];
        $auditOnnuchedNONSFIDetailsPage = $auditReport[20];
        $appendicesCoverPage = $auditReport[21];
        $appendicesDetailsPage = $auditReport[22];

        unset($auditReport[0], $auditReport[1], $auditReport[2], $auditReport[15],
            $auditReport[16],$auditReport[17],$auditReport[18],$auditReport[19],
            $auditReport[20],$auditReport[21],$auditReport[22]);

        $pdf = \PDF::loadView('modules.audit_quality_control.qac_01.partials.audit_qac1_report_book',
            [
                'coverPage' => $coverPage,
                'indexPage' => $indexPage,
                'partOneCoverPage' => $partOneCoverPage,
                'partTwoFirstCoverPage' => $partTwoFirstCoverPage,
                'auditOnnuchedSFISumaryPage' => $auditOnnuchedSFISumaryPage,
                'auditOnnuchedSFIDetailsPage' => $auditOnnuchedSFIDetailsPage,
                'partTwoSecondCoverPage' => $partTwoSecondCoverPage,
                'auditOnnuchedNONSFISumaryPage' => $auditOnnuchedNONSFISumaryPage,
                'auditOnnuchedNONSFIDetailsPage' => $auditOnnuchedNONSFIDetailsPage,
                'appendicesCoverPage' => $appendicesCoverPage,
                'appendicesDetailsPage' => $appendicesDetailsPage,
                'auditReport' => $auditReport,
            ], [] , ['orientation' => 'P', 'format' => 'A4']);

        $fileName = 'qac1_report_' . date('D_M_j_Y') . '.pdf';
        return $pdf->stream($fileName);
    }


    public function previewAuditReport(Request $request)
    {
        $airReports = $request->air_description;
        $cover = $airReports[0];
        array_shift($airReports);
        return view('modules.audit_quality_control.qac_01.partials.preview_audit_qac1_report',
            compact('airReports', 'cover'));
    }
}
