<?php

namespace App\Http\Controllers\AuditPlan\Plan;

use App\Http\Controllers\Controller;

class PlanController extends Controller
{
    public function index()
    {
        return view('modules.audit_plan.audit_plan.plan.plan_lists');
    }

    public function create($id)
    {
        return view('modules.audit_plan.audit_plan.plan.create_plan');
    }
}
