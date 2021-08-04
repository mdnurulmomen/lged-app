<?php

namespace App\Http\Controllers\AuditPlan\Plan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class PlanController extends Controller
{
    public function index()
    {
        $fiscal_years = $this->allFiscalYears();
        return view('modules.audit_plan.audit_plan.plan.audit_plan', compact('fiscal_years'));
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function showAuditablePlanLists(Request $request)
    {
        $data = Validator::make($request->all(), [
            'fiscal_year_id' => 'required|integer',
//            'per_page' => 'required|integer',
//            'page' => 'required|integer',
        ])->validate();
        $data['cdesk'] = json_encode($this->current_desk());
//        $all_entities = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_entity_plan.ap_entity_lists'), $data)->json();
        $all_entities = Http::withHeaders($this->apiHeaders())->withToken($this->getBeeToken())->post(config('amms_bee_routes.audit_entity_plan.ap_entity_lists'), $data)->json();

        if (isSuccess($all_entities)) {
            $all_entities = $all_entities['data'];
            return view('modules.audit_plan.audit_plan.plan.plan_lists', compact('all_entities'));
        } else {
            return response()->json(['status' => 'error', 'data' => $all_entities]);
        }
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function create(Request $request)
    {
        Validator::make($request->all(), [
            'party_id' => 'required|integer',
            'rp_id' => 'required|integer',
        ])->validate();
        $party_id = $request->party_id;
        $rp_id = $request->rp_id;
        return view('modules.audit_plan.audit_plan.plan.create_entity_audit_plan', compact('party_id', 'rp_id'));
    }

    public function create1($party_id, $rp_id)
    {
        return view('modules.audit_plan.audit_plan.plan.create_entity_audit_plan', compact('party_id', 'rp_id'));
    }


    public function saveDraftEntityAuditPlan(Request $request)
    {
        Validator::make($request->all(), [
            'party_id' => 'required|integer',
            'yearly_plan_rp_id' => 'required|integer',
            'plan_description' => 'required|string',
        ])->validate();

        $plan = [
            'party_id' => $request->party_id,
            'yearly_plan_rp_id' => $request->yearly_plan_rp_id,
            'plan_description' => makeEncryptedData($request->plan_description),
        ];

        $data['cdesk'] = json_encode($this->current_desk());
        $data['plan'] = json_encode($plan);

        $save_draft = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_entity_plan.ap_entity_plan_make_draft'), $data)->json();

    }
}
