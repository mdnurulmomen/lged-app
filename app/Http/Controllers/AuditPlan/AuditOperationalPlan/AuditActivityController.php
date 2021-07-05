<?php

namespace App\Http\Controllers\AuditPlan\AuditOperationalPlan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuditActivityController extends Controller
{
    public function index()
    {
        return view('modules.audit_plan.operational.audit_activity.annual_audit_activity_lists');
    }

    public function create()
    {
        return view('modules.audit_plan.operational.audit_activity.create_annual_audit_activity');
    }

    public function show(Request $request)
    {
        return view('modules.audit_plan.operational.audit_activity.view_annual_audit_activity');
    }

    public function edit(Request $request)
    {
        return view('modules.audit_plan.operational.audit_activity.edit_annual_audit_activity');
    }
}
