<?php

namespace App\Http\Controllers\Setting\XStrategicPlan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OutputController extends Controller
{
    public function index()
    {
        $plan_durations = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.strategic_plan_duration_lists'), [
            'all' => 1
        ])->json()['data'];

        $plan_outcomes = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.strategic_plan_outcome_lists'), [
            'all' => 1
        ])->json()['data'];

        return view('modules.settings.x_strategic_plan.output.output_lists', compact('plan_durations', 'plan_outcomes'));
    }

    public function getOutputLists()
    {
        $plan_outputs = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.strategic_plan_output_lists'), [
            'all' => 1
        ])->json();

        if ($plan_outputs['status'] == 'success') {
            $plan_outputs = $plan_outputs['data'];
            return view('modules.settings.x_strategic_plan.output.partials.get_output_lists', compact('plan_outputs'));
        } else {
            return response()->json(['status' => 'error', 'data' => $plan_outputs]);
        }
    }

    public function store(Request $request)
    {
        $data = [
            'duration_id' => $request->duration_id,
            'outcome_id' => $request->outcome_id,
            'output_no' => $request->output_no,
            'output_title_en' => $request->output_title_en,
            'output_title_bn' => $request->output_title_bn,
            'remarks' => $request->remarks,
        ];
        $createPlanOutput = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.strategic_plan_output_create'),
            $data)
            ->json();

        if (isset($createPlanOutput['status']) && $createPlanOutput['status'] == 'success') {
            return response()->json(responseFormat('success', 'Created Successfully'));
        } else {
            return response()->json(['status' => 'error', 'data' => $createPlanOutput]);
        }
    }

    public function update(Request $request)
    {
        $data = [
            'output_id' => $request->output_id,
            'outcome_id' => $request->outcome_id,
            'duration_id' => $request->duration_id,
            'output_no' => $request->output_no,
            'output_title_en' => $request->output_title_en,
            'output_title_bn' => $request->output_title_bn,
            'remarks' => $request->remarks,
        ];
        $updatePlanOutput = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.strategic_plan_output_update'), $data)->json();

        if (isset($updatePlanOutput['status']) && $updatePlanOutput['status'] == 'success') {
            return response()->json(responseFormat('success', 'Updated Successfully'));
        } else {
            return response()->json(['status' => 'error', 'data' => $updatePlanOutput]);
        }
    }

    public function destroy($output_id)
    {
        $data = [
            'output_id' => $output_id,
        ];
        $deletePlanOutput = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.strategic_plan_output_delete'),
            $data)->json();

        if (isset($deletePlanOutput['status']) && $deletePlanOutput['status'] == 'success') {
            return response()->json(responseFormat('success', 'Deleted Successfully'));
        } else {
            return response()->json(['status' => 'error', 'data' => $deletePlanOutput]);
        }
    }
}
