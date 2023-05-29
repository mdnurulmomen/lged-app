<?php

namespace App\Http\Controllers\AuditExecution;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuditExecutionAreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Areay|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $allProjects = $this->initHttpWithToken()->post(config('cag_rpu_api.get-all-projects'), [
            'all' => 1
        ])->json();

        $allProjects = $allProjects ? $allProjects['data'] : [];
        return view('modules.audit_execution.audit_execution_area.index',compact('allProjects'));
        // return view('modules.audit_execution.audit_execution_area.index');
    }

    public function getAuditAreaList(Request $request)
    {
        // dd($request->all());
        // dd(config('cag_rpu_api.areas'));

        $audit_area_list = $this->initHttpWithToken()->get(config('cag_rpu_api.areas'), [
            'sector_id' => $request->sector_id,
            'sector_type' => 'App\Models\Project',
            'with_parent' => 'all',
        ])->json();

        // dd($audit_area_list['data']);

        if ($audit_area_list['status'] == 'success') {
            $audit_area_list = $audit_area_list['data'];
            return view('modules.audit_execution.audit_execution_area.partials.list', compact('audit_area_list'));
        } else {
            return response()->json(['status' => 'error', 'data' => $audit_area_list]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $project_id = $request->project_id;
        $allProjects = $this->initHttpWithToken()->post(config('cag_rpu_api.get-all-projects'), [
            'all' => 1
        ])->json();
        $allProjects = $allProjects ? $allProjects['data'] : [];

        $allFunctions = $this->initHttpWithToken()->post(config('cag_rpu_api.functions.list'), [
            'all' => 1
        ])->json();
        $allFunctions = $allFunctions ? $allFunctions['data'] : [];

        $allMasterUnits = $this->initHttpWithToken()->post(config('cag_rpu_api.master_units.list'), [
            'all' => 1
        ])->json();
        $allMasterUnits = $allMasterUnits ? $allMasterUnits['data'] : [];

        $allAreas = $this->initHttpWithToken()->get(config('cag_rpu_api.areas'), [
            'all' => 1
        ])->json();
        $allAreas = $allAreas ? $allAreas['data'] : [];

        return view('modules.audit_execution.audit_execution_area.partials.create', compact(['project_id','allProjects', 'allFunctions', 'allMasterUnits', 'allAreas']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'sector_id' => 'required|integer',
            'sector_type' => 'required|string|in:App\Models\Project,App\Models\AuditFunction,App\Models\UnitMasterInfo',
            'name_en' => 'required|string|max:255',
            'name_bn' => 'required|string|max:255',
            'parent_id' => 'nullable|integer'
        ]);

        $currentUserId = $this->current_desk()['officer_id'];

        $data = [
            'sector_id' => $request->sector_id,
            'sector_type' => $request->sector_type,
            'name_en' => $request->name_en,
            'name_bn' => $request->name_bn,
            'parent_id' => $request->parent_id,
            'created_by' => $currentUserId,
            'updated_by' => $currentUserId,
        ];

        $create_audit_assessment = $this->initHttpWithToken()->post(config('cag_rpu_api.areas'), $data)->json();
        //    dd($create_audit_assessment);
        if (isset($create_audit_assessment['status']) && $create_audit_assessment['status'] == 'success') {
            return response()->json(responseFormat('success', 'Created Successfully'));
        } else {
            return response()->json(['status' => 'error', 'data' => $create_audit_assessment]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function auditAreaEdit(Request $request)
    {
        $id = $request->id;
        $sector_id = $request->sector_id;
        $sector_type = $request->sector_type;
        $name_en = $request->name_en;
        $name_bn = $request->name_bn;
        $parent_id = $request->parent_id;

        $allProjects = $this->initHttpWithToken()->post(config('cag_rpu_api.get-all-projects'), [
            'all' => 1
        ])->json();
        $allProjects = $allProjects ? $allProjects['data'] : [];

        $allFunctions = $this->initHttpWithToken()->post(config('cag_rpu_api.functions.list'), [
            'all' => 1
        ])->json();
        $allFunctions = $allFunctions ? $allFunctions['data'] : [];

        $allMasterUnits = $this->initHttpWithToken()->post(config('cag_rpu_api.master_units.list'), [
            'all' => 1
        ])->json();
        $allMasterUnits = $allMasterUnits ? $allMasterUnits['data'] : [];

        $allAreas = $this->initHttpWithToken()->get(config('cag_rpu_api.areas'), [
            'all' => 1
        ])->json();
        $allAreas = $allAreas ? $allAreas['data'] : [];

        return view('modules.audit_execution.audit_execution_area.partials.update', compact('id', 'sector_id', 'sector_type', 'name_en', 'name_bn', 'parent_id', 'allProjects', 'allFunctions', 'allMasterUnits', 'allAreas'));
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
        $request->validate([
            'id' => 'required|integer',
            'sector_id' => 'required|integer',
            'sector_type' => 'required|string|in:App\Models\Project,App\Models\AuditFunction,App\Models\UnitMasterInfo',
            'name_en' => 'required|string|max:255',
            'name_bn' => 'required|string|max:255',
            'parent_id' => 'nullable|integer|lt:id'
        ]);

        $data = [
            'id' => $request->id,
            'sector_id' => $request->sector_id,
            'sector_type' => $request->sector_type,
            'name_en' => $request->name_en,
            'name_bn' => $request->name_bn,
            'parent_id' => $request->parent_id,
            'updated_by' => $this->current_desk()['officer_id'],
        ];

        $update_audit_area = $this->initHttpWithToken()->put(config('cag_rpu_api.areas')."/$id", $data)->json();
//        dd($create_audit_query);
        if (isset($update_audit_area['status']) && $update_audit_area['status'] == 'success') {
            return response()->json(['status' => 'success', 'data' => $update_audit_area['data']]);
        } else {
            return response()->json(['status' => 'error', 'data' => $update_audit_area]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = [
            'id' => $id,
        ];
    //    dd($data);
        $delete_audit_area = $this->initHttpWithToken()->delete(config('cag_rpu_api.areas')."/$id", $data)->json();
        if (isset($delete_audit_area['status']) && $delete_audit_area['status'] == 'success') {
            return response()->json(responseFormat('success', 'Deleted Successfully'));
        } else {
            return response()->json(['status' => 'error', 'data' => $delete_audit_area]);
        }
    }
}
