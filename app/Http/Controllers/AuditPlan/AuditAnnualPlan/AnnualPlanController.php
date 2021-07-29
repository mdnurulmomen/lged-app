<?php

namespace App\Http\Controllers\AuditPlan\AuditAnnualPlan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AnnualPlanController extends Controller
{
    public function index()
    {
        $fiscal_years = $this->allFiscalYears();
        return view('modules.audit_plan.annual.annual_plan.annual_plan_lists', compact('fiscal_years'));
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function showAnnualPlanLists(Request $request)
    {
        $data = Validator::make($request->all(), [
            'fiscal_year_id' => 'required|integer',
        ])->validate();
        $data['cdesk'] = json_encode($this->current_desk());

        $annual_plans = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_annual_plan.ap_yearly_plan_lists'), $data)->json();

        if (isSuccess($annual_plans)) {
            $annual_plans = $annual_plans['data'];
            return view('modules.audit_plan.annual.annual_plan.partials.load_annual_plan_lists', compact('annual_plans'));
        } else {
            return response()->json(['status' => 'error', 'data' => $annual_plans]);
        }

    }

    public function showEntitySelection(Request $request)
    {
        return view('modules.audit_plan.annual.annual_plan.partials.load_annual_entity_selection');
    }
}
