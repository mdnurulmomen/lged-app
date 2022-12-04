<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class XRiskFactorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('modules.settings.x_risk_factor.index');
    }

    public function getRiskFactorList()
    {
        $risk_factor_list = $this->initHttpWithToken()->get(config('amms_bee_routes.x_risk_factors'), [
            'all' => 1
        ])->json();

        // dd($risk_factor_list);

        if ($risk_factor_list['status'] == 'success') {
            $risk_factor_list = $risk_factor_list['data'];
            return view('modules.settings.x_risk_factor.partials.list', compact('risk_factor_list'));
        } else {
            return response()->json(['status' => 'error', 'data' => $risk_factor_list]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $risk_factor_list = $this->initHttpWithToken()->get(config('amms_bee_routes.x_risk_factors'), [
            'all' => 1
        ])->json()['data'];

        $maxWeight = collect($risk_factor_list)->sum('risk_weight');

        if ($maxWeight >= 100) {
            
            return response()->json(array(
                'success' => false,
                'errors' => ["Collective weight should not exceed 100"]
            ), 422);
        }

        return view('modules.settings.x_risk_factor.partials.create', ['risk_weight' => collect($risk_factor_list)->sum('risk_weight')]);
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
            'risk_weight' => 'required|integer|min:1|max:100',
        ]);

        $risk_factor_list = $this->initHttpWithToken()->get(config('amms_bee_routes.x_risk_factors'), [
            'all' => 1
        ])->json()['data'];

        $maxWeight = collect($risk_factor_list)->sum('risk_weight');

        if ($request->risk_weight > (100 - $maxWeight)) {
            
            return response()->json(array(
                'success' => false,
                'errors' => ["Collective weight should not exceed 100"]
            ), 422);
        }
        
        $data = [
            'title_bn' => $request->title_bn,
            'title_en' => $request->title_en,
            'risk_weight' => $request->risk_weight
        ];

        $create_risk_assessment = $this->initHttpWithToken()->post(config('amms_bee_routes.x_risk_factors'), $data)->json();
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
    public function riskFactorEdit(Request $request)
    {
        $id = $request->id;
        $risk_weight = $request->risk_weight;
        $title_bn = $request->title_bn;
        $title_en = $request->title_en;

        return view('modules.settings.x_risk_factor.partials.update', compact('id', 'risk_weight', 'title_bn', 'title_en'));
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
            'title_bn' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'risk_weight' => 'required|integer|min:1|max:100',
        ]);

        $risk_factor_list = $this->initHttpWithToken()->get(config('amms_bee_routes.x_risk_factors'), [
            'all' => 1
        ])->json()['data'];

        $maxWeight = collect($risk_factor_list)->where('id', '!=', $id)->sum('risk_weight') + $request->risk_weight;

        if ($maxWeight > 100) {

            return response()->json(array(
                'success' => false,
                'errors' => ["Collective weight should not exceed 100"]
            ), 422);
            
        }
        
        $data = [
            'id' => $request->id,
            'title_bn' => $request->title_bn,
            'title_en' => $request->title_en,
            'risk_weight' => $request->risk_weight
        ];

        $update_risk_factor = $this->initHttpWithToken()->put(config('amms_bee_routes.x_risk_factors')."/$id", $data)->json();
//        dd($create_audit_query);
        if (isset($update_risk_factor['status']) && $update_risk_factor['status'] == 'success') {
            return response()->json(['status' => 'success', 'data' => $update_risk_factor['data']]);
        } else {
            return response()->json(['status' => 'error', 'data' => $update_risk_factor]);
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
        $delete_risk_factor = $this->initHttpWithToken()->delete(config('amms_bee_routes.x_risk_factors')."/$id", $data)->json();
        if (isset($delete_risk_factor['status']) && $delete_risk_factor['status'] == 'success') {
            return response()->json(responseFormat('success', 'Deleted Successfully'));
        } else {
            return response()->json(['status' => 'error', 'data' => $delete_risk_factor]);
        }
    }
}
