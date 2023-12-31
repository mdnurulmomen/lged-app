<?php

namespace App\Http\Controllers\AuditReport;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuditQACAIRReportController extends Controller
{

    public function updateQACAirReport(Request $request)
    {
        $air_description = json_decode($request->air_description);
        unset($air_description['31']);

        Validator::make($request->all(), [
            'air_id' => 'required|integer',
            'air_description' => 'required',
        ])->validate();
        $data['air_id'] = $request->air_id;
        $data['air_type'] = $request->air_type ?? null;
        $data['office_id'] = $request->office_id;
        $data['air_description'] = makeEncryptedData(gzcompress(json_encode($air_description)));
        $data['cdesk'] = $this->current_desk_json();
        $saveAirReport = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_report.air.update_qac_air_report'), $data)->json();
        if (isSuccess($saveAirReport)) {
            return response()->json(['status' => 'success', 'data' => $saveAirReport['data']]);
        } else {
            return response()->json(['status' => 'error', 'data' => $saveAirReport]);
        }
    }


    public function loadAirWiseApottiDeleteView(Request $request)
    {
        $air_report_id = $request->air_report_id;
        $apotti_id = $request->apotti_id;
        $data['apotti_id'] = $apotti_id;
        $data['cdesk'] = $this->current_desk_json();
        $apotti_info = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.apotti.get_apotti_info'), $data)->json();
        if (isSuccess($apotti_info)) {
            $apotti_info = $apotti_info['data'];
            return view('modules.audit_quality_control.qac_01.partials.load_qac_apotti_delete_view',
                compact('apotti_info','air_report_id','apotti_id'));
        } else {
            return response()->json(['status' => 'error', 'data' => $apotti_info]);
        }
    }

    public function softDeleteAirReportWiseApotti(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = Validator::make($request->all(), [
            'air_report_id' => 'required|integer',
            'apotti_id' => 'required',
        ])->validate();
        $data['is_delete'] = $request->is_delete;
        //$data['comments'] = $request->comments;
        $data['cdesk'] = $this->current_desk_json();
        $responseData = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_report.air.delete_air_report_wise_apotti'), $data)->json();
        if (isSuccess($responseData)) {
            return response()->json(['status' => 'success', 'data' => $responseData['data']]);
        } else {
            return response()->json(['status' => 'error', 'data' => $responseData]);
        }
    }

    public function apottiFinalApprovalStatus(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = Validator::make($request->all(), [
            'air_report_id' => 'required|integer',
            'apotti_id' => 'required',
            'office_id' => 'required',
        ])->validate();
        $data['final_status'] = $request->final_status;
        $data['qac_type'] = 'cqat';
//        dd($data);
        //$data['comments'] = $request->comments;
        $data['cdesk'] = $this->current_desk_json();
//        dd($data);
        $responseData = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_report.air.apotti_final_approval'), $data)->json();
//        dd($responseData);
        if (isSuccess($responseData)) {
            return response()->json(['status' => 'success', 'data' => $responseData['data']]);
        } else {
            return response()->json(['status' => 'error', 'data' => $responseData]);
        }
    }

    public function qacReportDate(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = Validator::make($request->all(), [
            'air_id' => 'required|integer',
            'office_id' => 'required',
            'qac_type' => 'required',
        ])->validate();

        $data['qac_report_date'] = Carbon::parse($request->qac_report_date)->format('Y-m-d');
        $data['cdesk'] = $this->current_desk_json();

        $saveAirReport = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_report.air.update_qac_air_report'), $data)->json();

        if (isSuccess($saveAirReport)) {
            return response()->json(['status' => 'success', 'data' => $saveAirReport['data']]);
        } else {
            return response()->json(['status' => 'error', 'data' => $saveAirReport]);
        }

    }

    public function editQACAirReport(Request $request)
    {
        $data = Validator::make($request->all(), [
            'air_report_id' => 'required|integer',
            'office_id' => 'required|integer',
        ])->validate();

        $cdeskData = $this->current_desk_json();
        $data['cdesk'] = $cdeskData;

        $responseData = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_report.air.edit_air_report'), $data)->json();
//        dd($responseData);
        if (isSuccess($responseData)) {
            $airReport = $responseData['data'];
            $content = gzuncompress(getDecryptedData($airReport['air_description']));
            $air_report_id = $airReport['id'];
            $approved_status = $airReport['status'];
            $report_type = $airReport['report_type'];
            $latest_receiver_designation_id = empty($airReport['latest_r_air_movement'])?0:$airReport['latest_r_air_movement']['receiver_employee_designation_id'];
            $current_designation_id = $this->current_designation_id();
            $is_sent = $airReport['is_sent'];
            $is_received = $airReport['is_received'];
            $qac_type = $request->qac_type;

            $fiscal_year_id = $airReport['fiscal_year_id'];
            $audit_year = enTobn($airReport['fiscal_year']['start']).'-'.enTobn($airReport['fiscal_year']['end']);
            $fiscal_year = enTobn($airReport['fiscal_year']['start']).'-'.enTobn($airReport['fiscal_year']['end']);

            $activity_id = $airReport['activity_id'];
            $audit_plan_id = $airReport['audit_plan_id'];
            $annual_plan_id = $airReport['annual_plan_id'];

            $directorate_name = $this->current_office()['office_name_bn'];
            //$directorate_address = $this->current_office_details()['office_address']; //todo
            $directorate_address = '';

            $auditType = $request->session()->get('dashboard_audit_type_bn');

            //for entity info
            $entityNames = [];
            foreach ($airReport['annual_plan']['ap_entities'] as $ap_entities) {
                $entityNames[] = $ap_entities['entity_name_bn'];
            }
            $audit_plan_entities = count($entityNames)>1?implode(" এবং ",$entityNames):$entityNames[0];


            if ($qac_type == 'qac-1'){
                $parent_air_id = $request->parent_air_id;
                if ($report_type != 'cloned'){
                    return view('modules.audit_quality_control.qac_01.create',
                        compact('report_type','fiscal_year_id','activity_id','audit_plan_id',
                            'annual_plan_id','auditType','directorate_name','directorate_address',
                            'content','audit_plan_entities','air_report_id','approved_status',
                            'latest_receiver_designation_id','current_designation_id',
                            'is_sent','is_received','qac_type','audit_year','fiscal_year',
                            'parent_air_id'));
                }
                else{
                    $qacOneData['template_type'] = 'qac1_report';
                    $qacOneData['cdesk'] = $cdeskData;
                    $responseReportTemplateData = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_report.air.create_air_report'), $qacOneData)->json();
                    //dd($responseReportTemplateData);
                    if (isSuccess($responseReportTemplateData)) {
                        $content = $responseReportTemplateData['data']['content'];
                        return view('modules.audit_quality_control.qac_01.create',
                            compact('report_type','fiscal_year_id','activity_id','audit_plan_id',
                                'annual_plan_id','auditType','directorate_name','directorate_address',
                                'content','audit_plan_entities','air_report_id','approved_status',
                                'latest_receiver_designation_id','current_designation_id',
                                'is_sent','is_received','qac_type','audit_year','fiscal_year',
                                'parent_air_id'));
                    }
                }
            }
            elseif ($qac_type == 'qac-2'){
                if ($report_type != 'cloned'){
                    return view('modules.audit_quality_control.qac_02.create',
                        compact('content','audit_plan_entities','air_report_id',
                            'approved_status','latest_receiver_designation_id','current_designation_id',
                            'is_sent','is_received','qac_type'));
                }
                else{
                    $qacTwoData['template_type'] = 'qac2_report';
                    $qacTwoData['cdesk'] = $cdeskData;
                    $responseReportTemplateData = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_report.air.create_air_report'), $qacTwoData)->json();
                    //dd($responseReportTemplateData);
                    if (isSuccess($responseReportTemplateData)) {
                        $content = $responseReportTemplateData['data']['content'];
                        return view('modules.audit_quality_control.qac_02.create',
                            compact('content','audit_plan_entities','air_report_id',
                                'approved_status','latest_receiver_designation_id','current_designation_id',
                                'is_sent','is_received','qac_type'));
                    }
                }
            }
            elseif ($qac_type == 'cqat'){
                $desk_office_id = json_decode($cdeskData,true);
                $desk_office_id = $desk_office_id['office_id'];
                $office_id = $request->office_id;
                $scope = $request->scope;
                $parent_air_id = $request->parent_air_id;

                if ($report_type != 'cloned'){
                    return view('modules.audit_quality_control.cqat.create',
                        compact('content','audit_plan_entities','air_report_id',
                            'approved_status','latest_receiver_designation_id','current_designation_id',
                            'is_sent','is_received','qac_type','office_id','scope','desk_office_id','parent_air_id'));
                }else{
                    $cqatData['template_type'] = 'cqat_report';
                    $cqatData['cdesk'] = $cdeskData;
                    $responseReportTemplateData = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_report.air.create_air_report'), $cqatData)->json();
                    //dd($responseReportTemplateData);
                    if (isSuccess($responseReportTemplateData)) {
                        $content = $responseReportTemplateData['data']['content'];
                        return view('modules.audit_quality_control.cqat.create',
                            compact('content','audit_plan_entities','air_report_id',
                                'approved_status','latest_receiver_designation_id','current_designation_id',
                                'is_sent','is_received','qac_type','office_id','scope','desk_office_id','parent_air_id'));
                    }
                }

            }
            else{
                return view('modules.audit_quality_control.qac_01.edit',
                    compact('content','audit_plan_entities','air_report_id',
                        'approved_status', 'latest_receiver_designation_id','current_designation_id',
                        'is_sent', 'is_received','qac_type'));
            }
        }
        else {
            return ['status' => 'error', 'data' => $responseData['data']];
        }
    }


    public function getAirWiseQACApotti(Request $request)
    {
        $requestData = Validator::make($request->all(), [
            'air_id' => 'required',
            'qac_type' => 'required',
        ])->validate();
        $requestData['cdesk'] =$this->current_desk_json();
        $responseData = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_report.air.get_air_wise_qac_apotti'), $requestData)->json();
        $apottiStatusList = isSuccess($responseData)?$responseData['data']:[];
//        dd($apottis);
        $qac_type = $request->qac_type;
        if ($request->apotti_view_scope == 'summary'){
            return view('modules.audit_quality_control.partials.load_audit_apottis_summary',compact('apottiStatusList','qac_type'));
        }
        else{
            return view('modules.audit_quality_control.partials.load_audit_apottis_details',compact('apottiStatusList','qac_type'));
        }
    }


    public function getAirAndApottiTypeWiseQACApotti(Request $request)
    {
        $requestData = Validator::make($request->all(), [
            'air_id' => 'required',
            'qac_type' => 'required',
            'apotti_type' => 'required',
        ])->validate();
        $requestData['cdesk'] =$this->current_desk_json();
        $responseData = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_report.air.get_air_and_apotti_type_wise_qac_apotti'), $requestData)->json();
        $apottiStatusList = isSuccess($responseData)?$responseData['data']:[];
        if ($request->apotti_view_scope == 'summary'){
            return view('modules.audit_quality_control.partials.load_audit_apottis_summary',compact('apottiStatusList'));
        }
        else{
            return view('modules.audit_quality_control.partials.load_audit_apottis_details',compact('apottiStatusList'));
        }
    }

    public function getAirWisePorisistos(Request $request)
    {
        $requestData = Validator::make($request->all(), [
            'air_id' => 'required',
        ])->validate();
        $requestData['cdesk'] =$this->current_desk_json();
        $responseData = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_report.air.get-air-wise-porisistos'), $requestData)->json();
        $apotti_items = isSuccess($responseData)?$responseData['data']:[];
        return view('modules.audit_report.air_generate.partials.load_audit_apottis_wise_porisistos',compact('apotti_items'));
    }


    public function download(Request $request)
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
                    'air_type' => 'cqat',
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
                'modules.audit_quality_control.cqat.books.book_cqat_apotti_air',
                ['auditReport' => $auditReport],
                [],
                ['orientation' => 'P', 'format' => 'A4']
            );
            $fileName = 'Final_Report_' . date('D_M_j_Y') . '.pdf';
            return $pdf->stream($fileName);
        } elseif ($scope == 'porishisto_air') {
            $pdf = \PDF::loadView(
                'modules.audit_quality_control.cqat.books.book_porishisto_air',
                ['porisistos' => $porisistos_html, 'auditReport' => $auditReport],
                [],
                ['orientation' => 'P', 'format' => 'A4']
            );
            $fileName = 'Final_Report_' . date('D_M_j_Y') . '.pdf';
            return $pdf->stream($fileName);
        } elseif ($scope == 'full_air') {
            $pdf = \PDF::loadView(
                'modules.audit_quality_control.cqat.books.book_cqat_full_air',
                ['porisistos' => $porisistos_html, 'auditReport' => $auditReport],
                [],
                ['orientation' => 'P', 'format' => 'A4']
            );
            $fileName = 'Final_Report_' . date('D_M_j_Y') . '.pdf';
            return $pdf->stream($fileName);
        }
    }

    public function previewAuditReport(Request $request)
    {
        $airReports = $request->air_description;
        $cover = $airReports[0];
        array_shift($airReports);
        return view('modules.audit_quality_control.cqat.partials.preview_audit_report',
            compact('airReports', 'cover'));
    }
}
