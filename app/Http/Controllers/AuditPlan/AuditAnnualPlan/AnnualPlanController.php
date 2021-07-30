<?php

namespace App\Http\Controllers\AuditPlan\AuditAnnualPlan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AnnualPlanController extends Controller
{
    public function index()
    {
        $fiscal_years = $this->allFiscalYears();
        return view('modules.audit_plan.annual.annual_plan.annual_plan_lists', compact('fiscal_years'));
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function showAnnualPlanLists(Request $request)
    {
        $data = Validator::make($request->all(), [
            'fiscal_year_id' => 'required|integer',
        ])->validate();
        $data['cdesk'] = json_encode($this->current_desk());

        $annual_plans = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_annual_plan.ap_yearly_plan_lists'), $data)->json();

        if (isSuccess($annual_plans)) {
            $annual_plans = $annual_plans['data'];
            return view('modules.audit_plan.annual.annual_plan.partials.load_annual_plan_lists', compact('annual_plans'));
        } else {
            return response()->json(['status' => 'error', 'data' => $annual_plans]);
        }

    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function showEntitySelection(Request $request)
    {
        $data = Validator::make($request->all(), [
            'activity_id' => 'required|integer',
            'schedule_id' => 'required|integer',
            'milestone_id' => 'required|integer',
        ])->validate();
        $data['cdesk'] = json_encode($this->current_desk());

        $activity_id = $request->activity_id;
        $schedule_id = $request->schedule_id;
        $milestone_id = $request->milestone_id;

        return view('modules.audit_plan.annual.annual_plan.show_annual_entity_selection', compact('activity_id', 'schedule_id', 'milestone_id'));
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function showSelectedAuditeeEntities(Request $request)
    {
        $data = Validator::make($request->all(), [
            'activity_id' => 'required|integer',
            'schedule_id' => 'required|integer',
            'milestone_id' => 'required|integer',
        ])->validate();
        $data['cdesk'] = json_encode($this->current_desk());

        return view('modules.audit_plan.annual.annual_plan.partials.load_selected_auditee_entities');
    }

    public function showAnnualSubmissionHRModal(Request $request)
    {
        $officer_lists = $this->cagDoptorOfficeUnitDesignationEmployees($this->current_office_id());

        return view('modules.audit_plan.annual.annual_plan.partials.load_annual_plan_submission_hr_modal', compact('officer_lists'));
    }
}
