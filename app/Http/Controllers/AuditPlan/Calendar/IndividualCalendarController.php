<?php

namespace App\Http\Controllers\AuditPlan\Calendar;

use App\Http\Controllers\Controller;

class IndividualCalendarController extends Controller
{
    public function index()
    {
        return view('modules.audit_plan.calendar.index');
    }
}
