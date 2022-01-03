<?php

namespace App\Http\Controllers\AuditPlan\AuditAnnualPlan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuditAssessmentController extends Controller
{
    public function index()
    {
        $fiscal_years = $this->allFiscalYears();
        return view('modules.audit_plan.annual.audit_assessment.index', compact('fiscal_years'));
    }

    public function list(Request $request)
    {
        $data['cdesk'] = $this->current_desk_json();
        $data['fiscal_year_id'] = $request->fiscal_year_id;
        $entities = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_annual_plan.audit_assessment.list'), $data)->json();
        if (isSuccess($entities)) {
            $entities = $entities['data'];
            return view('modules.audit_plan.annual.audit_assessment.partials.load_assessment_list', compact('entities'));
        } else {
            return response()->json(['status' => 'error', 'data' => $entities]);
        }
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $data['cdesk'] = $this->current_desk_json();
        $data['audit_assessment_score_ids'] = $request->audit_assessment_score_ids;
        $data['first_half_data'] = explode(",",$request->first_half_data);
        $data['second_half_data'] = explode(",",$request->second_half_data);

        $responseData = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_annual_plan.audit_assessment.store'), $data)->json();

        //dd($responseData);

        if ($responseData['status'] == 'success') {
            $responseData = $responseData['data'];
            return response()->json(['status' => 'success', 'data' => $responseData]);
        } else {
            return response()->json(['status' => 'error', 'data' => $responseData]);
        }
    }

    public function storeAnnualPlan(Request $request)
    {
        //dd($request->all());
        $data['cdesk'] = $this->current_desk_json();
        $data['audit_assessment_score_ids'] = $request->audit_assessment_score_ids;
        $data['ministry_ids'] = $request->ministry_ids;
        $data['bn_ministry_names'] = $request->bn_ministry_names;
        $data['en_ministry_names'] = $request->en_ministry_names;
        $data['entity_ids'] = $request->entity_ids;
        $data['bn_entity_names'] = $request->bn_entity_names;
        $data['en_entity_names'] = $request->en_entity_names;
        $data['first_half_data'] = explode(",",$request->first_half_data);
        $data['second_half_data'] = explode(",",$request->second_half_data);

        $responseData = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_annual_plan.audit_assessment.store_annual_plan'), $data)->json();

        //dd($responseData);

        if ($responseData['status'] == 'success') {
            $responseData = $responseData['data'];
            return response()->json(['status' => 'success', 'data' => $responseData]);
        } else {
            return response()->json(['status' => 'error', 'data' => $responseData]);
        }
    }
}
