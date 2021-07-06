<?php

namespace App\Http\Controllers\AuditPlan\AuditAnnualPlan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AnnualPlanController extends Controller
{
    public function index()
    {
        return view('modules.audit_plan.annual.annual_plan.annual_plan_lists');
    }

    public function showAnnualPlanLists(Request $request)
    {
        return view('modules.audit_plan.annual.annual_plan.partials.load_annual_plan_lists');
    }

    public function showEntitySelection(Request $request)
    {
        $activity_name = 'Activity Name';
        return view('modules.audit_plan.annual.annual_plan.partials.load_annual_entity_selection', compact('activity_name'));
    }
}
