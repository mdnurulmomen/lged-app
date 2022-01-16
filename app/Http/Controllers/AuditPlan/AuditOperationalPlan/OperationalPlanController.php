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
//        dd($data);
        $data['cdesk'] = $this->current_desk_json();

        $event_list = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_operational_plan.op_yearly_event_lists'), $data)->json();
        //dd($event_list);
        /*if (isSuccess($event_list)) {
            $event_list = $event_list['data'];
            return view('modules.audit_plan.operational.approve_plan.partials.load_op_yearly_event_lists',compact('event_list'));
        } else {
            return response()->json(['status' => 'error', 'data' => $event_list]);
        }*/

        $event_list = $event_list['data'];
        return view('modules.audit_plan.operational.approve_plan.partials.load_op_yearly_event_lists',compact('event_list'));

    }

    public function loadOpYearlyEventApprovalForm(Request $request)
    {
        $fiscal_year_id = $request->fiscal_year_id;
        $op_audit_calendar_event_id = $request->op_audit_calendar_event_id;
        return view('modules.audit_plan.operational.approve_plan.partials.load_op_yearly_event_approval_form',
            compact('op_audit_calendar_event_id','fiscal_year_id'));
    }

    public function loadDirectorateWiseAnnualPlan(Request $request)
    {
        $data = Validator::make($request->all(), [
            'fiscal_year_id' => 'required|integer',
            'office_id' => 'required|integer',
        ])->validate();
        $data['cdesk'] = $this->current_desk_json();

        $plan_infos = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_annual_plan_revised.ap_yearly_plan_book'), $data)->json();

        /*$directorateInfo = $this->initDoptorHttp()->post(config('cag_doptor_api.offices'), ['office_ids' => $request->office_id])->json();
        $directorateInfo = $directorateInfo['status'] == 'success'?$directorateInfo['data']:[];
        dd($directorateInfo);*/

        if ($request->office_id == 19) {
            $directorate_address = 'অডিট কমপ্লেক্স,১ম তলা <br> সেগুনবাগিচা,ঢাকা-১০০০।';
        } elseif ($request->office_id == 32) {
            $directorate_address = 'অডিট কমপ্লেক্স (নিচ তলা ও ২য় তলা) <br> সেগুনবাগিচা,ঢাকা-১০০০।';
        } else {
            $directorate_address = 'অডিট কমপ্লেক্স (৭ম-৮ম তলা) <br> সেগুনবাগিচা,ঢাকা-১০০০।';
        }

        if (isSuccess($plan_infos)) {
            $plan_infos = $plan_infos['data'];
            return view('modules.audit_plan.annual.annual_plan_revised.partials.annual_plan_book', ['plan_infos' => $plan_infos,'directorate_address'=> $directorate_address], [], ['orientation' => 'L', 'format' => 'A4']);
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
                'op_audit_calendar_event_id' => 'required|integer',
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
