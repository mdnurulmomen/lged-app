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
        $pdf = \PDF::loadView('modules.audit_quality_control.qac_01.partials.audit_qac1_report_book',
            ['auditReport' => $auditReport], [] , ['orientation' => 'P', 'format' => 'A4']);

        $fileName = 'qac1_report_' . date('D_M_j_Y') . '.pdf';
        return $pdf->stream($fileName);
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
