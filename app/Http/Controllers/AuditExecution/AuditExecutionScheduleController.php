<?php

namespace App\Http\Controllers\AuditExecution;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuditExecutionScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        /*return view('modules.audit_execution.audit_execution_query.index');*/
    }

    public function auditSchedule()
    {
        $fiscal_years = $this->allFiscalYears();
        return view('modules.audit_execution.audit_schedule.index',compact('fiscal_years'));
    }

    public function loadAuditScheduleList(Request $request)
    {

        $data['fiscal_year_id'] = $request->fiscal_year_id;
        $data['activity_id'] = $request->activity_id;

        $data['cdesk'] = $this->current_desk_json();
        $audit_query_schedule_list = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.get_query_schedule_list'), $data)->json();
//        dd($audit_query_schedule_list);
        if ($audit_query_schedule_list['status'] == 'success') {
            $audit_query_schedule_list = $audit_query_schedule_list['data'];
            return view('modules.audit_execution.audit_schedule.partials.load_audit_schedule_list',
                compact('audit_query_schedule_list'));
        } else {
            return response()->json(['status' => 'error', 'data' => $audit_query_schedule_list]);
        }
    }
}
