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
        $all_directorates = $this->allAuditDirectorates();
        $self_directorate = current(array_filter($all_directorates, function ($item) {
            return $this->current_office_id() == $item['office_id'];
        }));
        $directorates = $self_directorate ? [$self_directorate] : $all_directorates;
        $fiscal_years = $this->allFiscalYears();
        $individual_strategic_plan_year = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_yearly_plan.get_individual_yearly_plan_year'))->json();
        if (isSuccess($individual_strategic_plan_year)) {
            $individual_strategic_plan_year = $individual_strategic_plan_year['data'];
            return view('modules.audit_execution.audit_schedule.index',compact('directorates','fiscal_years','individual_strategic_plan_year'));
        } else {
            return response()->json(['status' => 'error', 'data' => $individual_strategic_plan_year]);
        }
    }

    public function loadAuditScheduleList(Request $request)
    {
        $data['fiscal_year_id'] = $request->fiscal_year_id;
        $data['strategic_plan_year'] = $request->strategic_plan_year;
        $data['activity_id'] = $request->activity_id;
        $data['audit_plan_id'] = $request->audit_plan_id;
        $data['page'] = $request->page;
        $data['per_page'] = $request->per_page;
        $data['cdesk'] = $this->current_desk_json();
        $audit_query_schedule_list = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.get_query_schedule_list'), $data)->json();
        // dd($audit_query_schedule_list['data']);
        if ($audit_query_schedule_list['status'] == 'success') {
            $audit_query_schedule_list = $audit_query_schedule_list['data'];
            // dd($audit_query_schedule_list);
            return view('modules.audit_execution.audit_schedule.partials.load_audit_schedule_list',
                compact('audit_query_schedule_list'));
        } else {
            return response()->json(['status' => 'error', 'data' => $audit_query_schedule_list]);
        }
    }
}
