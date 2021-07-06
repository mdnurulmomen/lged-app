<?php

namespace App\Http\Controllers\AuditPlan\AuditOperationalPlan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OperationalPlanController extends Controller
{
    public function index()
    {
        return view('modules.audit_plan.operational.operational_plan.operational_plan_lists');
    }

    public function showOperationalPlanLists(Request $request)
    {
        return view('modules.audit_plan.operational.operational_plan.partials.load_operational_plan_lists');
    }


    public function showOperationalPlanStaffs(Request $request)
    {
        $activities = '';
        return view('modules.audit_plan.operational.operational_plan.operational_plan_staffs');
    }
}
