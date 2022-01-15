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

    public function editQACAirReport(Request $request)
    {
        $data = Validator::make($request->all(), [
            'air_report_id' => 'required|integer',
        ])->validate();

        $data['cdesk'] = $this->current_desk_json();
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
            $qac_type = $request->qac_type;
            //dd($current_designation_id);

            return view('modules.audit_quality_control.qac_01.edit',
                compact('content','air_report_id','approved_status',
                'latest_receiver_designation_id','current_designation_id','is_sent','qac_type'));
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
        //dd($apottis);
        if ($request->apotti_view_scope == 'summary'){
            return view('modules.audit_report.air_generate.partials.load_audit_apottis_summary',compact('apottis'));
        }
        else{
            return view('modules.audit_report.air_generate.partials.load_audit_apottis_details',compact('apottis'));
        }
    }
}
