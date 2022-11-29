<?php

namespace App\Http\Controllers\RiskAssessment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RiskAssessmentFactorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */

    public function index(){
        return view('modules.risk_assessment.risk_factor_approach.index');
    }

    public function loadRiskAssessmentFactor(Request $request){
        $data['type'] = $request->type;
//        dd($data);
        $all_risk_factors = $this->initHttpWithToken()->get(config('amms_bee_routes.x_risk_factors'), [])->json();
        $all_risk_assessment_factors = $this->initHttpWithToken()->post(config('amms_bee_routes.risk_assessment_factor.list'), $data)->json();
        // dd($all_risk_assessment_factors['data']);
        if (isSuccess($all_risk_factors)) {
            $all_risk_factors = $all_risk_factors['data'];
            $all_risk_assessment_factors = $all_risk_assessment_factors['data'];
            return view('modules.risk_assessment.risk_factor_approach.load_risk_assessment_factor',compact('all_risk_factors','all_risk_assessment_factors'));
        } else {
            return response()->json(['status' => 'error', 'data' => $all_risk_factors]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $all_risk_factors = $this->initHttpWithToken()->get(config('amms_bee_routes.x_risk_factors'), [])->json();
        if (isSuccess($all_risk_factors)) {
            $all_risk_factors = $all_risk_factors['data'];
            return view('modules.risk_assessment.risk_factor_approach.create',compact('all_risk_factors'));
        } else {
            return response()->json(['status' => 'error', 'data' => $all_risk_factors]);
        }
    }

    public function loadProjectSelect(Request $request){
        $all_project = $this->initRPUHttp()->post(config('cag_rpu_api.get-all-projects'), [])->json();

        // dd($all_project);

        if (isSuccess($all_project)) {
            $all_project = $all_project['data'];
            return view('modules.settings.project.project_select',compact('all_project'));
        } else {
            return response()->json(['status' => 'error', 'data' => $all_project]);
        }
    }

    public function loadFunctionSelect(Request $request){
        $all_function = $this->initRPUHttp()->post(config('cag_rpu_api.functions.list'), [])->json();
        if (isSuccess($all_function)) {
            $all_function = $all_function['data'];
            return view('modules.settings.function.function_select',compact('all_function'));
        } else {
            return response()->json(['status' => 'error', 'data' => $all_function]);
        }
    }

    public function loadUnitMasterSelect(Request $request){
        $all_unit_master = $this->initRPUHttp()->post(config('cag_rpu_api.master_units.list'), [])->json();
        if (isSuccess($all_unit_master)) {
            $all_unit_master = $all_unit_master['data'];
            return view('modules.settings.unit_master.unit_master_select',compact('all_unit_master'));
        } else {
            return response()->json(['status' => 'error', 'data' => $all_unit_master]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $data = Validator::make($request->all(), [
            'risk_factor_info' => 'required',
            'risk_factor_info.item_id' => 'required|integer',
            'risk_factor_info.item_name_en' => 'required|string',
            'risk_factor_info.item_name_bn' => 'required|string',
            'risk_factor_info.item_type' => 'required|string|in:project,function,master-unit',
            'risk_factor_items' => 'required|array',
            'risk_factor_items.*.comment' => 'nullable|string',
            'risk_factor_items.*.attachment' => 'nullable|mimes:png,jpg,jpeg,csv,doc,docx,pdf,zip,rar|max:2048'
        ])->validate();
            
        // dd($data);
        
        $data['cdesk'] = $this->current_desk_json();
        
        $data = [
            ['name' => 'risk_factor_info[item_id]', 'contents' => $data['risk_factor_info']['item_id']],
            ['name' => 'risk_factor_info[item_name_en]', 'contents' => $data['risk_factor_info']['item_name_en']],
            ['name' => 'risk_factor_info[item_name_bn]', 'contents' => $data['risk_factor_info']['item_name_bn']],
            ['name' => 'risk_factor_info[item_type]', 'contents' => $data['risk_factor_info']['item_type']],
            ['name' => 'cdesk', 'contents' => $this->current_desk_json()],
        ];
        
        foreach ($request->risk_factor_items as $key => $factorItem) {
            $data[] = [
                'name' => "risk_factor_items[$key][x_risk_factor_id]",
                'contents' => $factorItem['x_risk_factor_id']
            ];

            $data[] = [
                'name' => "risk_factor_items[$key][risk_factor_title_bn]",
                'contents' => $factorItem['risk_factor_title_bn']
            ];

            $data[] = [
                'name' => "risk_factor_items[$key][risk_factor_title_en]",
                'contents' => $factorItem['risk_factor_title_en']
            ];

            $data[] = [
                'name' => "risk_factor_items[$key][factor_weight]",
                'contents' => $factorItem['factor_weight']
            ];

            $data[] = [
                'name' => "risk_factor_items[$key][factor_rating]",
                'contents' => $factorItem['factor_rating']
            ];

            $data[] = [
                'name' => "risk_factor_items[$key][comment]",
                'contents' => $factorItem['comment']
            ];
            
            $data[] = [
                'name' => "risk_factor_items[$key][attachment]",
                'contents' => is_file($factorItem['attachment']) ? file_get_contents($factorItem['attachment']->getRealPath()) : '',
                'filename' => is_file($factorItem['attachment']) ? $factorItem['attachment']->getClientOriginalName() : '',
            ];
        }
       
        // dd($data);

        $store = $this->fileUPloadWithData(
            config('amms_bee_routes.risk_assessment_factor.store'),
            $data,
            'POST',
        );

        // dd(json_decode($store->getBody(), true));
        
        $store = json_decode($store->getBody(), true);
            
        // dd($store, isSuccess($store));

        if (isSuccess($store)) {

            $data = [
                'id' => $store['data']['id'],
                'risk_score_key' => $store['data']['risk_score_key'],
                'total_risk_score' => $store['data']['total_risk_score'],
            ];

            if ($request['risk_factor_info']['item_type']=='project') {
                
                $store = $this->initRPUHttp()->post(config('cag_rpu_api.update-projects'), $data)->json();
                
            }
            else if ($request['risk_factor_info']['item_type']=='function') {

                $store = $this->initRPUHttp()->put(config('cag_rpu_api.functions.update'), $data)->json();

            }
            else if ($request['risk_factor_info']['item_type']=='master-unit') {

                $store = $this->initRPUHttp()->put(config('cag_rpu_api.master_units.update'), $data)->json();

            }
            
            // dd($store);

            return response()->json(['status' => 'success', 'data' => $store['data']]);
        } else {
            return response()->json(['status' => 'error', 'data' => $store]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
