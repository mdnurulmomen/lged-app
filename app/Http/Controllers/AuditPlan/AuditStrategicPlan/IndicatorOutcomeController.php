<?php

namespace App\Http\Controllers\AuditPlan\AuditStrategicPlan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class IndicatorOutcomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $indecators = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_strategic_plan.outcome_indicators'), [])->json();
        return view('modules.audit_plan.strategic.indicator.outcome', compact('indecators'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $plan_durations = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.strategic_plan_duration_lists'), [
            'all' => 1
        ])->json();
        $plan_outcomes = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.strategic_plan_outcome_lists'), [
            'all' => 1
        ])->json();
        $fiscal_years = $this->allFiscalYears();

        return view('modules.audit_plan.strategic.indicator.create_outcome_indicator', compact(
            'plan_durations',
            'plan_outcomes',
            'fiscal_years'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'duration_id' => 'required|numeric',
            'outcome_id' => 'required|numeric',
            'name_en' => 'required',
            'name_bn' => 'required',
            'frequency_en' => 'required',
            'frequency_bn' => 'required',
            'datasource_en' => 'required',
            'datasource_bn' => 'required',
            'base_fiscal_year_id' => 'required|numeric',
            'base_value' => 'required',
            'fiscal_year_id.*' => 'required',
            'unit_type.*' => 'required',
        ])->validate();

        $response = $this->initHttpWithToken()->post(
            config('amms_bee_routes.audit_strategic_plan.outcome_indicator_create'),
            $request->all()
        )->json();

        if (isset($response['status']) && $response['status'] == 'success') {
            return response()->json(responseFormat('success', 'Saved Successfully'));
        } else {
            return response()->json(['status' => 'error', 'data' => $response]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\IndicatorOutcome  $indicatorOutcome
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $data = $this->initHttpWithToken()->post(
            config('amms_bee_routes.audit_strategic_plan.outcome_indicator_show'),
            ['id' => $id]
        )->json();

        $data = $data['data'];

        return view('modules.audit_plan.strategic.indicator.show_outcome_indicator', compact(
            'data'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\IndicatorOutcome  $indicatorOutcome
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $plan_durations = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.strategic_plan_duration_lists'), [
            'all' => 1
        ])->json();
        $plan_outcomes = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.strategic_plan_outcome_lists'), [
            'all' => 1
        ])->json();
        $fiscal_years = $this->allFiscalYears();

        $data = $this->initHttpWithToken()->post(
            config('amms_bee_routes.audit_strategic_plan.outcome_indicator_show'),
            ['id' => $id]
        )->json();

        $data = $data['data'];

        return view('modules.audit_plan.strategic.indicator.edit_outcome_indicator', compact(
            'plan_durations',
            'plan_outcomes',
            'fiscal_years',
            'data'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\IndicatorOutcome  $indicatorOutcome
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        Validator::make($request->all(), [
            'duration_id' => 'required|numeric',
            'outcome_id' => 'required|numeric',
            'name_en' => 'required',
            'name_bn' => 'required',
            'frequency_en' => 'required',
            'frequency_bn' => 'required',
            'datasource_en' => 'required',
            'datasource_bn' => 'required',
            'base_fiscal_year_id' => 'required|numeric',
            'base_value' => 'required',
            'fiscal_year_id.*' => 'required',
            'unit_type.*' => 'required',
        ])->validate();

        $response = $this->initHttpWithToken()->post(
            config('amms_bee_routes.audit_strategic_plan.outcome_indicator_update'),
            $request->all()
        )->json();

        if (isset($response['status']) && $response['status'] == 'success') {
            return response()->json(responseFormat('success', 'Saved Successfully'));
        } else {
            return response()->json(['status' => 'error', 'data' => $response]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IndicatorOutcome  $indicatorOutcome
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        //
    }
}
