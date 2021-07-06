<?php

namespace App\Http\Controllers\AuditPlan\AuditAnnualPlan\AnnualCalendar;

use App\Http\Controllers\Controller;

class StaffCalendarController extends Controller
{
    public function index()
    {
        $data = 'dynamic data';
        return view('modules.audit_plan.annual.annual_calendar.staff.staff_calendar', compact('data'));
    }
}
