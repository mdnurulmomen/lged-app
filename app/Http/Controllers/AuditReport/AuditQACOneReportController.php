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
        $forwardingLetter = $auditReport[0];
        $coverPage = $auditReport[1];
        $indexPage = $auditReport[2];
        $partOneCoverPage = $auditReport[3];
        $partTwoFirstCoverPage = $auditReport[16];
        $auditOnnuchedSFISumaryPage = $auditReport[17];
        $auditOnnuchedSFIDetailsPage = $auditReport[18];
        $partTwoSecondCoverPage = $auditReport[19];
        $auditOnnuchedNONSFISumaryPage = $auditReport[20];
        $auditOnnuchedNONSFIDetailsPage = $auditReport[21];
        $appendicesCoverPage = $auditReport[22];
        $appendicesDetailsPage = $auditReport[23];

        unset($auditReport[0], $auditReport[1], $auditReport[2], $auditReport[3], $auditReport[16],
            $auditReport[17],$auditReport[18],$auditReport[19],$auditReport[20],
            $auditReport[21],$auditReport[22],$auditReport[23]);

        $pdf = \PDF::loadView('modules.audit_quality_control.qac_01.partials.audit_qac1_report_book',
            [
                'forwardingLetter' => $forwardingLetter,
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
        $forwardingLetter = $airReports[0];
        $cover = $airReports[1];
        array_shift($airReports);
        return view('modules.audit_quality_control.qac_01.partials.preview_audit_qac1_report',
            compact('airReports', 'forwardingLetter','cover'));
    }
}
