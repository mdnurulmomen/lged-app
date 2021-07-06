<?php

namespace App\Http\Controllers\AuditPlan\AuditAnnualPlan;

use App\Http\Controllers\Controller;

class AnnualCalendarController extends Controller
{
    public function index()
    {
        return view('modules.audit_plan.annual.annual_calendar.annual_calendar');
    }
}
