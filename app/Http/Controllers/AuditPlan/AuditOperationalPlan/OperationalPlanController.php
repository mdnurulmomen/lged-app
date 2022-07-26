<?php

namespace App\Http\Controllers\AuditPlan\AuditOperationalPlan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class OperationalPlanController extends Controller
{
    public function index()
    {
        $fiscal_years = $this->allFiscalYears();
        return view('modules.audit_plan.operational.operational_plan.operational_plan_lists', compact('fiscal_years'));
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function showOperationalPlanLists(Request $request)
    {
        Validator::make($request->all(), ['fiscal_year' => 'required|integer',])->validate();

        $ops = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_operational_plan.load_operational_plan_lists'), ['fiscal_year_id' => $request->fiscal_year])->json();

        if ($ops['status'] = 'success') {
            $ops = $ops['data'];
            return view('modules.audit_plan.operational.operational_plan.partials.load_operational_plan_lists', compact('ops'));
        } else {
            return response()->json(['status' => 'error', 'data' => 'Sorry!']);
        }
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function showOperationalPlanStaffAndDetailsModal(Request $request)
    {
        Validator::make($request->all(), ['activity_id' => 'required|integer',])->validate();

        $staff_details = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_operational_plan.load_operational_plan_lists'),
            [
                'activity_id' => $request->activity_id,
                'fiscal_year_id' => 1
            ])
            ->json();

        if ($staff_details['status'] = 'success') {
            $staff_details = $staff_details['data'];
            return view('modules.audit_plan.operational.operational_plan.partials.load_assigned_staff_and_details_modal', compact('staff_details'));
        } else {
            return response()->json(['status' => 'error', 'data' => 'Sorry!']);
        }
    }


    public function showOperationalPlanStaffs(Request $request)
    {
        Validator::make($request->all(), ['fiscal_year' => 'required|integer',])->validate();

        $ops = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_operational_plan.load_operational_plan_details'), ['fiscal_year_id' => $request->fiscal_year])->json();
//        dd($ops);
        if ($ops['status'] = 'success') {
            $ops = $ops['data'];
            return view('modules.audit_plan.operational.operational_plan.operational_plan_staffs', compact('ops'));
        } else {
            return response()->json(['status' => 'error', 'data' => 'Sorry!']);
        }
    }

    public function showActivityWiseTeam(Request $request)
    {
        return view('modules.audit_plan.operational.operational_plan.partials.load_activity_wise_team');
    }

    public function approveAnnualPlan(Request $request)
    {
        $fiscal_years = $this->allFiscalYears();
        return view('modules.audit_plan.operational.approve_plan.approve_plan_lists',compact('fiscal_years'));
    }

    public function loadOpYearlyEventList(Request $request)
    {
        $data = Validator::make($request->all(), [
            'fiscal_year_id' => 'required|integer',
        ])->validate();

        if(session('dashboard_audit_type') == 'Compliance Audit'){
            $data['activity_type'] = 'compliance';
        }else if(session('dashboard_audit_type') == 'Performance Audit'){
            $data['activity_type'] = 'performance';
            $data['activity_key'] = 'performance';
        }else if(session('dashboard_audit_type')  == 'Financial Audit'){
            $data['activity_type'] = 'financial';
        }

        $data['cdesk'] = $this->current_desk_json();

        $event_list = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_operational_plan.op_yearly_event_lists'), $data)->json();

        $event_list = isSuccess($event_list)?$event_list['data']:[];
        return view('modules.audit_plan.operational.approve_plan.partials.load_op_yearly_event_lists',compact('event_list'));

    }

    public function loadOpYearlyEventApprovalForm(Request $request)
    {
        $fiscal_year_id = $request->fiscal_year_id;
        $annual_plan_main_id = $request->annual_plan_main_id;
        $office_id = $request->office_id;
        $activity_type = $request->activity_type;
        $op_audit_calendar_event_id = $request->op_audit_calendar_event_id;
        return view('modules.audit_plan.operational.approve_plan.partials.load_op_yearly_event_approval_form',
            compact('op_audit_calendar_event_id','fiscal_year_id','office_id','activity_type','annual_plan_main_id'));
    }

    public function loadDirectorateWiseAnnualPlan(Request $request)
    {
        $fiscal_year_id = $request->fiscal_year_id;
        $annual_plan_main_id = $request->annual_plan_main_id;
        $activity_type = $request->activity_type;

        $data = Validator::make($request->all(), [
            'fiscal_year_id' => 'required|integer',
            'office_id' => 'required|integer',
            'annual_plan_main_id' => 'required|integer',
            'activity_type' => 'nullable',
        ])->validate();

        $data['cdesk'] = $this->current_desk_json();

        $plan_infos = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_annual_plan_revised.ap_yearly_plan_book'), $data)->json();
        //dd($plan_infos);

        if (isSuccess($plan_infos)) {
            $plan_infos = $plan_infos['data'];
            $office_id = $request->office_id;
            return view('modules.audit_plan.operational.approve_plan.partials.annual_plan_book',
            [
                'plan_infos' => $plan_infos,
                'office_id' => $office_id,
                'fiscal_year_id' => $fiscal_year_id,
                'annual_plan_main_id' => $annual_plan_main_id,
                'activity_type' => $activity_type,
            ], [], ['orientation' => 'L', 'format' => 'A4']);
        } else {
            return response()->json(['status' => 'error', 'data' => $plan_infos]);
        }
    }

    public function sendAnnualPlanReceiverToSender(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            //dd($request->all());
            $data = Validator::make($request->all(), [
                'fiscal_year_id' => 'required|integer',
                'annual_plan_main_id' => 'required|integer',
                'op_audit_calendar_event_id' => 'required|integer',
                'office_id' => 'required|integer',
                'activity_type' => 'required|string',
                'receiver_type' => 'required',
                'status' => 'required',
            ])->validate();

            $data['comments'] = $request->comments;
            $data['cdesk'] = $this->current_desk_json();

            $responseData = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_operational_plan.send_annual_plan_receiver_to_sender'), $data)->json();
//            dd($responseData);
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
