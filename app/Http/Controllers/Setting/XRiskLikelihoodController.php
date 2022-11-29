<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class XRiskLikelihoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('modules.settings.x_risk_likelihood.x_risk_likelihood_list');
    }

    public function getRiskLikelihoodList()
    {
        $risk_likelihood_list = $this->initHttpWithToken()->get(config('amms_bee_routes.x_risk_likelihoods'), [
            'all' => 1
        ])->json();

        // dd($risk_likelihood_list);

        if ($risk_likelihood_list['status'] == 'success') {
            $risk_likelihood_list = $risk_likelihood_list['data'];
            return view('modules.settings.x_risk_likelihood.partials.get_risk_likelihood_list', compact('risk_likelihood_list'));
        } else {
            return response()->json(['status' => 'error', 'data' => $risk_likelihood_list]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        return view('modules.settings.x_risk_likelihood.partials.create_risk_likelihood_form');
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
            'likelihood_value' => 'required|min:1|max:5',
            'description_bn' => 'required|string|max:255',
            'description_en' => 'required|string|max:255',
            'comment_en' => 'required|string|max:255',
            'commnet_bn' => 'required|string|max:255',
        ]);

        $currentUserId = $this->current_desk()['officer_id'];
        
        $data = [
            'title_bn' => $request->title_bn,
            'title_en' => $request->title_en,
            'likelihood_value' => $request->likelihood_value,
            'description_bn' => $request->description_bn,
            'description_en' => $request->description_en,
            'comment_en' => $request->comment_en,
            'commnet_bn' => $request->commnet_bn,
            'created_by' => $currentUserId,
            'updated_by' => $currentUserId,
        ];

        $create_risk_likelihood = $this->initHttpWithToken()->post(config('amms_bee_routes.x_risk_likelihoods'), $data)->json();
        //    dd($create_risk_assessment);
        if (isset($create_risk_likelihood['status']) && $create_risk_likelihood['status'] == 'success') {
            return response()->json(responseFormat('success', 'Created Successfully'));
        } else {
            return response()->json(['status' => 'error', 'data' => $create_risk_likelihood]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function riskLikelihoodEdit(Request $request)
    {
        $id = $request->id;
        $title_bn = $request->title_bn;
        $title_en = $request->title_en;
        $likelihood_value = $request->likelihood_value;
        $description_bn = $request->description_bn;
        $description_en = $request->description_en;
        $comment_en = $request->comment_en;
        $commnet_bn = $request->commnet_bn;

        return view('modules.settings.x_risk_likelihood.partials.update_risk_likelihood_form', compact('id', 'title_bn', 'title_en', 'likelihood_value', 'description_bn', 'description_en', 'comment_en', 'commnet_bn'));
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
            'likelihood_value' => 'required|min:1|max:5',
            'description_bn' => 'required|string|max:255',
            'description_en' => 'required|string|max:255',
            'comment_en' => 'required|string|max:255',
            'commnet_bn' => 'required|string|max:255',
        ]);
        
        $data = [
            'id' => $request->id,
            'title_bn' => $request->title_bn,
            'title_en' => $request->title_en,
            'likelihood_value' => $request->likelihood_value,
            'description_bn' => $request->description_bn,
            'description_en' => $request->description_en,
            'comment_en' => $request->comment_en,
            'commnet_bn' => $request->commnet_bn,
            'updated_by' => $this->current_desk()['officer_id'],
        ];

        $update_risk_likelihood = $this->initHttpWithToken()->put(config('amms_bee_routes.x_risk_likelihoods')."/$id", $data)->json();
//        dd($create_audit_query);
        if (isset($update_risk_likelihood['status']) && $update_risk_likelihood['status'] == 'success') {
            return response()->json(['status' => 'success', 'data' => $update_risk_likelihood['data']]);
        } else {
            return response()->json(['status' => 'error', 'data' => $update_risk_likelihood]);
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
        $delete_risk_likelihood = $this->initHttpWithToken()->delete(config('amms_bee_routes.x_risk_likelihoods')."/$id", $data)->json();
        if (isset($delete_risk_likelihood['status']) && $delete_risk_likelihood['status'] == 'success') {
            return response()->json(responseFormat('success', 'Deleted Successfully'));
        } else {
            return response()->json(['status' => 'error', 'data' => $delete_risk_likelihood]);
        }
    }
}
