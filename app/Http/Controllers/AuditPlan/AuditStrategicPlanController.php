<?php

namespace App\Http\Controllers\AuditPlan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuditStrategicPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $this->userPermittedMenusByModule(request()->path());
        return view('modules.audit_plan.strategic.index');
    }

    public function showAuditStrategicPlanDashboard()
    {
        return view('modules.audit_plan.strategic.dashboard.audit_strategic_plan_dashboard');
    }

    public function list(){
        return view('modules.strategic_plan.index');
    }

    public function getStrategicPlanList(){
        $strategic_plan_list = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_strategic_plan.strategic_plan_list'),)->json();
        if (isSuccess($strategic_plan_list)) {
            $strategic_plan_list = $strategic_plan_list['data'];
            return view('modules.strategic_plan.get_strategic_list',compact('strategic_plan_list'));
        } else {
            return response()->json(['status' => 'error', 'data' => $strategic_plan_list]);
        }
    }

    public function showYearWiseStrategicPlan(Request $request){
        $data = Validator::make($request->all(), [
            // 'strategic_plan_id' => 'required|integer',
            'strategic_plan_year' => 'required',
        ])->validate();

        // dd($request);

        // $strategic_plan_id = $request->strategic_plan_id;
        $strategic_plan_year = $request->strategic_plan_year;

        $plan_year = explode(' - ',$strategic_plan_year);
        $start = $plan_year[0];
        $end = $plan_year[1];
        // dd($start);
        // dd($end);
        $strategic_plan_list = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_strategic_plan.get_individual_strategic_plan'), $data)->json();
        $strategic_plan_list = $strategic_plan_list ? $strategic_plan_list['data'] : [];
        // dd($strategic_plan_list);

        // $all_project = $this->initRPUHttp()->post(config('cag_rpu_api.get-all-projects'), [])->json();
        // $all_project = $all_project ? $all_project['data'] : [];

        // $all_function = $this->initRPUHttp()->post(config('cag_rpu_api.functions.list'), [])->json();
        // $all_function = $all_function ? $all_function['data'] : [];

        return view('modules.strategic_plan.partial.show_strategic_year_wise_plan',
            compact('start','end', 'strategic_plan_list'));
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

    public function addLocationRow(Request $request){
        $strategic_year = $request->strategic_year;
        $row_type = $request->row_type;
        $row_count = $request->row_count;
        $all_project = $this->initRPUHttp()->post(config('cag_rpu_api.get-all-projects'), [])->json();
        $all_project = $all_project ? $all_project['data'] : [];

        $all_function = $this->initRPUHttp()->post(config('cag_rpu_api.functions.list'), [])->json();
        $all_function = $all_function ? $all_function['data'] : [];

        return view('modules.strategic_plan.partial.add_location_row',
            compact( 'all_project','all_function','strategic_year','row_type','row_count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $strategic_plan_durations =  $this->allStrategicPlanDurations();
        return view('modules.strategic_plan.create',compact('strategic_plan_durations'));
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
            'strategic_duration_id' => 'required|integer',
            'strategic_plan_year' => 'required',
            'strategic_info' => 'required',
        ])->validate();

        $store = $this->initHttpWithToken()->post(
            config('amms_bee_routes.audit_strategic_plan.strategic_plan_store'),
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
