<?php

namespace App\Http\Controllers\AuditPlan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuditProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd($request->all());
        $data =  $request->validate([
            'project_id' => 'nullable|integer',
            'project_name_en' => 'nullable|string',
            'audit_plan_id' => 'required|integer',
            'yearly_plan_id' => 'nullable|integer',
            'yearly_plan_location_id' => 'required|integer',
            'plan_year' => 'required|integer',
            'type' => 'nullable',
        ]);

        $data['team_id'] = ''; 

//      dd($data);  

//        $allProjects = $this->initHttpWithToken()->post(config('cag_rpu_api.get-all-projects'), [
//            'all' => 1
//        ])->json();
//
//        $allProjects = $allProjects ? $allProjects['data'] : [];
//
//        $allFunctions = $this->initHttpWithToken()->post(config('cag_rpu_api.functions.list'), [
//            'all' => 1
//        ])->json();
//        $allFunctions = $allFunctions ? $allFunctions['data'] : [];
//
//        $allMasterUnits = $this->initHttpWithToken()->post(config('cag_rpu_api.master_units.list'), [
//            'all' => 1
//        ])->json();
//        $allMasterUnits = $allMasterUnits ? $allMasterUnits['data'] : [];

        return view('modules.audit_plan.program.index',compact('data'));
    }

    public function programIndex(Request $request)
    {
        $data =  $request->validate([
            'project_id' => 'nullable|integer',
            'project_name_en' => 'nullable|string',
            'project_name_bn' => 'nullable|string',
            'audit_plan_id' => 'nullable|integer',
            'yearly_plan_id' => 'nullable|integer',
            'yearly_plan_location_id' => 'nullable|integer',
            'plan_year' => 'nullable|integer',
            'type' => 'nullable',
        ]);
        $data['team_id'] = $request->team_id; 
        $data['audit_plan_id'] = $request->audit_plan_id; 
        // dd($data);

        return view('modules.audit_plan.program.index',compact('data'));
    }

    public function getAuditProgramList(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'audit_area_id' => 'required|integer',
        ]);

        $type = $request->type ? $request->type : '' ;

        $sectorAreaPrograms = $this->initHttpWithToken()->get(config('amms_bee_routes.audit_plan.sector_area_programs'), $request->all())->json();

        // dd($sectorAreaPrograms);
        $audit_plan_id = $request->audit_plan_id;
        $team_id = $request->team_id;

        // dd($audit_plan_id, $team_id);

        if ($sectorAreaPrograms['status'] == 'success') {
            $sectorAreaPrograms = $sectorAreaPrograms['data'];
            // dd($sectorAreaPrograms);
            return view('modules.audit_plan.program.partials.list', compact('sectorAreaPrograms','audit_plan_id','team_id','type'));
        } else {
            return response()->json(['status' => 'error', 'data' => $sectorAreaPrograms]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data =  $request->validate([
            'project_id' => 'nullable|integer',
            'project_name_en' => 'nullable|string',
            'audit_plan_id' => 'required|integer',
            'yearly_plan_id' => 'nullable|integer',
            'yearly_plan_location_id' => 'required|integer',
            'plan_year' => 'nullable|integer',
        ]);

//        dd($data);

//        $allProjects = $this->initHttpWithToken()->post(config('cag_rpu_api.get-all-projects'), [
//            'all' => 1
//        ])->json();
//        $allProjects = $allProjects ? $allProjects['data'] : [];
//
//        $allFunctions = $this->initHttpWithToken()->post(config('cag_rpu_api.functions.list'), [
//            'all' => 1
//        ])->json();
//        $allFunctions = $allFunctions ? $allFunctions['data'] : [];
//
//        $allMasterUnits = $this->initHttpWithToken()->post(config('cag_rpu_api.master_units.list'), [
//            'all' => 1
//        ])->json();
//        $allMasterUnits = $allMasterUnits ? $allMasterUnits['data'] : [];

        return view('modules.audit_plan.program.partials.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'audit_plan_id' => 'required|integer',
            'audit_area_id' => 'required|integer',
            'control_objective' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'area_index' => 'required|numeric',
            'procedures' => 'required|array',
            'procedures.*.test_procedure' => 'required|string',
            'procedures.*.note' => 'nullable|string',
            'procedures.*.done_by' => 'nullable|string|max:255',
            'procedures.*.reference' => 'nullable|string|max:255',
        ]);

        // $currentUserId = $this->current_desk()['officer_id'];

        $data = [
            'audit_plan_id' => $request->audit_plan_id,
            'audit_area_id' => $request->audit_area_id,
            'control_objective' => $request->control_objective,
            'category' => $request->category,
            'area_index' => $request->area_index,
            'procedures' => $request->procedures,
            'note' => $request->note,
            // 'creator_id' => $currentUserId,
            // 'updater_id' => $currentUserId,
        ];

    //    dd($data);

        $create_risk_impact = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_plan.sector_area_programs'), $data)->json();

    //    dd($create_risk_impact);

        if (isset($create_risk_impact['status']) && $create_risk_impact['status'] == 'success') {
            return response()->json(responseFormat('success', 'Created Successfully'));
        } else {
            return response()->json(['status' => 'error', 'data' => $create_risk_impact]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function programNote(Request $request)
    {
        $data =  $request->validate([
            'audit_plan_id' => 'required|integer',
        ]);
        $id = $request->id;
        $audit_plan_id = $request->audit_plan_id;
        $team_id = $request->team_id;
        $team_members = $this->getPlanAndTeamWiseTeamMembers(0,$audit_plan_id,$team_id);
        $working_plan_list = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_plan_work_papers'), $data)->json();
        if ($working_plan_list['status'] == 'success') {
            $working_plan_list = $working_plan_list['data'];
        } else {
            return response()->json(['status' => 'error', 'data' => $working_plan_list]);
        }
        return view('modules.audit_plan.program.partials.note', compact('id','team_members','working_plan_list'));
    }

    public function programNoteUpdate(Request $request)
    {
        // dd($request->all());
        $data = [
            'id' => $request->id,
            'note' => $request->note,
            'team_member_officer_id' => json_decode($request->team_member_officer_id)->team_member_officer_id,
            'team_member_name_en' => json_decode($request->team_member_officer_id)->team_member_name_en,
            'team_member_name_bn' => json_decode($request->team_member_officer_id)->team_member_name_bn,
            'team_member_details' => $request->team_member_officer_id,
            'workpaper_id' => $request->workpaper_id,
        ];
        $update_program_note = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_plan.program_note_update'), $data)->json();
        // dd($update_program_note);
        if (isset($update_program_note['status']) && $update_program_note['status'] == 'success') {
            return response()->json(['status' => 'success', 'data' => $update_program_note['data']]);
        } else {
            return response()->json(['status' => 'error', 'data' => $update_program_note]);
        }
    }

    public function riskAuditProgramEdit(Request $request)
    {
        // dd($request->all());
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

        $auditArea = collect($allAreas)->firstWhere('id', $request->audit_area_id);

        $id = $request->id;
        $audit_area_id = $request->audit_area_id;
        $control_objective = $request->control_objective;
        $category = $request->category;
        $area_index = $request->area_index;
        $procedures = $request->procedures;

        return view('modules.audit_plan.program.partials.update', compact('id', 'audit_area_id', 'control_objective', 'category', 'area_index', 'procedures', 'allProjects', 'allFunctions', 'allMasterUnits', 'allAreas', 'auditArea'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'audit_area_id' => 'required|integer',
            'control_objective' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'area_index' => 'required|numeric',
            'procedures' => 'required|array',
            'procedures.*.test_procedure' => 'required|string',
            'procedures.*.note' => 'nullable|string',
            'procedures.*.done_by' => 'nullable|string|max:255',
            'procedures.*.reference' => 'nullable|string|max:255',
        ]);

        // $currentUserId = $this->current_desk()['officer_id'];

        $data = [
            'id' => $request->id,
            'audit_area_id' => $request->audit_area_id,
            'control_objective' => $request->control_objective,
            'category' => $request->category,
            'area_index' => $request->area_index,
            'procedures' => $request->procedures,
            // 'creator_id' => $currentUserId,
            // 'updater_id' => $currentUserId,
        ];

        $id = $request->id;

        // dd($data);

        $update_risk_rating = $this->initHttpWithToken()->put(config('amms_bee_routes.audit_plan.sector_area_programs')."/$id", $data)->json();
    //    dd($update_risk_rating);
        if (isset($update_risk_rating['status']) && $update_risk_rating['status'] == 'success') {
            return response()->json(['status' => 'success', 'data' => $update_risk_rating['data']]);
        } else {
            return response()->json(['status' => 'error', 'data' => $update_risk_rating]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = [
            'id' => $id,
        ];
    //    dd($data);
        $delete_risk_rating = $this->initHttpWithToken()->delete(config('amms_bee_routes.audit_plan.sector_area_programs')."/$id", $data)->json();
        if (isset($delete_risk_rating['status']) && $delete_risk_rating['status'] == 'success') {
            return response()->json(responseFormat('success', 'Deleted Successfully'));
        } else {
            return response()->json(['status' => 'error', 'data' => $delete_risk_rating]);
        }
    }

    public function getSectorAreaList(Request $request) {

        $request->validate([
            'sector_id' => 'required|integer',
            'sector_type' => 'required|in:project,function,master-unit',
        ]);

        if ($request->sector_type == 'project') {

            $allAreas = $this->initHttpWithToken()->get(config('cag_rpu_api.areas'), [
                'sector_id' => $request->sector_id,
                'sector_type' => 'App\Models\Project',
            ])->json();

        } else if ($request->sector_type == 'function') {

            $allAreas = $this->initHttpWithToken()->get(config('cag_rpu_api.areas'), [
                'sector_id' => $request->sector_id,
                'sector_type' => 'App\Models\Function',
            ])->json();

        } else if ($request->sector_type == 'master-unit') {

            $allAreas = $this->initHttpWithToken()->get(config('cag_rpu_api.areas'), [
                'sector_id' => $request->sector_id,
                'sector_type' => 'App\Models\UnitMasterInfo',
            ])->json();

        }

        // dd($allAreas);

        $allAreas = $allAreas ? $allAreas['data'] : [];

        return view('modules.settings.risk_assessment.partials.areas', compact('allAreas'));
    }

    public function exportAuditProgramList(Request $request)
    {
        // dd($request);

        $request->validate([
            'sectorName' => 'required|string',
            'auditAreaName' => 'required|string',
            'audit_area_id' => 'required|integer',
        ]);

        $sectorAreaPrograms = $this->initHttpWithToken()->get(config('amms_bee_routes.audit_plan.export_sector_area_programs'), $request->all())->json();

        // dd($sectorAreaPrograms);

        if (isset($sectorAreaPrograms['status']) && $sectorAreaPrograms['status'] == 'success') {
            return response()->json(responseFormat('success', env('BEE_URL', 'http://localhost:8001').$sectorAreaPrograms['data']));
        } else {
            return response()->json(['status' => 'error', 'data' => $sectorAreaPrograms]);
        }
    }
}
