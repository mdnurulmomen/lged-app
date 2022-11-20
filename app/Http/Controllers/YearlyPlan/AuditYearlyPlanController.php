<?php

namespace App\Http\Controllers\YearlyPlan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuditYearlyPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */

    public function index(){
        return view('modules.yearly_plan.index');
    }

    public function getYearlyPlanList(){
        $yearly_plan_list = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_yearly_plan.yearly_plan_list'),)->json();
        if (isSuccess($yearly_plan_list)) {
            $yearly_plan_list = $yearly_plan_list['data'];
            return view('modules.yearly_plan.get_yearly_list',compact('yearly_plan_list'));
        } else {
            return response()->json(['status' => 'error', 'data' => $yearly_plan_list]);
        }
    }

    public function getYearWiseStrategicPlan(Request $request){
        $strategic_plan_year = $request->strategic_plan_year;
        $plan_year = explode(' - ',$strategic_plan_year);
        $start = $plan_year[0];
        $end = $plan_year[1];

        $all_project = $this->initRPUHttp()->post(config('cag_rpu_api.get-all-projects'), [])->json();
        $all_project = $all_project ? $all_project['data'] : [];

        $all_function = $this->initRPUHttp()->post(config('cag_rpu_api.functions.list'), [])->json();
        $all_function = $all_function ? $all_function['data'] : [];

        return view('modules.strategic_plan.partial.strategic_year_wise_plan',
            compact('start','end', 'all_project','all_function'));
    }

    public function getCostCenterProjectMap(Request $request){
        $data['project_id'] = $request->project_id;
        $cost_center_list = $this->initRPUHttp()->post(config('cag_rpu_api.cost-center-project-map.get-cost-center-project-map'), $data)->json();
        $cost_center_list = $cost_center_list ? $cost_center_list['data'] : [];

        return view('modules.strategic_plan.partial.cost_center_select',
            compact('cost_center_list'));

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $individual_strategic_plan_year = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_strategic_plan.get_individual_strategic_plan_year'))->json();

        if (isSuccess($individual_strategic_plan_year)) {
            $individual_strategic_plan_year = $individual_strategic_plan_year['data'];
            return view('modules.yearly_plan.create',compact('individual_strategic_plan_year'));
        } else {
            return response()->json(['status' => 'error', 'data' => $individual_strategic_plan_year]);
        }

    }

    public function getIndividualStrategicPlan(Request $request){

        $data = Validator::make($request->all(), [
            'strategic_plan_year' => 'required|integer',
        ])->validate();

        $all_project = $this->initRPUHttp()->post(config('cag_rpu_api.get-all-projects'), [])->json();
        $all_project = $all_project ? $all_project['data'] : [];

        $all_function = $this->initRPUHttp()->post(config('cag_rpu_api.functions.list'), [])->json();
        $all_function = $all_function ? $all_function['data'] : [];

        $individual_strategic_plan = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_strategic_plan.get_individual_strategic_plan'),$data)->json();
//        dd($individual_strategic_plan);
        if (isSuccess($individual_strategic_plan)) {
            $individual_strategic_plan = $individual_strategic_plan['data'];
            return view('modules.yearly_plan.partial.strategic_year_wise_plan',compact('individual_strategic_plan','all_function','all_project','data'));
        } else {
            return response()->json(['status' => 'error', 'data' => $individual_strategic_plan]);
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
            'strategic_plan_id' => 'required|integer',
            'strategic_plan_year' => 'required',
            'strategic_info' => 'required',
        ])->validate();

        $store = $this->initHttpWithToken()->post(
            config('amms_bee_routes.audit_yearly_plan.yearly_plan_store'),
            $data
        )->json();

        if (isSuccess($store)) {
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
