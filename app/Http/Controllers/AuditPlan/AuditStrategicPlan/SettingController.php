<?php

namespace App\Http\Controllers\AuditPlan\AuditStrategicPlan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index(){
        $response = $this->initHttpWithToken()->post(
            config('amms_bee_routes.audit_strategic_plan.sp_setting_list'),[]
        )->json();
        $data['settings'] = $response['data'];
        return view('modules.audit_plan.strategic.settings.index',$data);
    }

    public function create(){
        return view('modules.audit_plan.strategic.draft_plan.sp_file_upload');
    }
}
