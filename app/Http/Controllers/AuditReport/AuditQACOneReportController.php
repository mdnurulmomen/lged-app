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
            $apotti_items = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_report.air.get-air-wise-porisistos'), ['air_id' => $request->air_id, 'all' => '1', 'cdesk' => $this->current_desk_json()])->json();

            $serial_number = 1;
            if (isSuccess($apotti_items)) {
                $apotti_items = $apotti_items['data'];
                foreach ($apotti_items as $apotti_item) {
                    $onucched_no = $apotti_item['apotti']['onucched_no'];
                    $porishisto_no = count($apotti_item['porisishtos'])>1?enTobn($onucched_no).'.'.enTobn($serial_number):enTobn($onucched_no);
                    foreach ($apotti_item['porisishtos'] as $porisishto) {
                        $porisistos_html[] = '<span>পরিশিষ্ট নম্বর-'.$porishisto_no.'</span><br><span>অনুচ্ছেদ নম্বর-'.enTobn($onucched_no).'</span>'.$porisishto['details'];
                        $serial_number++;
                    }
                    $serial_number = 1;
                }
            } else {
                $porisistos_html = [];
            }
        }
        $auditReport = $request->air_description;

        if ($scope == 'forwarding_letter') {
            $pdf = \PDF::loadView(
                'modules.audit_quality_control.qac_01.partials.forwarding_air_book',
                ['auditReport' => $auditReport],
                [],
                ['orientation' => 'P', 'format' => 'A4']
            );
            $fileName = 'QAC1 Report Forwarding' . date('D_M_j_Y') . '.pdf';
            return $pdf->stream($fileName);
        } elseif ($scope == 'apotti_air') {
            $pdf = \PDF::loadView(
                'modules.audit_quality_control.qac_01.partials.audit_qac1_apotti_air_book',
                ['auditReport' => $auditReport],
                [],
                ['orientation' => 'P', 'format' => 'A4']
            );
            $fileName = 'QAC1 Report ' . date('D_M_j_Y') . '.pdf';
            return $pdf->stream($fileName);
        } elseif ($scope == 'porishisto_air') {
            $pdf = \PDF::loadView(
                'modules.audit_report.air_generate.partials.porishisto_air_book',
                ['porisistos' => $porisistos_html, 'auditReport' => $auditReport],
                [],
                ['orientation' => 'P', 'format' => 'A4']
            );
            $fileName = 'QAC1 Report ' . date('D_M_j_Y') . '.pdf';
            return $pdf->stream($fileName);
        } elseif ($scope == 'full_air') {
            $pdf = \PDF::loadView(
                'modules.audit_quality_control.qac_01.partials.audit_qac1_report_book',
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
