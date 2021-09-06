<?php

namespace App\Http\Controllers\AuditPlan\AuditStrategicPlan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HTMLViewController extends Controller
{
    public function index(){
        $response = $this->initHttpWithToken()->post(
            config('amms_bee_routes.audit_strategic_plan.sp_setting_list'),[]
        )->json();
        $data['settings'] = $response['data'];
        //dd($data);
        return view('modules.audit_plan.strategic.settings.index',$data);
    }

    public function contentView(){
        $plan_durations = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.strategic_plan_duration_lists'), [
            'all' => 1
        ])->json();
        if ($plan_durations['status'] == 'success') {
            $data['plan_durations'] = $plan_durations['data'];
        } else {
            $data['plan_durations'] = [];
        }
        return view('modules.audit_plan.strategic.settings.view',$data);
    }

    public function createContent(){
        $plan_durations = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.strategic_plan_duration_lists'), [
            'all' => 1
        ])->json();
        if ($plan_durations['status'] == 'success') {
            $data['plan_durations'] = $plan_durations['data'];
        } else {
            $data['plan_durations'] = [];
        }

        return view('modules.audit_plan.strategic.settings.create_content',$data);
    }

    public function createKey(){
        $plan_durations = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.strategic_plan_duration_lists'), [
            'all' => 1
        ])->json();
        if ($plan_durations['status'] == 'success') {
            $data['plan_durations'] = $plan_durations['data'];
        } else {
            $data['plan_durations'] = [];
        }

        return view('modules.audit_plan.strategic.settings.create_key',$data);
    }

    public function storeKey(Request $request)
    {
        Validator::make($request->all(), [
            'fiscal_year' => 'required',
            'title' => 'required',
            'parent_id' => 'required',
        ])->validate();

        $responseData = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_strategic_plan.html_view_content_title_store'), [
            'fiscal_year' => $request->fiscal_year,
            'title' => $request->title,
            'parent_id' => $request->parent_id,
            'created_by' => 1,
        ])->json();

        //dd($responseData);

        if ($responseData['status'] == 'success') {
            return response()->json(['status' => 'success', 'data' => $responseData['data']]);
        } else {
            return response()->json(['status' => 'error', 'data' => 'Server Error']);
        }
    }

    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'fiscal_year' => 'required',
            'file' => 'required|mimes:pdf|max:10420',
        ])->validate();

        $responseData = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_strategic_plan.sp_setting_store'), [
            'fiscal_year' => $request->fiscal_year,
            'keys' => $request->keys,
            'values' => $request->values,
        ])->json();

        if ($responseData['status'] == 'success') {
            return response()->json(['status' => 'success', 'data' => $responseData['data']]);
        } else {
            return response()->json(['status' => 'error', 'data' => 'Server Error']);
        }
    }


    public function loadParentDurationWiseSelect(Request $request)
    {
        $responseData = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_strategic_plan.html_view_content_title_duration_wise'), [
            'fiscal_year' => $request->fiscal_year
        ])->json();

        //dd($responseData);
        if ($responseData['status'] == 'success') {
            $data['titles'] = $responseData['data'];
        } else {
            $data['titles'] = [];
        }
        return view('modules.audit_plan.strategic.settings.partial.select_title_parent',$data);
    }
}
