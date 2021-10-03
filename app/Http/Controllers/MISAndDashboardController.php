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
        Validator::make($request->all(), ['fiscal_year_id' => 'integer|required'])->validate();

        return view('modules.mis_dashboard.team_list.load_team_lists');
    }


}
