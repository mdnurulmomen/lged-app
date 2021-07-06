<?php

namespace App\Http\Controllers\AuditPlan;

use App\Http\Controllers\Controller;

class AuditPlanController extends Controller
{
    public function index()
    {
        return view('modules.audit_plan.audit_plan.index');
    }

    public function showAuditPlanDashboard()
    {
        return view('modules.audit_plan.audit_plan.dashboard.audit_plan_dashboard');
    }
}
