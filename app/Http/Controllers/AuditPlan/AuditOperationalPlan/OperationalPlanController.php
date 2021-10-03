<?php

namespace App\Http\Controllers\AuditPlan\AuditOperationalPlan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OperationalPlanController extends Controller
{
    public function index()
    {
        $fiscal_years = $this->allFiscalYears();
        return view('modules.audit_plan.operational.operational_plan.operational_plan_lists', compact('fiscal_years'));
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function showOperationalPlanLists(Request $request)
    {
        Validator::make($request->all(), ['fiscal_year' => 'required|integer',])->validate();

        $ops = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_operational_plan.load_operational_plan_lists'), ['fiscal_year_id' => $request->fiscal_year])->json();

        if ($ops['status'] = 'success') {
            $ops = $ops['data'];
            return view('modules.audit_plan.operational.operational_plan.partials.load_operational_plan_lists', compact('ops'));
        } else {
            return response()->json(['status' => 'error', 'data' => 'Sorry!']);
        }
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function showOperationalPlanStaffAndDetailsModal(Request $request)
    {
        Validator::make($request->all(), ['activity_id' => 'required|integer',])->validate();

        $staff_details = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_operational_plan.load_operational_plan_lists'),
            [
                'activity_id' => $request->activity_id,
                'fiscal_year_id' => 1
            ])
            ->json();

        if ($staff_details['status'] = 'success') {
            $staff_details = $staff_details['data'];
            return view('modules.audit_plan.operational.operational_plan.partials.load_assigned_staff_and_details_modal', compact('staff_details'));
        } else {
            return response()->json(['status' => 'error', 'data' => 'Sorry!']);
        }
    }


    public function showOperationalPlanStaffs(Request $request)
    {
        Validator::make($request->all(), ['fiscal_year' => 'required|integer',])->validate();

        $ops = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_operational_plan.load_operational_plan_details'), ['fiscal_year_id' => $request->fiscal_year])->json();

        if ($ops['status'] = 'success') {
            $ops = $ops['data'];
            return view('modules.audit_plan.operational.operational_plan.operational_plan_staffs', compact('ops'));
        } else {
            return response()->json(['status' => 'error', 'data' => 'Sorry!']);
        }
    }

    public function showActivityWiseTeam(Request $request)
    {
        return view('modules.audit_plan.operational.operational_plan.partials.load_activity_wise_team');
    }
}
