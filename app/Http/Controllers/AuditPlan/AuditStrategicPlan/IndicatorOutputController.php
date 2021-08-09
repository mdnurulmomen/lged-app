<?php

namespace App\Http\Controllers\AuditPlan\AuditStrategicPlan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class IndicatorOutputController extends Controller
{

    public function outputs()
    {
        $data = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_strategic_plan.output_indicator_all'), [])->json();
        return view('modules.audit_plan.strategic.indicator.output_all', compact('data'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $indecators = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_strategic_plan.output_indicators'), [])->json();
        return view('modules.audit_plan.strategic.indicator.output', compact('indecators'));
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
        $plan_output = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.strategic_plan_output_lists'), [
            'all' => 1
        ])->json();
        $fiscal_years = $this->allFiscalYears();

        return view('modules.audit_plan.strategic.indicator.create_output_indicator', compact(
            'plan_durations',
            'plan_output',
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
            'output_id' => 'required|numeric',
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
            config('amms_bee_routes.audit_strategic_plan.output_indicator_create'),
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
     * @param  \App\Models\IndicatorOutput  $indicatorOutput
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = $this->initHttpWithToken()->post(
            config('amms_bee_routes.audit_strategic_plan.output_indicator_show'),
            ['id' => $id]
        )->json();

        $data = $data['data'];

        return view('modules.audit_plan.strategic.indicator.show_output_indicator', compact(
            'data'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\IndicatorOutput  $indicatorOutput
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $plan_durations = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.strategic_plan_duration_lists'), [
            'all' => 1
        ])->json();
        $plan_output = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.strategic_plan_output_lists'), [
            'all' => 1
        ])->json();
        $fiscal_years = $this->allFiscalYears();

        $data = $this->initHttpWithToken()->post(
            config('amms_bee_routes.audit_strategic_plan.output_indicator_show'),
            ['id' => $id]
        )->json();

        $data = $data['data'];

        return view('modules.audit_plan.strategic.indicator.edit_output_indicator', compact(
            'plan_durations',
            'plan_output',
            'fiscal_years',
            'data'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\IndicatorOutput  $indicatorOutput
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        Validator::make($request->all(), [
            'duration_id' => 'required|numeric',
            'output_id' => 'required|numeric',
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
            config('amms_bee_routes.audit_strategic_plan.output_indicator_update'),
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
     * @param  \App\Models\IndicatorOutput  $indicatorOutput
     * @return \Illuminate\Http\Response
     */
    public function destroy(IndicatorOutput $indicatorOutput)
    {
        //
    }
}
