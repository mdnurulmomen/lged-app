<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuditUniverseController extends Controller
{
    public function index()
    {
        $this->userPermittedMenusByModule(request()->path());
        return view('modules.audit_universe.index');
    }

    public function auditFieldOffices(Request $request)
    {
        $field_offices = $this->initRPUHttp()->post(config('cag_rpu_api.get-ministry-parent-wise-child-office'), [])->json();
        // dd($field_offices);
        if (isSuccess($field_offices)) {
            $field_offices = $field_offices['data'];
            // dd($field_offices);
            return view('modules.audit_universe.partial.field_offices', compact('field_offices'));
        } else {
            return response()->json(['status' => 'error', 'data' => $field_office]);
        }
    }

    public function auditUniverseProjects(Request $request)
    {
        $all_projects = $this->initRPUHttp()->post(config('cag_rpu_api.get-all-projects'), [])->json();
        if (isSuccess($all_projects)) {
            $all_projects = $all_projects['data'];
            return view('modules.audit_universe.partial.projects', compact('all_projects'));
        } else {
            return response()->json(['status' => 'error', 'data' => $all_projects]);
        }
    }

    public function auditUniverseFunctions(Request $request)
    {
        $allFunctions = $this->initHttpWithToken()->post(config('cag_rpu_api.functions.list'), [
            'all' => 1
        ])->json();
        if (isSuccess($allFunctions)) {
            $allFunctions = $allFunctions['data'];
            return view('modules.audit_universe.partial.functions', compact('allFunctions'));
        } else {
            return response()->json(['status' => 'error', 'data' => $allFunctions]);
        }
    }

    public function auditUniverseUnits(Request $request)
    {
        $allMasterUnits = $this->initHttpWithToken()->post(config('cag_rpu_api.master_units.list'), [
            'all' => 1
        ])->json();
        if (isSuccess($allMasterUnits)) {
            $allMasterUnits = $allMasterUnits['data'];
            return view('modules.audit_universe.partial.units', compact('allMasterUnits'));
        } else {
            return response()->json(['status' => 'error', 'data' => $allMasterUnits]);
        }
    }
}
