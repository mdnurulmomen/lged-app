<?php

namespace App\Http\Controllers\AuditPlan\AuditOperationalPlan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuditCalendarController extends Controller
{
    public function index()
    {
        $fiscal_years = $this->allFiscalYears();
        $responsible_offices = $this->allResponsibleOffices();

        return view('modules.audit_plan.operational.audit_calendar.operational_calendar', compact('fiscal_years', 'responsible_offices'));
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function showScheduleMilestoneByFiscalYear(Request $request)
    {
        Validator::make($request->all(), [
            'fiscal_year_id' => 'required|integer',
        ])->validate();
        $fiscal_year_id = $request->fiscal_year_id;
        $activityMilestones = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_operational_plan.op_calendar_milestone_lists'), ['fiscal_year_id' => $fiscal_year_id])->json();
        if ($activityMilestones['status'] = 'success') {
            $activityMilestones = $activityMilestones['data'];
            return view('modules.audit_plan.operational.audit_calendar.partials.load_schedule_milestones', compact('activityMilestones'));
        } else {
            return response()->json(['status' => 'error', 'data' => 'Sorry!']);
        }
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateMilestoneTargetDate(Request $request)
    {
        Validator::make($request->all(), [
            'yearly_audit_calendar_id' => 'required|integer',
            'milestone_id' => 'required|integer',
            'target_date' => 'required|date',
        ])->validate();

        $data = ['target_date' => $request->target_date, "milestone_id" => $request->milestone_id, "yearly_audit_calendar_id" => $request->yearly_audit_calendar_id];

        $updateMilestoneDate = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_operational_plan.op_calendar_milestone_target_date_update'), $data)->json();

        if ($updateMilestoneDate['status'] = 'success') {
            return response()->json(['status' => 'success', 'data' => 'Updated!']);
        } else {
            return response()->json(['status' => 'error', 'data' => 'Sorry!']);
        }

    }

    public function createActivityResponsible(Request $request)
    {
        $data = Validator::make($request->all(), [
            'activity_id' => 'required|integer',
            'selected_office_ids' => 'required|array',
        ])->validate();

        $addResponsibles = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_operational_plan.op_calendar_responsible_assign'), $data)->json();

        if ($addResponsibles['status'] == 'success') {
            return response()->json(['status' => 'success', 'data' => 'Successfully Added.']);
        } else {
            return response()->json(['status' => 'error', 'data' => $addResponsibles]);
        }
    }

    public function showAuditCalendarPrintView(Request $request)
    {
        Validator::make($request->all(), [
            'fiscal_year' => 'required|integer',
        ])->validate();
        $fiscal_year_id = $request->fiscal_year;
        $activityMilestones = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_operational_plan.op_calendar_milestone_lists'), ['fiscal_year_id' => $fiscal_year_id])->json();
        $fiscal_year = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.fiscal_year_show'), ['fiscal_year_id' => $fiscal_year_id])->json()['data'];
//        dd($activityMilestones);
        if ($activityMilestones['status'] = 'success') {
            $activityMilestones = $activityMilestones['data'];
            return view('modules.audit_plan.operational.audit_calendar.partials.load_audit_calendar_print_view', compact('activityMilestones', 'fiscal_year'));
        } else {
            return response()->json(['status' => 'error', 'data' => 'Sorry!']);
        }

    }
}
