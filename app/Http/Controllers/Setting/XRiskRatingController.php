<?php

namespace App\Http\Controllers\Setting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class XRiskRatingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('modules.settings.x_risk_rating.index');
    }

    public function getRiskRatingList()
    {
        $risk_rating_list = $this->initHttpWithToken()->get(config('amms_bee_routes.x_risk_ratings'), [
            'all' => 1
        ])->json();

        // dd($risk_rating_list);

        if ($risk_rating_list['status'] == 'success') {
            $risk_rating_list = $risk_rating_list['data'];
            return view('modules.settings.x_risk_rating.partials.list', compact('risk_rating_list'));
        } else {
            return response()->json(['status' => 'error', 'data' => $risk_rating_list]);
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
        
        return view('modules.settings.x_risk_rating.partials.create', compact('riskFactors'));
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
            'rating_value' => 'required|min:1|max:10'
        ]);
        
        $data = [
            'title_bn' => $request->title_bn,
            'title_en' => $request->title_en,
            'rating_value' => $request->rating_value,
            'x_risk_factor_id' => $request->x_risk_factor_id,
        ];

        $create_risk_rating = $this->initHttpWithToken()->post(config('amms_bee_routes.x_risk_ratings'), $data)->json();
        //    dd($create_risk_assessment);
        if (isset($create_risk_rating['status']) && $create_risk_rating['status'] == 'success') {
            return response()->json(responseFormat('success', 'Created Successfully'));
        } else {
            return response()->json(['status' => 'error', 'data' => $create_risk_rating]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function riskRatingEdit(Request $request)
    {
        $id = $request->id;
        $title_bn = $request->title_bn;
        $title_en = $request->title_en;
        $rating_value = $request->rating_value;
        $x_risk_factor_id = $request->x_risk_factor_id;

        $riskFactors = $this->initHttpWithToken()->get(config('amms_bee_routes.x_risk_factors'), [
            'all' => 1
        ])->json()['data'];

        return view('modules.settings.x_risk_rating.partials.update', compact('id', 'title_bn', 'title_en', 'rating_value', 'x_risk_factor_id', 'riskFactors'));
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
            'rating_value' => $request->rating_value,
            'x_risk_factor_id' => $request->x_risk_factor_id,
        ];

        $update_risk_rating = $this->initHttpWithToken()->put(config('amms_bee_routes.x_risk_ratings')."/$id", $data)->json();
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
        $delete_risk_rating = $this->initHttpWithToken()->delete(config('amms_bee_routes.x_risk_ratings')."/$id", $data)->json();
        if (isset($delete_risk_rating['status']) && $delete_risk_rating['status'] == 'success') {
            return response()->json(responseFormat('success', 'Deleted Successfully'));
        } else {
            return response()->json(['status' => 'error', 'data' => $delete_risk_rating]);
        }
    }
}
