<?php

namespace App\Http\Controllers\Setting\XStrategicPlan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DurationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        return view('modules.settings.x_strategic_plan.duration.duration_lists');
    }

    public function getDurationLists()
    {
        $plan_durations = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.strategic_plan_duration_lists'), [
            'all' => 1
        ])->json();
        if ($plan_durations['status'] == 'success') {
            $plan_durations = $plan_durations['data'];
            return view('modules.settings.x_strategic_plan.duration.partials.get_duration_lists', compact('plan_durations'));
        } else {
            return response()->json(['status' => 'error', 'data' => $plan_durations]);
        }
    }

    public function store(Request $request)
    {
        $data = [
            'start_year' => $request->start_year,
            'end_year' => $request->end_year,
            'remarks' => $request->remarks,
        ];
        $createPlanDuration = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.strategic_plan_duration_create'), $data)->json();

        if (isset($createPlanDuration['status']) && $createPlanDuration['status'] == 'success') {
            return response()->json(responseFormat('success', 'Created Successfully'));
        } else {
            return response()->json(['status' => 'error', 'data' => $createPlanDuration]);
        }
    }

    public function update(Request $request)
    {
        $data = [
            'duration_id' => $request->plan_duration_id,
            'start_year' => $request->start_year,
            'end_year' => $request->end_year,
            'remarks' => $request->remarks,
        ];
        $updatePlanDuration = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.strategic_plan_duration_update'), $data)->json();

        if (isset($updatePlanDuration['status']) && $updatePlanDuration['status'] == 'success') {
            return response()->json(responseFormat('success', 'Updated Successfully'));
        } else {
            return response()->json(['status' => 'error', 'data' => $updatePlanDuration]);
        }
    }

    public function destroy($duration_id)
    {
        $data = [
            'duration_id' => $duration_id,
        ];
        $deletePlanDuration = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.strategic_plan_duration_delete'), $data)->json();

        if (isset($deletePlanDuration['status']) && $deletePlanDuration['status'] == 'success') {
            return response()->json(responseFormat('success', 'Deleted Successfully'));
        } else {
            return response()->json(['status' => 'error', 'data' => $deletePlanDuration]);
        }
    }
}
