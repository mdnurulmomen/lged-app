<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MISAndDashboardController extends Controller
{
    public function index()
    {
        return view('modules.mis_dashboard.index');
    }

    public function rpuListIndex()
    {
        $directorates = $this->allAuditDirectorates();
        $fiscal_years = $this->allFiscalYears();
        return view('modules.mis_dashboard.rpu_list.mis_rpu_lists', compact('directorates','fiscal_years'));
    }

    public function loadRpuLists(Request $request)
    {
//        $data = Validator::make($request->all(), ['directorate_id' => 'integer|required'])->validate();
        $data['directorate_id'] = $request->directorate_id;
        $data['office_ministry_id'] = $request->office_ministry_id;
        $data['audit_due_year'] = $request->audit_due_year;
        $data['risk_category'] = $request->risk_category;
        $all_rpu_list_mis = $this->initRPUHttp()->post(config('cag_rpu_api.get-rpu-list-mis'), $data)->json();
        if (isSuccess($all_rpu_list_mis)) {
            $all_rpu_list_mis = $all_rpu_list_mis['data'];
            return view('modules.mis_dashboard.rpu_list.load_rpu_lists', compact('all_rpu_list_mis','data'));
        } else {
            return response()->json(['status' => 'error', 'data' => $all_rpu_list_mis]);
        }

    }

    public function teamListIndex()
    {
        $fiscal_years = $this->allFiscalYears();
        return view('modules.mis_dashboard.team_list.mis_team_lists', compact('fiscal_years'));
    }

    public function loadTeamLists(Request $request)
    {
        $data = Validator::make($request->all(), ['fiscal_year_id' => 'integer|required'])->validate();
        $data['cdesk'] = $this->current_desk_json();

        $all_teams = $this->initHttpWithToken()->post(config('amms_bee_routes.mis_and_dashboard.all_team_lists'), $data)->json();
        if (isSuccess($all_teams)) {
            $all_teams = $all_teams['data'];
            return view('modules.mis_dashboard.team_list.load_team_lists', compact('all_teams'));
        } else {
            return response()->json(['status' => 'error', 'data' => $all_teams]);
        }

    }

    public function derictorateWiseMinistry(Request $request)
    {
        $data = Validator::make($request->all(), ['directorate_id' => 'integer|required'])->validate();
        $all_ministrys = $this->initRPUHttp()->post(config('cag_rpu_api.get-directorate-wise-ministry-list'), $data)->json();
        if (isSuccess($all_ministrys)) {
            $all_ministrys = $all_ministrys['data'];
            return view('modules.mis_dashboard.derictorate_wise_ministry_select', compact('all_ministrys'));
        } else {
            return response()->json(['status' => 'error', 'data' => $all_ministrys]);
        }
    }

    public function loadFiscalYearWiseTeam(Request $request)
    {
        $data['office_id'] = $request->office_id;
        $data['fiscal_year_id'] = $request->fiscal_year_id;
        $data['cdesk'] = $this->current_desk_json();
        $all_teams = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_visit_plan_calendar.get_fiscal_year_wise_team'), $data)->json();
//        dd($all_teams);
        if (isSuccess($all_teams)) {
            $all_teams = $all_teams['data'];
            return view('modules.mis_dashboard.team_list.fiscal_year_team_info', compact('all_teams'));
        } else {
            return response()->json(['status' => 'error', 'data' => $all_teams]);
        }
    }

}
