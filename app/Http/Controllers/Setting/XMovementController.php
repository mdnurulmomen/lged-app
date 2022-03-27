<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class XMovementController extends Controller
{
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            //dd($request->all());
            $data = Validator::make($request->all(), [
                'r_air_id' => 'required|integer',
                'receiver_officer_id' => 'required|integer',
                'receiver_office_id' => 'required|integer',
                'receiver_unit_id' => 'required|integer',
                'receiver_unit_name_en' => 'required',
                'receiver_unit_name_bn' => 'required',
                'receiver_employee_id' => 'required|integer',
                'receiver_employee_name_en' => 'required',
                'receiver_employee_name_bn' => 'required',
                'receiver_employee_designation_id' => 'required|integer',
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
                'status.required' => 'Status is required',
                'air_type.required' => 'AIR type is required',
            ])->validate();

            $data['comments'] = $request->comments;
            $data['office_id'] = $request->office_id;
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
}
