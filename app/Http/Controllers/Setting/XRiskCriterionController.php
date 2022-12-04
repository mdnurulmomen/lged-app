<?php

namespace App\Http\Controllers\Setting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class XRiskCriterionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('modules.settings.x_risk_criterion.index');
    }

    public function getRiskCriterionList()
    {
        $risk_criterion_list = $this->initHttpWithToken()->get(config('amms_bee_routes.x_risk_criteria'), [
            'all' => 1
        ])->json();

        // dd($risk_criterion_list);

        if ($risk_criterion_list['status'] == 'success') {
            $risk_criterion_list = $risk_criterion_list['data'];
            return view('modules.settings.x_risk_criterion.partials.list', compact('risk_criterion_list'));
        } else {
            return response()->json(['status' => 'error', 'data' => $risk_criterion_list]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $riskFactors = $this->initHttpWithToken()->get(config('amms_bee_routes.x_risk_factors'), [
            'all' => 1
        ])->json()['data'];
        
        return view('modules.settings.x_risk_criterion.partials.create', compact('riskFactors'));
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
            'title_bn' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'x_risk_factor_id' => 'required|integer',
        ]);

        $currentUserId = $this->current_desk()['officer_id'];
        
        $data = [
            'title_bn' => $request->title_bn,
            'title_en' => $request->title_en,
            'x_risk_factor_id' => $request->x_risk_factor_id,
            'created_by' => $currentUserId,
            'updated_by' => $currentUserId,
        ];

        $create_risk_assessment = $this->initHttpWithToken()->post(config('amms_bee_routes.x_risk_criteria'), $data)->json();
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
    public function riskCriterionEdit(Request $request)
    {
        $id = $request->id;
        $x_risk_factor_id = $request->x_risk_factor_id;
        $title_bn = $request->title_bn;
        $title_en = $request->title_en;

        $riskFactors = $this->initHttpWithToken()->get(config('amms_bee_routes.x_risk_factors'), [
            'all' => 1
        ])->json()['data'];

        return view('modules.settings.x_risk_criterion.partials.update', compact('id', 'x_risk_factor_id', 'title_bn', 'title_en', 'riskFactors'));
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
            'title_bn' => $request->title_bn,
            'title_en' => $request->title_en,
            'x_risk_factor_id' => $request->x_risk_factor_id,
            'updated_by' => $this->current_desk()['officer_id'],
        ];

        $update_risk_criterion = $this->initHttpWithToken()->put(config('amms_bee_routes.x_risk_criteria')."/$id", $data)->json();
//        dd($create_audit_query);
        if (isset($update_risk_criterion['status']) && $update_risk_criterion['status'] == 'success') {
            return response()->json(['status' => 'success', 'data' => $update_risk_criterion['data']]);
        } else {
            return response()->json(['status' => 'error', 'data' => $update_risk_criterion]);
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
        $delete_risk_criterion = $this->initHttpWithToken()->delete(config('amms_bee_routes.x_risk_criteria')."/$id", $data)->json();
        if (isset($delete_risk_criterion['status']) && $delete_risk_criterion['status'] == 'success') {
            return response()->json(responseFormat('success', 'Deleted Successfully'));
        } else {
            return response()->json(['status' => 'error', 'data' => $delete_risk_criterion]);
        }
    }
}
