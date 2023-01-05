<?php

namespace App\Http\Controllers\AuditPlan\Plan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class OfficeOrderController extends Controller
{
    public function index()
    {
        $office_id = $this->current_office_id();
        $all_directorates = $this->allAuditDirectorates();
        $self_directorate = current(array_filter($all_directorates, function ($item) {
            return $this->current_office_id() == $item['office_id'];
        }));
        $directorates = $self_directorate ? [$self_directorate] : $all_directorates;
        $fiscal_years = $this->allFiscalYears();
        return view('modules.audit_plan.audit_plan.office_order.office_orders',
            compact('fiscal_years','office_id','directorates'));
    }

    public function loadOfficeOrderList(Request $request)
    {
        $requestData = Validator::make($request->all(), [
            // 'office_id' => 'nullable',
            // 'fiscal_year_id' => 'required|integer',
            // 'activity_id' => 'nullable',
            'per_page' => 'required|integer',
            'page' => 'required|integer',
        ])->validate();


        $requestData['cdesk'] =$this->current_desk_json();

        $data['current_grade'] = $this->current_desk()['officer_grade'];

        $responseData = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_entity_plan.ap_office_order.audit_plan_list'), $requestData)->json();
        // dd($responseData);
        $data['audit_plans'] = isSuccess($responseData)?$responseData['data']:[];

    //    dd($data['audit_plans']);

        $data['current_designation_id'] = $this->current_designation_id();
        $data['current_office_id'] = $this->current_office_id();
    //    dd($data['audit_plans']['data']);
        return view('modules.audit_plan.audit_plan.office_order.partials.load_office_orders',$data);
    }

    public function loadOfficeOrderCreate(Request $request){
        // dd($request->all());
        $requestData = [
            'cdesk' => $this->current_desk_json(),
            'office_order_id' => $request->office_order_id,
            'audit_plan_id' => $request->audit_plan_id,
            'annual_plan_id' => $request->annual_plan_id,
        ];

        $responseData = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_entity_plan.ap_office_order.show_office_order'), $requestData)->json();
        //dd($responseData);
        $office_order = isSuccess($responseData)?$responseData['data']['office_order']:'';
        $data['office_order'] = $request->update_request == 0 ?  $office_order : '';
        $data['audit_plan_id'] = $request->audit_plan_id;
        $data['annual_plan_id'] = $request->annual_plan_id;
        return view('modules.audit_plan.audit_plan.office_order.partials.load_office_order_create',$data);
    }

    public function loadOfficeOrderCCCreate(Request $request){
        $requestData = [
            'cdesk' => $this->current_desk_json(),
            'audit_plan_id' => $request->audit_plan_id,
            'annual_plan_id' => $request->annual_plan_id,
        ];

        return view('modules.modal.load_office_order_cc_modal');
    }

    public function showOfficeOrder(Request $request)
    {
        $requestData = [
            'cdesk' => $this->current_desk_json(),
            'audit_plan_id' => $request->audit_plan_id,
            'annual_plan_id' => $request->annual_plan_id,
        ];

    //    dd($requestData);

        $data['current_designation_id'] = $this->current_designation_id();
        $responseData = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_entity_plan.ap_office_order.show_office_order'), $requestData)->json();
        // dd($responseData);
        if(isSuccess($responseData)){
            $data['office_id'] = $this->current_office_id();
            $data['vacations'] = $this->yearWiseVacationList(date("Y"));
            $data['office_order'] = $responseData['data']['office_order'];
            $data['audit_team_members'] = $responseData['data']['audit_team_members'];
            $data['audit_team_schedules'] = $responseData['data']['audit_team_schedules'];
            $data['audit_type'] = $responseData['data']['audit_type'];
            $data['milestones'] = $responseData['data']['milestones'];
            // dd($data);
            return view('modules.audit_plan.audit_plan.office_order.show_office_order',$data);
        } else{
            return response()->json(['status' => 'error', 'data' => $responseData]);
        }
    }

    public function showUpdateOfficeOrder(Request $request)
    {
        $requestData = [
            'cdesk' => $this->current_desk_json(),
            'office_order_id' => $request->office_order_id,
            'audit_plan_id' => $request->annual_plan_id,
            'annual_plan_id' => $request->annual_plan_id,
        ];

        $data['current_designation_id'] = $this->current_designation_id();
        $responseData = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_entity_plan.ap_office_order.show_update_office_order'), $requestData)->json();
        //dd($responseData);
        if(isSuccess($responseData)){
            $data['office_order'] = $responseData['data']['office_order'];
            $data['audit_team_members'] = $responseData['data']['audit_team_members'];
            $data['audit_team_schedules'] = $responseData['data']['audit_team_schedules'];
            return view('modules.audit_plan.audit_plan.office_order.show_office_order',$data);
        } else{
            return response()->json(['status' => 'error', 'data' => $responseData]);
        }
    }


    public function generateOfficeOrder(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            Validator::make($request->all(), [
                'audit_plan_id' => 'required',
                'memorandum_no' => 'required',
                'memorandum_date' => 'required',
                'heading_details' => 'required',
                'advices' => 'required',
                'order_cc_list' => 'required',
            ])->validate();

            $data = [
                'cdesk' => $this->current_desk_json(),
                'audit_plan_id' => $request->audit_plan_id,
                'memorandum_no' => $request->memorandum_no,
                'memorandum_date' => $request->memorandum_date,
                'heading_details' => $request->heading_details,
                'advices' => $request->advices,
                'order_cc_list' => $request->order_cc_list,
            ];

            $responseGenerateOfficeOrder = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_entity_plan.ap_office_order.generate_office_order'), $data)->json();
            // dd($responseGenerateOfficeOrder);
            if (isSuccess($responseGenerateOfficeOrder)) {
                return response()->json(['status' => 'success', 'data' => 'Office Order Added!']);
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
            'cdesk' => $this->current_desk_json(),
            'office_order_id' => $request->ap_office_order_id,
            'audit_plan_id' => $request->audit_plan_id,
            'annual_plan_id' => $request->annual_plan_id,
        ];
        $responseData = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_entity_plan.ap_office_order.show_office_order'), $requestData)->json();
        //dd($responseData);
        $data['office_order'] = isSuccess($responseData)?$responseData['data']['office_order']:[];
        $data['ap_office_order_id'] = $request->ap_office_order_id;
        $data['audit_plan_id'] = $request->audit_plan_id;
        $data['annual_plan_id'] = $request->annual_plan_id;

        $officer_lists = $this->initDoptorHttp()->post(config('cag_doptor_api.office_unit_designation_employee_map'),
            [
                'office_id' => $this->current_office_id(),
                'designation_grade' => 6,
            ]
        )->json();

        $data['officer_lists'] = $officer_lists['status'] == 'success'?$officer_lists['data']:[];
//        $data['officer_lists'] = $this->cagDoptorOfficeUnitDesignationEmployees($this->current_office_id());
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

            $data['cdesk'] = $this->current_desk_json();

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
                'has_office_order_update' => 'required|integer',
                'annual_plan_id' => 'required|integer',
                'audit_plan_id' => 'required|integer',
                'approved_status' => 'required',
            ])->validate();

//            dd($data);

            $data['cdesk'] = $this->current_desk_json();

            $approvedOfficeOrder = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_entity_plan.ap_office_order.approve_office_order'), $data)->json();
//            dd($approvedOfficeOrder);
            if (isSuccess($approvedOfficeOrder)) {
                $this->storeOfficeOrderLog($data);
                return response()->json(['status' => 'success', 'data' => 'Added!']);
            } else {
                return response()->json(['status' => 'error', 'data' => $approvedOfficeOrder]);
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

    public function generateOfficeOrderPDF(Request $request)
    {
        $requestData = [
            'cdesk' => $this->current_desk_json(),
            'office_order_id' => $request->office_order_id,
            'audit_plan_id' => $request->audit_plan_id,
            'annual_plan_id' => $request->annual_plan_id,
        ];
        $data['office_id'] = $this->current_office_id();
        $data['current_designation_id'] = $this->current_designation_id();
        $responseData = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_entity_plan.ap_office_order.show_office_order'), $requestData)
            ->json();

        $data['vacations'] = $this->yearWiseVacationList(date("Y"));
        $data['office_order'] = $responseData['data']['office_order'];
        $data['audit_team_members'] = $responseData['data']['audit_team_members'];
        $data['audit_team_schedules'] = $responseData['data']['audit_team_schedules'];
        $pdf = \PDF::loadView('modules.audit_plan.audit_plan.office_order.partials.office_order_book', $data, ['orientation' => 'P', 'format' => 'A4']);
        return $pdf->stream('document.pdf');
    }

    public function storeOfficeOrderLog($office_order_info)
    {
        $requestData = [
            'cdesk' => $office_order_info['cdesk'],
            'office_order_id' => $office_order_info['ap_office_order_id'],
            'audit_plan_id' => $office_order_info['audit_plan_id'],
            'annual_plan_id' => $office_order_info['annual_plan_id'],
        ];

        $data['current_designation_id'] = $this->current_designation_id();
        $responseData = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_entity_plan.ap_office_order.show_office_order'), $requestData)
            ->json();

        $data['vacations'] = $this->yearWiseVacationList(date('Y'));

        $data['office_order'] = $responseData['data']['office_order'];
        $data['audit_team_members'] = $responseData['data']['audit_team_members'];
        $data['audit_team_schedules'] = $responseData['data']['audit_team_schedules'];
        $data['office_id'] = $this->current_office_id();

        $pdf = \PDF::loadView('modules.audit_plan.audit_plan.office_order.partials.office_order_book', $data);

        $requestData['office_order_pdf_log'] = base64_encode($pdf->output());

        $this->initHttpWithToken()->post(config('amms_bee_routes.audit_entity_plan.ap_office_order.store_office_order_log'), $requestData)->json();

    }
}
