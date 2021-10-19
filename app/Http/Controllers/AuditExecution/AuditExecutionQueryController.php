<?php

namespace App\Http\Controllers\AuditExecution;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuditExecutionQueryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        return view('modules.audit_execution.audit_execution_query.index');
    }

    public function queryScheduleList()
    {
        return view('modules.audit_execution.audit_execution_query.query_schedule_list');
    }

    public function loadQueryScheduleList(Request $request)
    {
        $data['cdesk'] = json_encode_unicode($this->current_desk());
        $data['fiscal_year_id'] = 1;
        $audit_query_schedule_list = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.get_query_schedule_list'), $data)->json();
        if ($audit_query_schedule_list['status'] == 'success') {
            $audit_query_schedule_list = $audit_query_schedule_list['data'];
            return view('modules.audit_execution.audit_execution_query.get_query_schedule_list', compact('audit_query_schedule_list'));
        } else {
            return response()->json(['status' => 'error', 'data' => $audit_query_schedule_list]);
        }
    }

    public function selectAuditQuery(Request $request)
    {
        $cost_center_types = $this->allCostCenterType();
        return view('modules.audit_execution.audit_execution_query.select_audit_query', compact('cost_center_types'));
    }

    public function costCenterTypeWiseQuery(Request $request)
    {
        $data['cost_center_type_id'] = $request->cost_center_type_id;
        $audit_query_list = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.get_cost_center_type_wise_query'), $data)->json();
        $cost_center_types = $this->allCostCenterType();
        if ($audit_query_list['status'] == 'success') {
            $audit_query_list = $audit_query_list['data'];
            return view('modules.audit_execution.audit_execution_query.get_query_list', compact('audit_query_list', 'cost_center_types'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
