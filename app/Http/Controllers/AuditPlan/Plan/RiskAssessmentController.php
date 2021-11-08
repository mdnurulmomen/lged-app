<?php

namespace App\Http\Controllers\AuditPlan\Plan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RiskAssessmentController extends Controller
{

    public function loadRiskAssessment(Request $request)
    {
        $fiscal_year_id = $request->fiscal_year_id;
        $audit_plan_id = $request->audit_plan_id;
        $activity_id = $request->activity_id;
//        dd($request->all());
//        $risk_assessment_list = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.risk_assessment_lists'), [
//            'all' => 1
//        ])->json();
//        dd($risk_assessment_list);
        return view('modules.audit_plan.audit_plan.plan_revised.partials.load_risk_assessment', compact('fiscal_year_id','audit_plan_id','activity_id'));
//        if ($risk_assessment_list['status'] == 'success') {
//            $risk_assessment_list = $risk_assessment_list['data'];
//            return view('modules.audit_plan.audit_plan.plan_revised.partials.load_risk_assessment', compact('risk_assessment_list','fiscal_year_id','audit_plan_id','activity_id'));
//        } else {
//            return response()->json(['status' => 'error', 'data' => $risk_assessment_list]);
//        }
    }

    public function loadRiskAssessmentTypeWise(Request $request)
    {
        $data['risk_assessment_type'] = $request->risk_assessment_type;
        $risk_assessment_list = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.risk_assessment_lists'), $data)->json();
//        dd($risk_assessment_list);
        if ($risk_assessment_list['status'] == 'success') {
            $risk_assessment_list = $risk_assessment_list['data'];
            $risk_assessment_type = $data['risk_assessment_type'];
            return view('modules.audit_plan.audit_plan.plan_revised.partials.get_risk_assessment_type_wise', compact('risk_assessment_list','risk_assessment_type'));
        } else {
            return response()->json(['status' => 'error', 'data' => $risk_assessment_list]);
        }
    }

    public function store(Request $request)
    {
//        dd($request->all());
        $data['cdesk'] = json_encode_unicode($this->current_desk());
        $data['risk_assessments'] = $request->risk_assessments;
        $data['fiscal_year_id'] = $request->fiscal_year_id;
        $data['activity_id'] = $request->activity_id;
        $data['audit_plan_id'] = $request->audit_plan_id;
        $data['risk_rate'] = $request->risk_rate;
        $data['total_number'] = $request->total_number;
        $data['risk'] = $request->risk;
        $data['risk_assessment_type'] = $request->risk_assessment_type;

//        dd($data);
        $risk_assessment_store = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_entity_plan.ap_risk_assessment_store'), $data)->json();

        if ($risk_assessment_store['status'] == 'success') {
            $risk_assessment_store = $risk_assessment_store['data'];
            return response()->json(['status' => 'success', 'data' => $risk_assessment_store]);
        } else {
            return response()->json(['status' => 'error', 'data' => $risk_assessment_store]);
        }
    }

    public function book(Request $request)
    {
        $data['risk_assessments'] = $request->risk_assessments;
        $data['risk_rate'] = $request->risk_rate;
        $data['total_number'] = $request->total_number;
        $data['risk'] = $request->risk;
        $data['risk_assessment_type'] = $request->risk_assessment_type;

        return view('modules.audit_plan.audit_plan.plan_revised.partials.risk_assessment_book', $data);

    }



}
