<?php

namespace App\Http\Controllers\RiskAssessment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ItemAssessmentController extends Controller
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
        
        $allCostCenters = $this->initHttpWithToken()->post(config('cag_rpu_api.cost-center-project-map.get-cost-center-project-map'), [
            'all' => 1
        ])->json();
        $allCostCenters = $allCostCenters ? $allCostCenters['data'] : [];
                
        return view('modules.settings.risk_assessment.risk_assessment_list', compact('allProjects', 'allFunctions', 'allMasterUnits', 'allCostCenters'));
    }

    public function getItemRiskAssessmentList(Request $request)
    {   
        $item_risk_assessments = $this->initHttpWithToken()->get(config('amms_bee_routes.item_risk_assessments'), $request->all())->json();

        // dd($item_risk_assessments);

        if ($item_risk_assessments['status'] == 'success') {
            $item_risk_assessments = $item_risk_assessments['data'];
            return view('modules.settings.risk_assessment.partials.get_risk_assessment_list', compact('item_risk_assessments'));
        } else {
            return response()->json(['status' => 'error', 'data' => $item_risk_assessments]);
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
        
        $allCostCenters = $this->initHttpWithToken()->post(config('cag_rpu_api.cost-center-project-map.get-cost-center-project-map'), [
            'all' => 1
        ])->json();
        $allCostCenters = $allCostCenters ? $allCostCenters['data'] : [];
        
        $allAreas = $this->initHttpWithToken()->get(config('amms_bee_routes.audit_execution.areas'), [
            'all' => 1
        ])->json();
        $allAreas = $allAreas ? $allAreas['data'] : [];

        $allImpacts = $this->initHttpWithToken()->get(config('amms_bee_routes.x_risk_impacts'), [
            'all' => 1
        ])->json();
        $allImpacts = $allImpacts ? $allImpacts['data'] : [];
        
        $allLikelihoods = $this->initHttpWithToken()->get(config('amms_bee_routes.x_risk_likelihoods'), [
            'all' => 1
        ])->json();
        $allLikelihoods = $allLikelihoods ? $allLikelihoods['data'] : [];

        return view('modules.settings.risk_assessment.partials.create_risk_assessment_form', compact('allProjects', 'allFunctions', 'allMasterUnits', 'allCostCenters', 'allImpacts', 'allAreas', 'allLikelihoods'));
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
            'x_audit_area_id' => 'required|integer|max:255',
            'assessment_item_id' => 'required|integer|max:255',
            'assessment_item_type' => 'required|string|in:project,function,master-unit,cost-center',
            'audit_assessment_area_risks' => 'required|array',
            'audit_assessment_area_risks.*.inherent_risk' => 'required|string',
            'audit_assessment_area_risks.*.x_risk_assessment_impact_id' => 'required|integer',
            'audit_assessment_area_risks.*.x_risk_assessment_likelihood_id' => 'required|integer',
            'audit_assessment_area_risks.*.control_system' => 'required|string',
            'audit_assessment_area_risks.*.control_effectiveness' => 'required|string',
            'audit_assessment_area_risks.*.residual_risk' => 'required|string',
            'audit_assessment_area_risks.*.recommendation' => 'required|string',
            'audit_assessment_area_risks.*.implemented_by' => 'required|string',
            'audit_assessment_area_risks.*.implementation_period' => 'required|string',
        ]);

        $currentUserId = $this->current_desk()['officer_id'];
        
        $data = [
            'x_audit_area_id' => $request->x_audit_area_id,
            'assessment_item_id' => $request->assessment_item_id,
            'assessment_item_type' => $request->assessment_item_type,
            'audit_assessment_area_risks' => $request->audit_assessment_area_risks,
            'creator_id' => $currentUserId,
            'updater_id' => $currentUserId,
        ];

        $create_risk_impact = $this->initHttpWithToken()->post(config('amms_bee_routes.item_risk_assessments'), $data)->json();
        //    dd($create_risk_assessment);
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
    public function itemRiskAssessmentEdit(Request $request)
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
        
        $allCostCenters = $this->initHttpWithToken()->post(config('cag_rpu_api.cost-center-project-map.get-cost-center-project-map'), [
            'all' => 1
        ])->json();
        $allCostCenters = $allCostCenters ? $allCostCenters['data'] : [];
        
        $allAreas = $this->initHttpWithToken()->get(config('amms_bee_routes.audit_execution.areas'), [
            'all' => 1
        ])->json();
        $allAreas = $allAreas ? $allAreas['data'] : [];

        $allImpacts = $this->initHttpWithToken()->get(config('amms_bee_routes.x_risk_impacts'), [
            'all' => 1
        ])->json();
        $allImpacts = $allImpacts ? $allImpacts['data'] : [];
        
        $allLikelihoods = $this->initHttpWithToken()->get(config('amms_bee_routes.x_risk_likelihoods'), [
            'all' => 1
        ])->json();
        $allLikelihoods = $allLikelihoods ? $allLikelihoods['data'] : [];
        
        $id = $request->id;
        $x_audit_area_id = $request->x_audit_area_id;
        $assessment_item_id = $request->assessment_item_id;
        $assessment_item_type = $request->assessment_item_type;
        $audit_assessment_area_risks = $request->audit_assessment_area_risks;

        return view('modules.settings.risk_assessment.partials.update_risk_assessment_form', compact('id', 'x_audit_area_id', 'assessment_item_id', 'assessment_item_type', 'audit_assessment_area_risks', 'allProjects', 'allFunctions', 'allMasterUnits', 'allCostCenters', 'allImpacts', 'allAreas', 'allLikelihoods'));
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
            'x_audit_area_id' => 'required|integer|max:255',
            'assessment_item_id' => 'required|integer|max:255',
            'assessment_item_type' => 'required|string|in:project,function,master-unit,cost-center',
            'audit_assessment_area_risks' => 'required|array',
            'audit_assessment_area_risks.*.inherent_risk' => 'required|string',
            'audit_assessment_area_risks.*.x_risk_assessment_impact_id' => 'required|integer',
            'audit_assessment_area_risks.*.x_risk_assessment_likelihood_id' => 'required|integer',
            'audit_assessment_area_risks.*.control_system' => 'required|string',
            'audit_assessment_area_risks.*.control_effectiveness' => 'required|string',
            'audit_assessment_area_risks.*.residual_risk' => 'required|string',
            'audit_assessment_area_risks.*.recommendation' => 'required|string',
            'audit_assessment_area_risks.*.implemented_by' => 'required|string',
            'audit_assessment_area_risks.*.implementation_period' => 'required|string',
        ]);
        
        $data = [
            'id' => $request->id,
            'x_audit_area_id' => $request->x_audit_area_id,
            'assessment_item_id' => $request->assessment_item_id,
            'assessment_item_type' => $request->assessment_item_type,
            'audit_assessment_area_risks' => $request->audit_assessment_area_risks,
            'updater_id' => $this->current_desk()['officer_id'],
        ];

        $update_risk_impact = $this->initHttpWithToken()->put(config('amms_bee_routes.item_risk_assessments')."/$request->id", $data)->json();
//        dd($create_audit_query);
        if (isset($update_risk_impact['status']) && $update_risk_impact['status'] == 'success') {
            return response()->json(['status' => 'success', 'data' => $update_risk_impact['data']]);
        } else {
            return response()->json(['status' => 'error', 'data' => $update_risk_impact]);
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
        $delete_risk_impact = $this->initHttpWithToken()->delete(config('amms_bee_routes.item_risk_assessments')."/$id", $data)->json();
        if (isset($delete_risk_impact['status']) && $delete_risk_impact['status'] == 'success') {
            return response()->json(responseFormat('success', 'Deleted Successfully'));
        } else {
            return response()->json(['status' => 'error', 'data' => $delete_risk_impact]);
        }
    }
}
