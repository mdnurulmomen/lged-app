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

    public function teamListIndex()
    {
        $fiscal_years = $this->allFiscalYears();
        return view('modules.mis_dashboard.team_list.mis_team_lists', compact('fiscal_years'));
    }

    public function loadTeamLists(Request $request)
    {
        $data = Validator::make($request->all(), ['fiscal_year_id' => 'integer|required'])->validate();

        $all_teams = $this->initHttpWithToken()->post(config('amms_bee_routes.mis_and_dashboard.all_team_lists'), $data)->json();
        if (isSuccess($all_teams)) {
            $all_teams = $all_teams['data'];
            return view('modules.mis_dashboard.team_list.load_team_lists', compact('all_teams'));
        } else {
            return response()->json(['status' => 'error', 'data' => $all_teams]);
        }

    }


}
