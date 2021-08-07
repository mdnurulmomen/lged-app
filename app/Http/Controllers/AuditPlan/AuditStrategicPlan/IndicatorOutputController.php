<?php

namespace App\Http\Controllers\AuditPlan\AuditStrategicPlan;

use App\Models\IndicatorOutput;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndicatorOutputController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('modules.audit_plan.strategic.indicator.output');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('modules.audit_plan.strategic.indicator.create_output_indicator');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\IndicatorOutput  $indicatorOutput
     * @return \Illuminate\Http\Response
     */
    public function show(IndicatorOutput $indicatorOutput)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\IndicatorOutput  $indicatorOutput
     * @return \Illuminate\Http\Response
     */
    public function edit(IndicatorOutput $indicatorOutput)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\IndicatorOutput  $indicatorOutput
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, IndicatorOutput $indicatorOutput)
    {
        //
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
