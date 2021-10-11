<?php

namespace App\Http\Controllers\AuditPlan\Plan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class OfficeOrderController extends Controller
{
    public function index()
    {
        $fiscal_years = $this->allFiscalYears();
        return view('modules.audit_plan.audit_plan.office_order.office_orders', compact('fiscal_years'));
    }

    public function loadOfficeOrderList(Request $request)
    {
        $requestData = Validator::make($request->all(), [
            'fiscal_year_id' => 'required|integer',
            'per_page' => 'required|integer',
            'page' => 'required|integer',
        ])->validate();

        $requestData['cdesk'] =json_encode($this->current_desk(), JSON_UNESCAPED_UNICODE);
        $responseData = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_entity_plan.ap_office_order.audit_plan_list'), $requestData)->json();
//        dd($responseData);
        $data['audit_plans'] = isSuccess($responseData)?$responseData['data']:[];
        $data['current_designation_id'] = $this->current_designation_id();
        return view('modules.audit_plan.audit_plan.office_order.partials.load_office_orders',$data);
    }

    public function loadOfficeOrderGenerateModal(Request $request){
        $requestData = [
            'cdesk' => json_encode($this->current_desk(), JSON_UNESCAPED_UNICODE),
            'audit_plan_id' => $request->audit_plan_id,
            'annual_plan_id' => $request->annual_plan_id,
        ];

        $responseData = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_entity_plan.ap_office_order.show_office_order'), $requestData)->json();
        //dd($responseData);
        $data['office_order'] = isSuccess($responseData)?$responseData['data']['office_order']:'';
        $data['audit_plan_id'] = $request->audit_plan_id;
        $data['annual_plan_id'] = $request->annual_plan_id;
        return view('modules.modal.load_office_order_generate_modal',$data);
    }

    public function showOfficeOrder(Request $request)
    {
        $requestData = [
            'cdesk' => json_encode($this->current_desk(), JSON_UNESCAPED_UNICODE),
            'audit_plan_id' => $request->audit_plan_id,
            'annual_plan_id' => $request->annual_plan_id,
        ];

        $data['current_designation_id'] = $this->current_designation_id();
        $responseData = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_entity_plan.ap_office_order.show_office_order'), $requestData)->json();
        //dd($responseData);
        if(isSuccess($responseData)){
            $data['office_order'] = $responseData['data']['office_order'];
            $data['audit_team_members'] = $responseData['data']['audit_team_members'];
            $data['audit_team_schedules'] = $responseData['data']['audit_team_schedules'];
            if ($request->is_print == 0){
                return view('modules.audit_plan.audit_plan.office_order.show_office_order',$data);
            }
            elseif($request->is_print == 1){
                return view('modules.audit_plan.audit_plan.office_order.print_office_order',$data);
            }
        } else{
            return response()->json(['status' => 'error', 'data' => $responseData]);
        }
    }


    public function generateOfficeOrder(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            //dd($request->all());
            Validator::make($request->all(), [
                'audit_plan_id' => 'required',
                'annual_plan_id' => 'required',
                'memorandum_no' => 'required',
                'memorandum_date' => 'required',
                'heading_details' => 'required',
                'advices' => 'required',
                'order_cc_list' => 'required'
            ])->validate();

            $data = [
                'cdesk' => json_encode($this->current_desk(), JSON_UNESCAPED_UNICODE),
                'audit_plan_id' => $request->audit_plan_id,
                'annual_plan_id' => $request->annual_plan_id,
                'memorandum_no' => $request->memorandum_no,
                'memorandum_date' => $request->memorandum_date,
                'heading_details' => $request->heading_details,
                'advices' => $request->advices,
                'approved_status' => 'draft',
                'order_cc_list' => $request->order_cc_list
            ];

            $responseGenerateOfficeOrder = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_entity_plan.ap_office_order.generate_office_order'), $data)->json();
            //dd($responseGenerateOfficeOrder);
            if (isSuccess($responseGenerateOfficeOrder)) {
                return response()->json(['status' => 'success', 'data' => 'Added!']);
            } else {
                return response()->json(['status' => 'error', 'data' => $responseGenerateOfficeOrder]);
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

    public function loadOfficeOrderApprovalAuthority(Request $request)
    {
        $requestData = [
            'cdesk' => json_encode($this->current_desk(), JSON_UNESCAPED_UNICODE),
            'audit_plan_id' => $request->audit_plan_id,
            'annual_plan_id' => $request->annual_plan_id,
        ];
        $responseData = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_entity_plan.ap_office_order.show_office_order'), $requestData)->json();
        //dd($responseData);
        $data['office_order'] = isSuccess($responseData)?$responseData['data']['office_order']:[];
        $data['ap_office_order_id'] = $request->ap_office_order_id;
        $data['audit_plan_id'] = $request->audit_plan_id;
        $data['annual_plan_id'] = $request->annual_plan_id;
        $data['officer_lists'] = $this->cagDoptorOfficeUnitDesignationEmployees($this->current_office_id());
        return view('modules.audit_plan.audit_plan.office_order.partials.load_approval_authority',$data);
    }

    public function storeOfficeOrderApprovalAuthority(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            //dd($request->all());
            $data = Validator::make($request->all(), [
                'ap_office_order_id' => 'required|integer',
                'annual_plan_id' => 'required|integer',
                'audit_plan_id' => 'required|integer',
                'office_id' => 'required|integer',
                'unit_id' => 'required|integer',
                'unit_name_en' => 'required',
                'unit_name_bn' => 'required',
                'officer_type' => 'required',
                'employee_id' => 'required|integer',
                'employee_name_en' => 'required',
                'employee_name_bn' => 'required',
                'employee_designation_id' => 'required|integer',
                'employee_designation_en' => 'required',
                'employee_designation_bn' => 'required',
                'officer_phone' => 'required',
                'officer_email' => 'required',
                'received_by' => 'required|integer',
            ])->validate();

            $data['cdesk'] = json_encode($this->current_desk(), JSON_UNESCAPED_UNICODE);

            $responseGenerateOfficeOrder = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_entity_plan.ap_office_order.store_approval_authority'), $data)->json();
            //dd($responseGenerateOfficeOrder);
            if (isSuccess($responseGenerateOfficeOrder)) {
                return response()->json(['status' => 'success', 'data' => 'Added!']);
            } else {
                return response()->json(['status' => 'error', 'data' => $responseGenerateOfficeOrder]);
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

    public function approveOfficeOrder(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $data = Validator::make($request->all(), [
                'fiscal_year_id' => 'required|integer',
                'ap_office_order_id' => 'required|integer',
                'annual_plan_id' => 'required|integer',
                'audit_plan_id' => 'required|integer',
                'approved_status' => 'required',
            ])->validate();

            $data['cdesk'] = json_encode($this->current_desk(), JSON_UNESCAPED_UNICODE);

            $responseGenerateOfficeOrder = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_entity_plan.ap_office_order.approve_office_order'), $data)->json();
            if (isSuccess($responseGenerateOfficeOrder)) {
                return response()->json(['status' => 'success', 'data' => 'Added!']);
            } else {
                return response()->json(['status' => 'error', 'data' => $responseGenerateOfficeOrder]);
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
