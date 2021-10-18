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
        return view('modules.audit_execution.audit_execution_query.schedule_list');
    }

    public function loadQueryScheduleList(Request $request)
    {
//        $data['cdesk'] = json_encode_unicode($this->current_desk());
//        $data['fiscal_year_id'] = 1;
//        $audit_query_schedule_list = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.fiscal_year_lists'),$data)->json();
//        dd();
//        if ($audit_query_schedule_list['status'] == 'success') {
//            $audit_query_schedule_list = $audit_query_schedule_list['data'];
//            return view('modules.audit_execution.audit_execution_query.get_schedule_list', compact('audit_query_schedule_list'));
//        }
        return view('modules.audit_execution.audit_execution_query.get_shecule_llist');
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
