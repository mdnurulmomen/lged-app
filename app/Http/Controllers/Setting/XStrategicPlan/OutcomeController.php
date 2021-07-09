<?php

namespace App\Http\Controllers\Setting\XStrategicPlan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OutcomeController extends Controller
{
    public function index()
    {
        $plan_durations = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.strategic_plan_duration_lists'), [
            'all' => 1
        ])->json()['data'];

        return view('modules.settings.x_strategic_plan.outcome.outcome_lists', compact('plan_durations'));
    }

    public function getOutcomeLists()
    {
        $plan_outcomes = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.strategic_plan_outcome_lists'), [
            'all' => 1
        ])->json();

        if ($plan_outcomes['status'] == 'success') {
            $plan_outcomes = $plan_outcomes['data'];
            return view('modules.settings.x_strategic_plan.outcome.partials.get_outcome_lists', compact('plan_outcomes'));
        } else {
            return response()->json(['status' => 'error', 'data' => $plan_outcomes]);
        }
    }

    public function store(Request $request)
    {
        $data = [
            'duration_id' => $request->duration_id,
            'outcome_no' => $request->outcome_no,
            'outcome_title_en' => $request->outcome_title_en,
            'outcome_title_bn' => $request->outcome_title_bn,
            'remarks' => $request->remarks,
        ];
        $createPlanOutcome = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.strategic_plan_outcome_create'),
            $data)
            ->json();

        if (isset($createPlanOutcome['status']) && $createPlanOutcome['status'] == 'success') {
            return response()->json(responseFormat('success', 'Created Successfully'));
        } else {
            return response()->json(['status' => 'error', 'data' => $createPlanOutcome]);
        }
    }

    public function update(Request $request)
    {
        $data = [
            'outcome_id' => $request->outcome_id,
            'duration_id' => $request->duration_id,
            'outcome_no' => $request->outcome_no,
            'outcome_title_en' => $request->outcome_title_en,
            'outcome_title_bn' => $request->outcome_title_bn,
            'remarks' => $request->remarks,
        ];
        $updatePlanOutcome = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.strategic_plan_outcome_update'), $data)->json();

        if (isset($updatePlanOutcome['status']) && $updatePlanOutcome['status'] == 'success') {
            return response()->json(responseFormat('success', 'Updated Successfully'));
        } else {
            return response()->json(['status' => 'error', 'data' => $updatePlanOutcome]);
        }
    }

    public function destroy($outcome_id)
    {
        $data = [
            'outcome_id' => $outcome_id,
        ];
        $deletePlanOutcome = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.strategic_plan_outcome_delete'),
            $data)->json();

        if (isset($deletePlanOutcome['status']) && $deletePlanOutcome['status'] == 'success') {
            return response()->json(responseFormat('success', 'Deleted Successfully'));
        } else {
            return response()->json(['status' => 'error', 'data' => $deletePlanOutcome]);
        }
    }
}
