<?php

namespace App\Http\Controllers\RiskAssessment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RiskMatrixController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('modules.risk_assessment.risk_matrix.risk_matrix_list');
    }

    public function getRiskMatrixList()
    {
        $risk_matrixes = $this->initHttpWithToken()->get(config('amms_bee_routes.risk_matrixes'), [
            'all' => 1
        ])->json();

        // dd($risk_matrixes);

        if ($risk_matrixes['status'] == 'success') {
            $risk_matrixes = $risk_matrixes['data'];
            return view('modules.risk_assessment.risk_matrix.partials.get_risk_matrix_list', compact('risk_matrixes'));
        } else {
            return response()->json(['status' => 'error', 'data' => $risk_matrixes]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $riskAssessmentLivelihoods = $this->initHttpWithToken()->get(config('amms_bee_routes.x_risk_likelihoods'), [
            'all' => 1
        ])->json()['data'];

        $riskAssessmentImpacts = $this->initHttpWithToken()->get(config('amms_bee_routes.x_risk_impacts'), [
            'all' => 1
        ])->json()['data'];

        $riskLevels = $this->initHttpWithToken()->get(config('amms_bee_routes.x_risk_levels'), [
            'all' => 1
        ])->json()['data'];
        
        return view('modules.risk_assessment.risk_matrix.partials.create_risk_matrix_form', compact('riskAssessmentLivelihoods', 'riskAssessmentImpacts', 'riskLevels'));
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
            'x_risk_assessment_likelihood_id' => 'required|integer',
            'x_risk_assessment_impact_id' => 'required|integer',
            'x_risk_level_id' => 'required|integer',
            'priority' => 'required|integer',
        ]);

        $currentUserId = $this->current_desk()['officer_id'];
        
        $data = [
            'x_risk_assessment_likelihood_id' => $request->x_risk_assessment_likelihood_id,
            'x_risk_assessment_impact_id' => $request->x_risk_assessment_impact_id,
            'x_risk_level_id' => $request->x_risk_level_id,
            'priority' => $request->priority,
            'created_by' => $currentUserId,
            'updated_by' => $currentUserId,
        ];

        $create_risk_assessment = $this->initHttpWithToken()->post(config('amms_bee_routes.risk_matrixes'), $data)->json();
        //    dd($create_risk_assessment);
        if (isset($create_risk_assessment['status']) && $create_risk_assessment['status'] == 'success') {
            return response()->json(responseFormat('success', 'Created Successfully'));
        } else {
            return response()->json(['status' => 'error', 'data' => $create_risk_assessment]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function riskMatrixEdit(Request $request)
    {
        $request->validate([
            'x_risk_assessment_likelihood_id' => 'required|integer',
            'x_risk_assessment_impact_id' => 'required|integer',
            'x_risk_level_id' => 'required|integer',
            'priority' => 'required|integer',
        ]);
        
        $id = $request->id;
        $x_risk_assessment_likelihood_id = $request->x_risk_assessment_likelihood_id;
        $x_risk_assessment_impact_id = $request->x_risk_assessment_impact_id;
        $x_risk_level_id = $request->x_risk_level_id;
        $priority = $request->priority;

        $riskAssessmentLivelihoods = $this->initHttpWithToken()->get(config('amms_bee_routes.x_risk_likelihoods'), [
            'all' => 1
        ])->json()['data'];

        $riskAssessmentImpacts = $this->initHttpWithToken()->get(config('amms_bee_routes.x_risk_impacts'), [
            'all' => 1
        ])->json()['data'];

        $riskLevels = $this->initHttpWithToken()->get(config('amms_bee_routes.x_risk_levels'), [
            'all' => 1
        ])->json()['data'];

        return view('modules.risk_assessment.risk_matrix.partials.update_risk_matrix_form', compact('id', 'x_risk_assessment_likelihood_id', 'x_risk_assessment_impact_id', 'x_risk_level_id', 'priority', 'riskAssessmentLivelihoods', 'riskAssessmentImpacts', 'riskLevels'));
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
        $data = [
            'id' => $request->id,
            'x_risk_assessment_likelihood_id' => $request->x_risk_assessment_likelihood_id,
            'x_risk_assessment_impact_id' => $request->x_risk_assessment_impact_id,
            'x_risk_level_id' => $request->x_risk_level_id,
            'priority' => $request->priority,
            'updated_by' => $this->current_desk()['officer_id'],
        ];

        $update_risk_matrix = $this->initHttpWithToken()->put(config('amms_bee_routes.risk_matrixes')."/$id", $data)->json();
//        dd($create_audit_query);
        if (isset($update_risk_matrix['status']) && $update_risk_matrix['status'] == 'success') {
            return response()->json(['status' => 'success', 'data' => $update_risk_matrix['data']]);
        } else {
            return response()->json(['status' => 'error', 'data' => $update_risk_matrix]);
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
        $delete_risk_matrix = $this->initHttpWithToken()->delete(config('amms_bee_routes.risk_matrixes')."/$id", $data)->json();
        if (isset($delete_risk_matrix['status']) && $delete_risk_matrix['status'] == 'success') {
            return response()->json(responseFormat('success', 'Deleted Successfully'));
        } else {
            return response()->json(['status' => 'error', 'data' => $delete_risk_matrix]);
        }
    }
}
