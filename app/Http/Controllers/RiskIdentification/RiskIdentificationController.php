<?php

namespace App\Http\Controllers\RiskIdentification;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RiskIdentificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
                
        return view('modules.settings.risk_identification.index', compact('allProjects', 'allFunctions', 'allMasterUnits'));
    }

    public function getSectorParentAreaList(Request $request) {

        $request->validate([
            'assessment_sector_id' => 'required|integer',
            'assessment_sector_type' => 'required|in:project,function,master-unit',
        ]);

        $allAreas = $this->initHttpWithToken()->get(config('cag_rpu_api.areas'), [])->json();
        $allAreas = $allAreas ? $allAreas['data'] : [];
        
        // dd($request);
        // dd($allAreas);
        
        /* 
        if ($request->assessment_sector_type == 'project') {
            
            $allParentAreaIds = $this->initHttpWithToken()->get(config('amms_bee_routes.risk_identification_parent_areas'), [
                'assessment_sector_id' => $request->assessment_sector_id, 
                'assessment_sector_type' => 'App\Models\Project', 
            ])->json(); 
            
        } else if ($request->assessment_sector_type == 'function') {
            
            $allParentAreaIds = $this->initHttpWithToken()->get(config('amms_bee_routes.risk_identification_parent_areas'), [
                'assessment_sector_id' => $request->assessment_sector_id, 
                'assessment_sector_type' => 'App\Models\Function', 
            ])->json(); 
              
        } else if ($request->assessment_sector_type == 'master-unit') {
                 
            $allParentAreaIds = $this->initHttpWithToken()->get(config('amms_bee_routes.risk_identification_parent_areas'), [
                'assessment_sector_id' => $request->assessment_sector_id, 
                'assessment_sector_type' => 'App\Models\UnitMasterInfo', 
                ])->json();   
            }
        */
        
        $allParentAreaIds = $this->initHttpWithToken()->get(config('amms_bee_routes.risk_identification_parent_areas'), $request->all())->json(); 
        $allParentAreaIds = $allParentAreaIds ? $allParentAreaIds['data'] : [];
        
        // dd($allParentAreaIds);

        $allAreas = array_filter(
            $allAreas,
            function ($area) use ($allParentAreaIds) {
                // N.b. in_array() is notorious for being slow 
                return in_array($area['id'], $allParentAreaIds);
            }
        );

        // dd($allAreas);
        
        return view('modules.settings.risk_identification.partials.areas', compact('allAreas'));
    }

    public function getRiskIdentificationList(Request $request)
    {   
        $request->validate([
            'assessment_sector_type' => 'required|string|in:project,function,master-unit,cost-center',
            'assessment_sector_id' => 'required|integer',
            'parent_area_id' => 'required|integer',
        ]);

        // dd($request);

        $riskidentifications = $this->initHttpWithToken()->get(config('amms_bee_routes.risk_identifications'), $request->all())->json();

        // dd($riskidentifications);

        $allAuditAreas = $this->initHttpWithToken()->get(config('cag_rpu_api.areas'), [
            'all' => 1
        ])->json()['data'];

        // dd($allAuditAreas);

        if ($riskidentifications['status'] == 'success') {
            $riskidentifications = $riskidentifications['data'];
            return view('modules.settings.risk_identification.partials.list', compact(['riskidentifications', 'allAuditAreas']));
        } else {
            return response()->json(['status' => 'error', 'data' => $riskidentifications]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        
        /* 
        $allCostCenters = $this->initHttpWithToken()->post(config('cag_rpu_api.cost-center-project-map.get-cost-center-project-map'), [
            'all' => 1
        ])->json();
        $allCostCenters = $allCostCenters ? $allCostCenters['data'] : []; 
        */

        $allAreas = $this->initHttpWithToken()->get(config('cag_rpu_api.areas'), [
            'all' => 1
        ])->json()['data'];

        // dd($allAreas);

        $allAreas = array_filter(
            $allAreas,
            function ($area) { 
                return is_null($area['parent_id']);
            }
        );

        return view('modules.settings.risk_identification.partials.create', compact('allProjects', 'allFunctions', 'allMasterUnits', 'allAreas'));
    }

    public function getChildAreas(Request $request) {

        $request->validate([
            'parent_area_id' => 'required|integer',
        ]);

        $parent_area_id = $request['parent_area_id'];
        
        $allAreas = $this->initHttpWithToken()->get(config('cag_rpu_api.areas'), [])->json();
        $allAreas = $allAreas ? $allAreas['data'] : [];
        
        // dd($allParentAreaIds);

        $allAreas = array_filter(
            $allAreas,
            function ($area) use ($parent_area_id) {
                // N.b. in_array() is notorious for being slow 
                return $area['parent_id']==$parent_area_id;
            }
        );

        // dd($allAreas);
        
        return view('modules.settings.risk_identification.partials.areas', compact('allAreas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'audit_area_id' => 'required|integer',
            'parent_area_id' => 'required|integer',
            'assessment_sector_id' => 'required|integer|max:255',
            'assessment_sector_type' => 'required|string|in:project,function,master-unit,cost-center',
            'risk_name' => 'required|string'
        ]);

        $currentUserId = $this->current_desk()['officer_id'];
        
        $data = [
            'audit_area_id' => $request->audit_area_id,
            'parent_area_id' => $request->parent_area_id,
            'assessment_sector_id' => $request->assessment_sector_id,
            'assessment_sector_type' => $request->assessment_sector_type,
            'risk_name' => $request->risk_name,
            'creator_id' => $currentUserId,
            'updater_id' => $currentUserId,
        ];

        $create_risk_impact = $this->initHttpWithToken()->post(config('amms_bee_routes.risk_identifications'), $data)->json();
           
        // dd($create_risk_impact);

        if (isset($create_risk_impact['status']) && $create_risk_impact['status'] == 'success') {
            return response()->json(responseFormat('success', 'Created Successfully'));
        } else {
            return response()->json(['status' => 'error', 'data' => $create_risk_impact]);
        }
    }
}
