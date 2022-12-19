<?php

namespace App\Http\Controllers\AuditPlan\Individual;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuditWorkPaperController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $auditPlans = $this->initHttpWithToken()->get(config('amms_bee_routes.audit_plans'))->json()['data'];
        // dd($auditPlans);
        return view('modules.audit_plan.work-papers.index', compact('auditPlans'));
    }

    public function getPlanWorkPapers(Request $request)
    {
        $request->validate([
            'audit_plan_id' => 'required|integer',
        ]);

        // dd($request);

        $auditPlan = $this->initHttpWithToken()->get(config('amms_bee_routes.audit_plan_work_papers'), $request->all())->json();

        // dd($auditPlan);

        if ($auditPlan['status'] == 'success') {
            $auditPlan = $auditPlan['data'];
            return view('modules.audit_plan.work-papers.partials.list', compact(['auditPlan']));
        } else {
            return response()->json(['status' => 'error', 'data' => $auditPlan]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // dd(1);
        
        $auditPlans = $this->initHttpWithToken()->get(config('amms_bee_routes.audit_plans'))->json();
        $auditPlans = $auditPlans ? $auditPlans['data'] : [];

        return view('modules.audit_plan.work-papers.partials.create', compact(['auditPlans']));
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
            'title_bn' => 'nullable|string',
            'title_en' => 'nullable|string',
            'attachment' => 'required|file|mimes:png,jpg,jpeg,csv,doc,docx,pdf,zip,rar|max:2048'
        ]);

        // dd($request->all());
        
        $currentUserId = $this->current_desk()['officer_id'];
        
        /* 
        $data = [
            'name' => 'audit_plan_id', 'contents' => $request->audit_plan_id,
            'name' => 'title_bn', 'contents' => $request->title_bn,
            'name' => 'title_en', 'contents' => $request->title_en,
            'name' => 'created_by', 'contents' => $currentUserId,
            'name' => 'updated_by', 'contents' => $currentUserId,
            'name' => 'attachment', 
            'contents' => is_file($request['attachment']) ? file_get_contents($request['attachment']->getRealPath()) : '',
            'filename' => is_file($request['attachment']) ? $request['attachment']->getClientOriginalName() : '',
        ]; 
        */
        
        // dd(is_file($request['attachment']));

        $data = [
            ['name' => 'audit_plan_id', 'contents' => $request->audit_plan_id],
            ['name' => 'title_bn', 'contents' => $request->title_bn],
            ['name' => 'title_en', 'contents' => $request->title_en],
            ['name' => 'created_by', 'contents' => $currentUserId],
            ['name' => 'updated_by', 'contents' => $currentUserId],
            
            [
                'name' => 'attachment', 
                'contents' => $request->hasfile('attachment') ? file_get_contents($request->file('attachment')) : '',
                'filename' => $request->hasfile('attachment') ? $request->file('attachment')->getClientOriginalName() : '',
            ]             
        ];
                    
        $store = $this->fileUPloadWithData(
            config('amms_bee_routes.audit_plan_work_papers_store'),
            $data,
            'POST',
        );

        $store = json_decode($store->getBody(), true);
            
        // dd($store);

        //    dd($create_risk_impact);
        if (isSuccess($store)) {
            return response()->json(['status' => 'success', 'data' => $store['data']]);
        } else {
            return response()->json(['status' => 'error', 'data' => $store]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function planWorkPaperEdit(Request $request)
    {
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
    public function update(Request $request, $id)
    {
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

        $update_risk_rating = $this->initHttpWithToken()->put(config('amms_bee_routes.audit_plan.sector_area_programs')."/$id", $data)->json();
//        dd($create_audit_query);
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

    public function exportWorkPaper(Request $request)
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
