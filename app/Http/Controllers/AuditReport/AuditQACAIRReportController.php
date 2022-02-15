<?php

namespace App\Http\Controllers\AuditReport;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuditQACAIRReportController extends Controller
{

    public function updateQACAirReport(Request $request)
    {
        //dd($request->fiscal_year_id);
        Validator::make($request->all(), [
            'air_id' => 'required|integer',
            'air_description' => 'required',
        ])->validate();
        $data['air_id'] = $request->air_id;
        $data['office_id'] = $request->office_id;
        $data['air_description'] = makeEncryptedData(gzcompress($request->air_description));
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

//        dd($data);

        $data['qac_report_date'] = date('Y-m-d',strtotime($request->qac_report_date));
        $data['cdesk'] = $this->current_desk_json();

//        dd($data);

        $saveAirReport = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_report.air.update_qac_air_report'), $data)->json();
//       dd($saveAirReport);
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
        //dd($responseData);
        if (isSuccess($responseData)) {
            $airReport = $responseData['data'];
            $content = gzuncompress(getDecryptedData($airReport['air_description']));
            $air_report_id = $airReport['id'];
            $approved_status = $airReport['status'];
            $latest_receiver_designation_id = empty($airReport['latest_r_air_movement'])?0:$airReport['latest_r_air_movement']['receiver_employee_designation_id'];
            $current_designation_id = $this->current_designation_id();
            $is_sent = $airReport['is_sent'];
            $is_received = $airReport['is_received'];
            $qac_type = $request->qac_type;
            $audit_year = '২০১৯-২০২০';
            $fiscal_year = '২০১৯-২০২০';

            $fiscal_year_id = $airReport['fiscal_year_id'];
            $activity_id = $airReport['activity_id'];
            $audit_plan_id = $airReport['audit_plan_id'];
            $annual_plan_id = $airReport['annual_plan_id'];

            $directorate_name = $this->current_office()['office_name_bn'];
            if ($this->current_office_id() == 14) {
                $directorate_address = 'অডিট কমপ্লেক্স <br> ৩য় তলা, সেগুনবাগিচা,ঢাকা-১০০০।';
            } elseif ($this->current_office_id() == 3) {
                $directorate_address = 'অডিট কমপ্লেক্স <br> ২য় তলা, সেগুনবাগিচা,ঢাকা-১০০০।';
            } else {
                $directorate_address = 'অডিট কমপ্লেক্স <br> ৮ম তলা, সেগুনবাগিচা,ঢাকা-১০০০।';
            }
            $auditType = 'কমপ্লায়েন্স অডিট';

            if ($qac_type == 'qac-1'){
                $qacOneData['template_type'] = 'qac1_report';
                $qacOneData['cdesk'] = $cdeskData;
                $responseReportTemplateData = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_report.air.create_air_report'), $qacOneData)->json();
                //dd($responseReportTemplateData);
                if (isSuccess($responseReportTemplateData)) {
                    $content = $responseReportTemplateData['data']['content'];

                    $entityNames = [];
                    foreach ($airReport['annual_plan']['ap_entities'] as $ap_entities) {
                        $entityNames[] = $ap_entities['entity_name_bn'];
                    }
                    $audit_plan_entities = count($entityNames)>1?implode(" এবং ",$entityNames):$entityNames[0];

                    return view('modules.audit_quality_control.qac_01.create',
                        compact('fiscal_year_id','activity_id','audit_plan_id',
                            'annual_plan_id','auditType','directorate_name','directorate_address',
                            'content','audit_plan_entities','air_report_id','approved_status',
                            'latest_receiver_designation_id','current_designation_id',
                            'is_sent','is_received','qac_type','audit_year','fiscal_year'));
                }
            }
            elseif ($qac_type == 'qac-2'){
                $qacTwoData['template_type'] = 'qac2_report';
                $qacTwoData['cdesk'] = $cdeskData;
                $responseReportTemplateData = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_report.air.create_air_report'), $qacTwoData)->json();
                //dd($responseReportTemplateData);
                if (isSuccess($responseReportTemplateData)) {
                    $content = $responseReportTemplateData['data']['content'];

                    $entityNames = [];
                    foreach ($airReport['annual_plan']['ap_entities'] as $ap_entities) {
                        $entityNames[] = $ap_entities['entity_name_bn'];
                    }
                    $audit_plan_entities = count($entityNames)>1?implode(" এবং ",$entityNames):$entityNames[0];

                    return view('modules.audit_quality_control.qac_02.create',
                        compact('content','audit_plan_entities','air_report_id',
                            'approved_status','latest_receiver_designation_id','current_designation_id',
                            'is_sent','is_received','qac_type'));
                }
            }
            elseif ($qac_type == 'cqat'){
                $cqatData['template_type'] = 'cqat_report';
                $cqatData['cdesk'] = $cdeskData;
                $desk_office_id = json_decode($cdeskData,true);
                $desk_office_id = $desk_office_id['office_id'];
//                dd($desk_office_id);
                $office_id = $request->office_id;
                $scope = $request->scope;
                $responseReportTemplateData = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_report.air.create_air_report'), $cqatData)->json();
                //dd($responseReportTemplateData);
                if (isSuccess($responseReportTemplateData)) {
                    $content = $responseReportTemplateData['data']['content'];

                    $entityNames = [];
                    foreach ($airReport['annual_plan']['ap_entities'] as $ap_entities) {
                        $entityNames[] = $ap_entities['entity_name_bn'];
                    }
                    $audit_plan_entities = count($entityNames)>1?implode(" এবং ",$entityNames):$entityNames[0];

                    return view('modules.audit_quality_control.cqat.create',
                        compact('content','audit_plan_entities','air_report_id',
                            'approved_status','latest_receiver_designation_id','current_designation_id',
                            'is_sent','is_received','qac_type','office_id','scope','desk_office_id'));
                }
            }else{
                return view('modules.audit_quality_control.qac_01.edit',
                    compact('content','air_report_id','approved_status',
                        'latest_receiver_designation_id','current_designation_id','is_sent',
                        'is_received','qac_type'));
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
        $apottis = isSuccess($responseData)?$responseData['data']:[];
//        dd($apottis);
        $qac_type = $request->qac_type;
        if ($request->apotti_view_scope == 'summary'){
            return view('modules.audit_quality_control.qac_01.partials.load_audit_apottis_summary',compact('apottis','qac_type'));
        }
        else{
            return view('modules.audit_quality_control.qac_01.partials.load_audit_apottis_details',compact('apottis','qac_type'));
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
        $apottis = isSuccess($responseData)?$responseData['data']:[];
        if ($request->apotti_view_scope == 'summary'){
            return view('modules.audit_quality_control.partials.load_audit_apottis_summary',compact('apottis'));
        }
        else{
            return view('modules.audit_quality_control.partials.load_audit_apottis_details',compact('apottis'));
        }
    }


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

        $pdf = \PDF::loadView('modules.audit_quality_control.cqat.partials.audit_report_book',
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

        $fileName = 'audit_air_report_' . date('D_M_j_Y') . '.pdf';
        return $pdf->stream($fileName);
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
