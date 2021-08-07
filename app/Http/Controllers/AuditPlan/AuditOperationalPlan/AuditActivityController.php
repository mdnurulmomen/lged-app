<?php

namespace App\Http\Controllers\AuditPlan\AuditOperationalPlan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuditActivityController extends Controller
{
    public function index()
    {
        $activities = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_operational_plan.op_activity_lists'), ['all' => 1])->json();

        if (array_key_exists('status', $activities) && $activities['status'] == 'success') {
            $activities = $activities['data'];
            return view('modules.audit_plan.operational.audit_activity.annual_audit_activity_lists', compact('activities'));
        } else {
            return response()->json(['status' => 'error', 'data' => $activities]);
        }
    }

    public function create()
    {
        $fiscal_years = $this->allFiscalYears();
        $strategic_outcomes = $this->allStrategicPlanOutcomes();
        return view('modules.audit_plan.operational.audit_activity.create_annual_audit_activity', compact('fiscal_years', 'strategic_outcomes'));
    }

    public function loadOutputsByOutcome(Request $request)
    {
        $outcome_id = $request->outcome_id;
        $outputs = $this->strategicPlanOutputByOutcome($outcome_id);
        return view('modules.audit_plan.operational.audit_activity.partials.load_outputs_by_outcome', compact('outputs'));
    }

    public function loadCreateOutputActivityTree(Request $request)
    {
        $output_id = $request->output_id;
        $outcome_id = $request->outcome_id;
        $fiscal_year_id = $request->fiscal_year_id;

        $data = [];

        isset($output_id) ? $data['output_id'] = $output_id : '';
        isset($outcome_id) ? $data['outcome_id'] = $outcome_id : '';
        isset($fiscal_year_id) ? $data['fiscal_year_id'] = $fiscal_year_id : '';

        $activity_lists = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_operational_plan.op_activity_find'), $data)->json();

        return view('modules.audit_plan.operational.audit_activity.partials.load_created_activities', compact('fiscal_year_id', 'output_id', 'activity_lists', 'outcome_id'));
    }

    public function loadEditActivityTree(Request $request)
    {
        $output_id = $request->output_id;
        $outcome_id = $request->outcome_id;
        $fiscal_year_id = $request->fiscal_year_id;

        $data = [];

        isset($output_id) ? $data['output_id'] = $output_id : '';
        isset($outcome_id) ? $data['outcome_id'] = $outcome_id : '';
        isset($fiscal_year_id) ? $data['fiscal_year_id'] = $fiscal_year_id : '';

        $activity_lists = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_operational_plan.op_activity_find'), $data)->json();

        return view('modules.audit_plan.operational.audit_activity.partials.load_edit_activities', compact('fiscal_year_id', 'output_id', 'activity_lists', 'outcome_id'));
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = Validator::make($request->all(), [
            'activity_parent_id' => 'integer|required',
            'activity_no' => 'required',
            'title_en' => 'required',
            'title_bn' => 'required',
            'output_id' => 'integer|required',
            'outcome_id' => 'integer|required',
            'fiscal_year_id' => 'integer|required',
            'activity_type' => 'required',
        ])->validate();

        $create_activity = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_operational_plan.op_activity_create'), $data)->json();

        if ($create_activity['status'] == 'success') {
            return response()->json(['status' => 'success', 'data' => 'Successfully Created']);
        } else {
            return response()->json(['status' => 'error', 'data' => $create_activity]);
        }
    }

    public function storeMilestone(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = ['activity_id' => $request->activity_id, 'output_id' => $request->output_id, 'outcome_id' => $request->outcome_id, 'fiscal_year_id' => $request->fiscal_year_id, 'title_en' => $request->title_en, 'title_bn' => $request->title_bn];

        $create_milestone = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_operational_plan.op_activity_milestone_create'), $data)->json();

        if ($create_milestone['status'] == 'success') {
            return response()->json(['status' => 'success', 'data' => 'Successfully Created']);
        } else {
            return response()->json(['status' => 'error', 'data' => $create_milestone]);
        }
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function show(Request $request)
    {
        Validator::make($request->all(), ['fiscal_year_id' => 'integer|required'])->validate();
        $activity_lists = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_operational_plan.op_activity_by_fiscal_year'), ['fiscal_year_id' => $request->fiscal_year_id])->json();
        if (isSuccess($activity_lists)) {
            return view('modules.audit_plan.operational.audit_activity.view_annual_audit_activity', compact('activity_lists'));
        } else {
            return response()->json(['status' => 'error', 'data' => $activity_lists]);
        }
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function showActivityMilestones(Request $request)
    {
        Validator::make($request->all(), ['activity_id' => 'integer|required'])->validate();
        $milestones = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_operational_plan.op_activity_milestones_load'), ['activity_id' => $request->activity_id])->json();
        if (isSuccess($milestones)) {
            return view('modules.audit_plan.operational.audit_activity.partials.load_activity_milestones', compact('milestones'));
        } else {
            return response()->json(['status' => 'error', 'data' => $milestones]);
        }
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function edit(Request $request)
    {
        Validator::make($request->all(), ['fiscal_year_id' => 'integer|required'])->validate();
        $strategic_outcomes = $this->allStrategicPlanOutcomes();
        $fiscal_year_id = $request->fiscal_year_id;
        $activity_lists = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_operational_plan.op_activity_find'), ['fiscal_year_id' => $request->fiscal_year_id])->json();
        if (isSuccess($activity_lists)) {
            return view('modules.audit_plan.operational.audit_activity.edit_annual_audit_activity', compact('activity_lists', 'strategic_outcomes', 'fiscal_year_id'));
        } else {
            return response()->json(['status' => 'error', 'data' => $activity_lists]);
        }
    }

    public function update(Request $request, $activity_id): \Illuminate\Http\JsonResponse
    {
        $data = ['activity_id' => $activity_id, 'duration_id' => $request->duration_id, 'outcome_id' => $request->outcome_id, 'output_id' => $request->output_id, 'activity_no' => $request->activity_no, 'title_en' => $request->title_en, 'title_bn' => $request->title_bn, 'activity_parent_id' => $request->activity_parent_id ?? 0,];
        $updateActivity = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.op_activity_update'), $data)->json();

        if (isset($updateActivity['status']) && $updateActivity['status'] == 'success') {
            return response()->json(responseFormat('success', 'Updated Successfully'));
        } else {
            return response()->json(['status' => 'error', 'data' => $updateActivity]);
        }
    }

    public function destroy($activity_id): \Illuminate\Http\JsonResponse
    {
        $data = ['activity_id' => $activity_id,];
        $deleteActivity = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.op_activity_delete'), $data)->json();

        if (isset($deleteActivity['status']) && $deleteActivity['status'] == 'success') {
            return response()->json(responseFormat('success', 'Deleted Successfully'));
        } else {
            return response()->json(['status' => 'error', 'data' => $deleteActivity]);
        }
    }
}
