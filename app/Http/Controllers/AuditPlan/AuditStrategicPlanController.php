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
    public function deleteStrategicPlan(Request $request){
        $data = Validator::make($request->all(), [
            'strategic_plan_id' => 'required|integer',
            'strategic_plan_year' => 'required',
        ])->validate();

        $strategic_plan_delete = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_strategic_plan.strategic_plan_delete'),$data)->json();
        // dd($strategic_plan_delete);
        if (isSuccess($strategic_plan_delete)) {
            return response()->json(['status' => 'success', 'data' => $strategic_plan_delete['data']]);
        } else {
            return response()->json(['status' => 'error', 'data' => $strategic_plan_delete]);
        }
    }

    public function showYearWiseStrategicPlan(Request $request){
        $data = Validator::make($request->all(), [
            'strategic_plan_id' => 'required|integer',
            'strategic_plan_year' => 'required',
        ])->validate();


        // $strategic_plan_id = $request->strategic_plan_id;
        $strategic_plan_year = $request->strategic_plan_year;

        $plan_year = explode(' - ',$strategic_plan_year);
        $start = $plan_year[0];
        $end = $plan_year[1];
        // $data['start_year'] = $start;
        // $data['end_year'] = $end;
        $data['scope'] = 'show';
        $strategic_plan_list = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_strategic_plan.get_individual_strategic_plan'), $data)->json();
        $strategic_plan_list = $strategic_plan_list ? $strategic_plan_list['data'] : [];
        // dd($strategic_plan_list);

        // $all_project = $this->initRPUHttp()->post(config('cag_rpu_api.get-all-projects'), [])->json();
        // $all_project = $all_project ? $all_project['data'] : [];

        // $all_function = $this->initRPUHttp()->post(config('cag_rpu_api.functions.list'), [])->json();
        // $all_function = $all_function ? $all_function['data'] : [];

        return view('modules.strategic_plan.partial.show_strategic_year_wise_plan',
            compact('start','end', 'strategic_plan_list', 'data'));
    }

    public function editYearWiseStrategicPlan(Request $request){
        $data = Validator::make($request->all(), [
            'strategic_plan_id' => 'required|integer',
            'strategic_plan_year' => 'required',
        ])->validate();


        // $strategic_plan_id = $request->strategic_plan_id;
        $strategic_plan_year = $request->strategic_plan_year;

        $plan_year = explode(' - ',$strategic_plan_year);
        $start = $plan_year[0];
        $end = $plan_year[1];
        // $data['start_year'] = $start;
        // $data['end_year'] = $end;
        $data['scope'] = 'show';
        $strategic_plan_list = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_strategic_plan.get_individual_strategic_plan'), $data)->json();
        $strategic_plan_list = $strategic_plan_list ? $strategic_plan_list['data'] : [];
        // dd($strategic_plan_list);
        $strategic_plan_durations =  $this->allStrategicPlanDurations();

        $all_project = $this->initRPUHttp()->post(config('cag_rpu_api.get-all-projects'), [])->json();
        $all_project = $all_project ? $all_project['data'] : [];

        $all_function = $this->initRPUHttp()->post(config('cag_rpu_api.functions.list'), [])->json();
        $all_function = $all_function ? $all_function['data'] : [];

        return view('modules.strategic_plan.edit',
            compact('start','end', 'strategic_plan_list','strategic_plan_durations', 'data'));
    }

    public function downloadYearWiseStrategicPlan(Request $request){
        $data = Validator::make($request->all(), [
            'strategic_plan_id' => 'required|integer',
            'strategic_plan_year' => 'required',
        ])->validate();


        // $strategic_plan_id = $request->strategic_plan_id;
        $strategic_plan_year = $request->strategic_plan_year;

        $plan_year = explode(' - ',$strategic_plan_year);
        $start = $plan_year[0];
        $end = $plan_year[1];
        $data['start'] = $start;
        $data['end'] = $end;
        $data['scope'] = 'download';
        $data['office_id'] = $this->current_office_id();
        $strategic_plan_list = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_strategic_plan.get_individual_strategic_plan'), $data)->json();
        $strategic_plan_list = $strategic_plan_list ? $strategic_plan_list['data'] : [];
        $data['strategic_plan_list'] = $strategic_plan_list;
        // dd($data);

        $pdf = \PDF::loadView('modules.strategic_plan.partial.download_strategic_year_wise_plan', $data, ['orientation' => 'P', 'format' => 'A4']);
        return $pdf->stream('document.pdf');
    }

    public function getYearWiseStrategicPlan(Request $request){
        // dd($request->all());
        $strategic_plan_year = $request->strategic_plan_year;

        $plan_year = explode(' - ',$strategic_plan_year);
        $start = $plan_year[0];
        $end = $plan_year[1];

        $all_project = $this->initRPUHttp()->post(config('cag_rpu_api.get-all-projects'), [])->json();
        $all_project = $all_project ? $all_project['data'] : [];

        $all_function = $this->initRPUHttp()->post(config('cag_rpu_api.functions.list'), [])->json();
        $all_function = $all_function ? $all_function['data'] : [];
        // $data = [
        //     'strategic_plan_id' =>
        //     'strategic_plan_year' => $start,
        // ];
        $strategic_plan_year_id = $request->strategic_plan_year_id;
        // $individual_strategic_plans = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_strategic_plan.get_individual_strategic_plan'),$data)->json();
        // dd($individual_strategic_plans);
        if($request->scop == 'edit'){
            return view('modules.strategic_plan.partial.edit_strategic_year_wise_plan',
            compact('start','end', 'all_project','all_function','strategic_plan_year_id'));
        }else{
            return view('modules.strategic_plan.partial.strategic_year_wise_plan',
            compact('start','end', 'all_project','all_function'));
        }
    }
    public function showYearWiseStrategicPlanContent(Request $request){
        $data = [
            'strategic_plan_id' => $request->strategic_plan_year_id,
            'strategic_plan_year' => $request->year,
        ];
        $individual_strategic_plans = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_strategic_plan.get_individual_strategic_plan'),$data)->json();
        $individual_strategic_plan = isSuccess($individual_strategic_plans) ? $individual_strategic_plans['data'] : [];
        // dd($individual_strategic_plan);
        $all_project = $this->initRPUHttp()->post(config('cag_rpu_api.get-all-projects'), [])->json();
        $all_project = $all_project ? $all_project['data'] : [];

        $all_function = $this->initRPUHttp()->post(config('cag_rpu_api.functions.list'), [])->json();
        $all_function = $all_function ? $all_function['data'] : [];
        return view('modules.strategic_plan.partial.edit_strategic_year_wise_plan_content',compact('individual_strategic_plan','data','all_project','all_function'));

    }


    public function getCostCenterProjectMap(Request $request){
        $data['sector_id'] = $request->project_id;
        $data['sector_type'] = 'project';
        $cost_center_list = $this->initRPUHttp()->post(config('cag_rpu_api.cost-center-sector-map.cost-centers'), $data)->json();
        $cost_center_list = $cost_center_list ? $cost_center_list['data'] : [];
        // dd($cost_center_list);
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
        // dd($strategic_plan_durations);
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
    public function update(Request $request)
    {
        $data = Validator::make($request->all(), [
            'strategic_plan_id' => 'required|integer',
            'strategic_plan_year' => 'required',
            'strategic_info' => 'required',
        ])->validate();
        $update = $this->initHttpWithToken()->post(
            config('amms_bee_routes.audit_strategic_plan.strategic_plan_update'),
            $data
        )->json();
        // dd($update);
        if (isSuccess($update)) {
            return response()->json(['status' => 'success', 'data' => $update['data']]);
        } else {
            return response()->json(['status' => 'error', 'data' => $update]);
        }
    }
    public function deleteLocationData(Request $request)
    {
        $data = Validator::make($request->all(), [
            'location_id' => 'required|integer',
        ])->validate();

        $delete_location = $this->initHttpWithToken()->post(
            config('amms_bee_routes.audit_strategic_plan.delete_location'),
            $data
        )->json();

        if (isSuccess($delete_location)) {
            return response()->json(['status' => 'success', 'data' => $delete_location['data']]);
        } else {
            return response()->json(['status' => 'error', 'data' => $delete_location]);
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
    // public function update(Request $request, $id)
    // {
    //     //
    // }

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
