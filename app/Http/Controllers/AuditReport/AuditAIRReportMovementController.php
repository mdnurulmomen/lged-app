<?php

namespace App\Http\Controllers\AuditReport;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuditAIRReportMovementController extends Controller
{

    public function index($air_type)
    {

    }

    public function create(Request $request)
    {

    }


    public function store(Request $request)
    {
        $data = Validator::make($request->all(), [
            'r_air_id' => 'required|integer',
            'receiver_officer_id' => 'required',
            'receiver_office_id' => 'required',
            'receiver_unit_id' => 'required',
            'receiver_unit_name_en' => 'required',
            'receiver_unit_name_bn' => 'required',
            'receiver_employee_id' => 'required',
            'receiver_employee_name_en' => 'required',
            'receiver_employee_name_bn' => 'required',
            'receiver_employee_designation_id' => 'required',
            'receiver_employee_designation_en' => 'required',
            'receiver_employee_designation_bn' => 'required',
            'receiver_officer_phone' => 'required',
            'receiver_officer_email' => 'required',
            'status' => 'required',
            'air_type' => 'required',
        ],[
            'r_air_id.required' => 'AIR id is required',
            'receiver_officer_id.required' => 'You have to choose receiver',
            'receiver_office_id.required' => 'You have to choose receiver',
            'receiver_unit_id.required' => 'Receiver unit not found',
            'receiver_unit_name_en.required' => 'Receiver unit en not found',
            'receiver_unit_name_bn.required' => 'Receiver unit bn not found',
            'receiver_employee_id.required' => 'Receiver employee not found',
            'receiver_employee_name_en.required' => 'Receiver employee name en not found',
            'receiver_employee_name_bn.required' => 'Receiver employee name bn not found',
            'receiver_employee_designation_id.required' => 'Receiver employee designation not found',
            'receiver_employee_designation_en.required' => 'Receiver employee designation name en not found',
            'receiver_employee_designation_bn.required' => 'Receiver employee designation name bn not found',
            'receiver_officer_phone.required' => 'Receiver phone not found',
            'receiver_officer_email.required' => 'Receiver email not found',
            'status.required' => 'Status is required',
            'air_type.required' => 'AIR type is required',
        ])->validate();

        $data['comments'] = $request->comments;
        $data['office_id'] = $request->office_id;
        $data['cdesk'] = $this->current_desk_json();
        $responseData = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_report.air.store_air_movement'), $data)->json();

        //dd($responseData);
        if (isSuccess($responseData)) {
            return response()->json(['status' => 'success', 'data' => 'Added!']);
        } else {
            return response()->json(['status' => 'error', 'data' => $responseData]);
        }
    }


    public function show(Request $request)
    {

    }


    public function edit(Request $request)
    {

    }


    public function loadApprovalAuthority(Request $request)
    {
        $office_id = $request->office_id;
        $air_report_id = $request->air_report_id;
        $air_type= $request->air_type;
        $data['r_air_id'] = $air_report_id;
        $data['cdesk'] = $this->current_desk_json();
        $responseData = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_report.air.get_air_last_movement'), $data)->json();
        $last_air_movement = isSuccess($responseData)?$responseData['data']:[];
        //dd($last_air_movement);
        $officer_lists = $this->initDoptorHttp()->post(config('cag_doptor_api.office_unit_designation_employee_map'),
            [
                'office_id' => $this->current_office_id(),
                'designation_grade' => 6,
            ]
        )->json();
        $officer_lists = $officer_lists['status'] == 'success'?$officer_lists['data']:[];
//        dd($officer_lists);
        //$officer_lists = $this->cagDoptorOfficeUnitDesignationEmployees($this->current_office_id());
        return view('modules.audit_report.air_generate.partials.load_approval_authority',compact('officer_lists','air_report_id','last_air_movement','air_type','office_id'));
    }

    public function loadCagAuthority(Request $request)
    {
        $office_id = $request->office_id;
        $air_report_id = $request->air_report_id;
        $air_type= $request->air_type;
        $data['r_air_id'] = $air_report_id;
        $data['cdesk'] = $this->current_desk_json();
        $responseData = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_report.air.get_air_last_movement'), $data)->json();
        $last_air_movement = isSuccess($responseData)?$responseData['data']:[];
        //dd($last_air_movement);
        $officer_lists = $this->initDoptorHttp()->post(config('cag_doptor_api.office_unit_designation_employee_map'),
            [
                'office_id' => 1,
                'designation_grade' => 10,
            ]
        )->json();
        $officer_lists = $officer_lists['status'] == 'success'?$officer_lists['data']:[];
//        dd($officer_lists);
        //$officer_lists = $this->cagDoptorOfficeUnitDesignationEmployees($this->current_office_id());
        return view('modules.audit_report.air_generate.partials.load_cag_authority',compact('officer_lists','air_report_id','last_air_movement','air_type','office_id'));
    }

    public function getCagFinalApprovalForm(Request $request){
//        dd($request->all());
        $data['r_air_id'] =$request->air_report_id;
        $data['office_id'] =$request->office_id;
        $data['cdesk'] = $this->current_desk_json();
        $responseData = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_report.air.get_air_last_movement'), $data)->json();
        $last_air_movement = isSuccess($responseData)?$responseData['data']:[];
        $air_report_id = $request->air_report_id;
        $air_type = $request->air_type;
        $office_id = $request->office_id;

        return view('modules.audit_report.audit_final_report.get_cag_final_approval_form',compact('last_air_movement','air_report_id','air_type','office_id'));
    }
}
