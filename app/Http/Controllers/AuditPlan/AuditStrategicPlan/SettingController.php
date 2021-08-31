<?php

namespace App\Http\Controllers\AuditPlan\AuditStrategicPlan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    public function index(){
        $response = $this->initHttpWithToken()->post(
            config('amms_bee_routes.audit_strategic_plan.sp_setting_list'),[]
        )->json();
        $data['settings'] = $response['data'];
        //dd($data);
        return view('modules.audit_plan.strategic.settings.index',$data);
    }

    public function create(){
        $plan_durations = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.strategic_plan_duration_lists'), [
            'all' => 1
        ])->json();
        if ($plan_durations['status'] == 'success') {
            $data['plan_durations'] = $plan_durations['data'];
        } else {
            $data['plan_durations'] = [];
        }

        return view('modules.audit_plan.strategic.settings.create',$data);
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
}
