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
        try {
            //dd($request->all());
            $data = Validator::make($request->all(), [
                'r_air_id' => 'required|integer',
                'sender_officer_id' => 'required|integer',
                'sender_office_id' => 'required|integer',
                'sender_unit_id' => 'required|integer',
                'sender_unit_name_en' => 'required',
                'sender_unit_name_bn' => 'required',
                'sender_employee_id' => 'required|integer',
                'sender_employee_name_en' => 'required',
                'sender_employee_name_bn' => 'required',
                'sender_employee_designation_id' => 'required|integer',
                'sender_employee_designation_en' => 'required',
                'sender_employee_designation_bn' => 'required',
                'sender_officer_phone' => 'required',
                'sender_officer_email' => 'required',
                'status' => 'required',
            ])->validate();

            $data['comments'] = $request->comments;
            $data['cdesk'] = $this->current_desk_json();
            $responseData = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_report.air.store_air_movement'), $data)->json();
            if (isSuccess($responseData)) {
                return response()->json(['status' => 'success', 'data' => 'Added!']);
            } else {
                return response()->json(['status' => 'error', 'data' => $responseData]);
            }
        } catch (ValidationException $exception) {
            return response()->json([
                'status' => 'error',
                'msg' => $exception->errors(),
                'statusCode' => '422',
            ]);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'data' => $exception->getMessage()]);
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
        $air_report_id = $request->air_report_id;
        $data['r_air_id'] = $air_report_id;
        $data['cdesk'] = $this->current_desk_json();
        $responseData = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_report.air.get_air_last_movement'), $data)->json();
        $last_air_movement = isSuccess($responseData)?$responseData['data']:[];
        //dd($last_air_movement);
        $officer_lists = $this->cagDoptorOfficeUnitDesignationEmployees($this->current_office_id());
        return view('modules.audit_report.air_generate.partials.load_approval_authority',compact('officer_lists','air_report_id','last_air_movement'));
    }
}
