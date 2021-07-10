<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class XFiscalYearController extends Controller
{
    public function index()
    {
        $strategic_durations = $this->strategicPlanDurations();
        return view('modules.settings.x_fiscal_year.x_fiscal_year_lists', compact('strategic_durations'));
    }

    public function getFiscalYearLists(Request $request)
    {
        $fiscal_years = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.fiscal_year_lists'), [
            'all' => 1
        ])->json();
        if ($fiscal_years['status'] == 'success') {
            $fiscal_years = $fiscal_years['data'];
            return view('modules.settings.x_fiscal_year.partials.get_fiscal_year_lists', compact('fiscal_years'));
        } else {
            return response()->json(['status' => 'error', 'data' => $fiscal_years]);
        }
    }

    public function store(Request $request)
    {
        $data = [
            'duration_id' => $request->duration_id,
            'start_year' => $request->start_year,
            'end_year' => $request->end_year,
            'description' => $request->description,
        ];
        $create_fiscal_year = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.fiscal_year_create'), $data)->json();

        if (isset($create_fiscal_year['status']) && $create_fiscal_year['status'] == 'success') {
            return response()->json(responseFormat('success', 'Created Successfully'));
        } else {
            return response()->json(['status' => 'error', 'data' => $create_fiscal_year]);
        }
    }

    public function update(Request $request)
    {
        $data = [
            'fiscal_year_id' => $request->fiscal_year_id,
            'duration_id' => $request->duration_id,
            'start_year' => $request->start_year,
            'end_year' => $request->end_year,
            'description' => $request->description,
        ];
        $create_fiscal_year = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.fiscal_year_update'), $data)->json();

        if (isset($create_fiscal_year['status']) && $create_fiscal_year['status'] == 'success') {
            return response()->json(responseFormat('success', 'Updated Successfully'));
        } else {
            return response()->json(['status' => 'error', 'data' => $create_fiscal_year]);
        }
    }

    public function destroy($fiscal_year_id)
    {
        $data = [
            'fiscal_year_id' => $fiscal_year_id,
        ];
        $create_fiscal_year = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.fiscal_year_delete'), $data)->json();

        if (isset($create_fiscal_year['status']) && $create_fiscal_year['status'] == 'success') {
            return response()->json(responseFormat('success', 'Updated Successfully'));
        } else {
            return response()->json(['status' => 'error', 'data' => $create_fiscal_year]);
        }
    }
}
