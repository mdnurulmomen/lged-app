<?php

namespace App\Http\Controllers\Setting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class XRiskLevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('modules.settings.x_risk_level.index');
    }

    public function getRiskLevelList()
    {
        $risk_level_list = $this->initHttpWithToken()->get(config('amms_bee_routes.x_risk_levels'), [
            'all' => 1
        ])->json();

        // dd($risk_level_list);

        if ($risk_level_list['status'] == 'success') {
            $risk_level_list = $risk_level_list['data'];
            return view('modules.settings.x_risk_level.partials.list', compact('risk_level_list'));
        } else {
            return response()->json(['status' => 'error', 'data' => $risk_level_list]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        return view('modules.settings.x_risk_level.partials.create');
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
            'level_from' => 'required|integer|min:1', 
            'level_to' => [
                'required', 'integer', 
                function ($attribute, $value, $fail) use ($request) {
                    if ($value > 5 && $request->input('type') == 'factor_risk_assessment') {
                        $fail('The '.$attribute.' is invalid.');
                    }
                },
            ],
            'type' => 'required|string|max:255|in:factor_risk_assessment,area_risk_assessment',
            'title_bn' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
        ]);
        
        $currentUserId = $this->current_desk()['officer_id'];
        
        $data = [
            'level_from' => $request->level_from,
            'level_to' => $request->level_to,
            'type' => $request->type,
            'title_bn' => $request->title_bn,
            'title_en' => $request->title_en,
            'created_by' => $currentUserId,
            'updated_by' => $currentUserId,
        ];

        $create_risk_level = $this->initHttpWithToken()->post(config('amms_bee_routes.x_risk_levels'), $data)->json();
        //    dd($create_risk_assessment);
        if (isset($create_risk_level['status']) && $create_risk_level['status'] == 'success') {
            return response()->json(responseFormat('success', 'Created Successfully'));
        } else {
            return response()->json(['status' => 'error', 'data' => $create_risk_level]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function riskLevelEdit(Request $request)
    {
        $id = $request->id;
        $level_from = $request->level_from;
        $level_to = $request->level_to;
        $type = $request->type;
        $title_bn = $request->title_bn;
        $title_en = $request->title_en;

        return view('modules.settings.x_risk_level.partials.update', compact('id', 'level_from', 'level_to', 'type', 'title_bn', 'title_en'));
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
            'level_from' => 'required|integer|min:1', 
            'level_to' => [
                'required', 'integer', 
                function ($attribute, $value, $fail) use ($request) {
                    if ($value > 5 && $request->input('type') == 'factor_risk_assessment') {
                        $fail('The '.$attribute.' is invalid.');
                    }
                },
            ],
            'type' => 'required|string|max:255|in:factor_risk_assessment,area_risk_assessment',
            'title_bn' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
        ]);
        
        $data = [
            'id' => $request->id,
            'level_from' => $request->level_from,
            'level_to' => $request->level_to,
            'type' => $request->type,
            'title_bn' => $request->title_bn,
            'title_en' => $request->title_en,
            'updated_by' => $this->current_desk()['officer_id'],
        ];

        $update_risk_level = $this->initHttpWithToken()->put(config('amms_bee_routes.x_risk_levels')."/$id", $data)->json();
//        dd($create_audit_query);
        if (isset($update_risk_level['status']) && $update_risk_level['status'] == 'success') {
            return response()->json(['status' => 'success', 'data' => $update_risk_level['data']]);
        } else {
            return response()->json(['status' => 'error', 'data' => $update_risk_level]);
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
        $delete_risk_level = $this->initHttpWithToken()->delete(config('amms_bee_routes.x_risk_levels')."/$id", $data)->json();
        if (isset($delete_risk_level['status']) && $delete_risk_level['status'] == 'success') {
            return response()->json(responseFormat('success', 'Deleted Successfully'));
        } else {
            return response()->json(['status' => 'error', 'data' => $delete_risk_level]);
        }
    }
}
