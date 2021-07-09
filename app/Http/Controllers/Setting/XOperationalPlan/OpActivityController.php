<?php

namespace App\Http\Controllers\Setting\XOperationalPlan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OpActivityController extends Controller
{
    public function index()
    {
        return view('modules.settings.op.op_activity.activity_lists');
    }

    public function getActivityLists(Request $request)
    {
        $op_activities = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.op_activity_lists'), [
            'all' => 1
        ])->json();
        if ($op_activities['status'] == 'success') {
            $op_activities = $op_activities['data'];
            return view('modules.settings.op.op_activity.partials.get_activity_lists', compact('op_activities'));
        } else {
            return response()->json(['status' => 'error', 'data' => $op_activities]);
        }
    }

    public function create()
    {
        $data = $this->fetchRequiredData();
        $plan_durations = $data['plan_durations'];
        $plan_outputs = $data['plan_outputs'];
        $plan_outcomes = $data['plan_outcomes'];
        $op_activities = $data['op_activities'];

        return view('modules.settings.op.op_activity.create_op_activity', compact('op_activities', 'plan_outputs', 'plan_outcomes', 'plan_durations',));
    }

    public function fetchRequiredData(): array
    {
        $plan_durations = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.strategic_plan_duration_lists'), [
            'all' => 1
        ])->json();

        $plan_outcomes = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.strategic_plan_outcome_lists'), [
            'all' => 1
        ])->json();

        $plan_outputs = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.strategic_plan_output_lists'), [
            'all' => 1
        ])->json();

        $op_activities = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.op_activity_lists'), [
            'all' => 1
        ])->json();

        return [
            'plan_durations' => $plan_durations['data'] ?? [],
            'plan_outcomes' => $plan_outcomes['data'] ?? [],
            'plan_outputs' => $plan_outputs['data'] ?? [],
            'op_activities' => $op_activities['data'] ?? [],
        ];
    }

    public function store(Request $request)
    {
        $data = [
            'duration_id' => $request->duration_id,
            'outcome_id' => $request->outcome_id,
            'output_id' => $request->output_id,
            'activity_no' => $request->activity_no,
            'title_en' => $request->title_en,
            'title_bn' => $request->title_bn,
            'activity_parent_id' => $request->activity_parent_id ?? 0,
        ];
        $createActivity = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.op_activity_create'), $data)->json();

        if (isset($createActivity['status']) && $createActivity['status'] == 'success') {
            return response()->json(responseFormat('success', 'Created Successfully'));
        } else {
            return response()->json(['status' => 'error', 'data' => $createActivity]);
        }
    }

    public function edit($activity_id)
    {
        $data = $this->fetchRequiredData();
        $plan_durations = $data['plan_durations'];
        $plan_outputs = $data['plan_outputs'];
        $plan_outcomes = $data['plan_outcomes'];
        $op_activities = $data['op_activities'];
        $activity = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.op_activity_show'), [
            'activity_id' => $activity_id
        ])->json()['data'];
        return view('modules.settings.op.op_activity.edit_op_activity', compact('op_activities', 'plan_outputs', 'plan_outcomes', 'plan_durations', 'activity'));
    }

    public function update(Request $request, $activity_id)
    {
        $data = [
            'activity_id' => $activity_id,
            'duration_id' => $request->duration_id,
            'outcome_id' => $request->outcome_id,
            'output_id' => $request->output_id,
            'activity_no' => $request->activity_no,
            'title_en' => $request->title_en,
            'title_bn' => $request->title_bn,
            'activity_parent_id' => $request->activity_parent_id ?? 0,
        ];
        $updateActivity = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.op_activity_update'), $data)->json();

        if (isset($updateActivity['status']) && $updateActivity['status'] == 'success') {
            return response()->json(responseFormat('success', 'Updated Successfully'));
        } else {
            return response()->json(['status' => 'error', 'data' => $updateActivity]);
        }
    }

    public function destroy($activity_id)
    {
        $data = [
            'activity_id' => $activity_id,
        ];
        $deleteActivity = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.op_activity_delete'), $data)->json();

        if (isset($deleteActivity['status']) && $deleteActivity['status'] == 'success') {
            return response()->json(responseFormat('success', 'Deleted Successfully'));
        } else {
            return response()->json(['status' => 'error', 'data' => $deleteActivity]);
        }
    }
}
