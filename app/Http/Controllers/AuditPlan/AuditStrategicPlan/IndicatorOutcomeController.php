<?php

namespace App\Http\Controllers\AuditPlan\AuditStrategicPlan;

use App\Models\IndicatorOutcome;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndicatorOutcomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('modules.audit_plan.strategic.indicator.outcome');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('modules.audit_plan.strategic.indicator.create_outcome_indicator');
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
     * @param  \App\Models\IndicatorOutcome  $indicatorOutcome
     * @return \Illuminate\Http\Response
     */
    public function show(IndicatorOutcome $indicatorOutcome)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\IndicatorOutcome  $indicatorOutcome
     * @return \Illuminate\Http\Response
     */
    public function edit(IndicatorOutcome $indicatorOutcome)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\IndicatorOutcome  $indicatorOutcome
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, IndicatorOutcome $indicatorOutcome)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IndicatorOutcome  $indicatorOutcome
     * @return \Illuminate\Http\Response
     */
    public function destroy(IndicatorOutcome $indicatorOutcome)
    {
        //
    }
}
