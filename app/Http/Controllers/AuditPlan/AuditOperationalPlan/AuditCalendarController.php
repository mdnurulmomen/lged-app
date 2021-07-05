<?php

namespace App\Http\Controllers\AuditPlan\AuditOperationalPlan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuditCalendarController extends Controller
{
    public function index()
    {
        return view('modules.audit_plan.operational.audit_calendar.operational_calendar');
    }

    public function showScheduleMilestoneByFiscalYear(Request $request)
    {
        return view('modules.audit_plan.operational.audit_calendar.partials.load_schedule_milestones');
    }
}
