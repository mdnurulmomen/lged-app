<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class XRiskImpactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('modules.settings.x_risk_impact.x_risk_impact_list');
    }

    public function getRiskImpactList()
    {
        $risk_impact_list = $this->initHttpWithToken()->get(config('amms_bee_routes.x_risk_impacts'), [
            'all' => 1
        ])->json();

        // dd($risk_impact_list);

        if ($risk_impact_list['status'] == 'success') {
            $risk_impact_list = $risk_impact_list['data'];
            return view('modules.settings.x_risk_impact.partials.get_risk_impact_list', compact('risk_impact_list'));
        } else {
            return response()->json(['status' => 'error', 'data' => $risk_impact_list]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        return view('modules.settings.x_risk_impact.partials.create_risk_impact_form');
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
            'impact_value' => 'required|min:1|max:10'
        ]);

        $currentUserId = $this->current_desk()['officer_id'];
        
        $data = [
            'title_bn' => $request->title_bn,
            'title_en' => $request->title_en,
            'impact_value' => $request->impact_value,
            'created_by' => $currentUserId,
            'updated_by' => $currentUserId,
        ];

        $create_risk_impact = $this->initHttpWithToken()->post(config('amms_bee_routes.x_risk_impacts'), $data)->json();
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
    public function riskImpactEdit(Request $request)
    {
        $id = $request->id;
        $title_bn = $request->title_bn;
        $title_en = $request->title_en;
        $impact_value = $request->impact_value;

        return view('modules.settings.x_risk_impact.partials.update_risk_impact_form', compact('id', 'title_bn', 'title_en', 'impact_value'));
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
            'impact_value' => $request->impact_value,
            'updated_by' => $this->current_desk()['officer_id'],
        ];

        $update_risk_impact = $this->initHttpWithToken()->put(config('amms_bee_routes.x_risk_impacts')."/$id", $data)->json();
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
        $delete_risk_impact = $this->initHttpWithToken()->delete(config('amms_bee_routes.x_risk_impacts')."/$id", $data)->json();
        if (isset($delete_risk_impact['status']) && $delete_risk_impact['status'] == 'success') {
            return response()->json(responseFormat('success', 'Deleted Successfully'));
        } else {
            return response()->json(['status' => 'error', 'data' => $delete_risk_impact]);
        }
    }
}
