<?php

namespace App\Http\Controllers\AuditPlan\AuditAnnualPlan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuditAssessmentScoreController extends Controller
{
    public function index()
    {
        $fiscal_years = $this->allFiscalYears();
        return view('modules.audit_plan.annual.audit_assessment_score.index', compact('fiscal_years'));
    }

    public function create()
    {
        $data['cdesk'] = $this->current_desk_json();

        $fiscal_years = $this->allFiscalYears();

        //categories
        $categoryResponseData = $this->initRPUHttp()->post(config('cag_rpu_api.get-office-category-types'), [])->json();
        $categories = isSuccess($categoryResponseData) ? $categoryResponseData['data'] : [];

        //ministries
        $ministryResponseData = $this->initRPUHttp()->post(config('cag_rpu_api.get-office-ministry-list'),       ['directorate_id' => $this->current_office_id()])->json();
        $ministries = isSuccess($ministryResponseData) ? $ministryResponseData['data'] : [];

        //criteria
        $criteriaResponseData = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.audit_assessment.criteria.lists'), $data)->json();
        $criteriaList = isSuccess($criteriaResponseData) ? $criteriaResponseData['data'] : [];

        return view('modules.audit_plan.annual.audit_assessment_score.create', compact('fiscal_years','categories',
            'ministries','criteriaList'));

    }

    public function list(Request $request)
    {
        $data['cdesk'] = $this->current_desk_json();
        $data['fiscal_year_id'] = $request->fiscal_year_id;
        $scores = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_annual_plan.audit_assessment.score.list'), $data)->json();
        //dd($scores);
        if (isSuccess($scores)) {
            $scores = $scores['data'];
            return view('modules.audit_plan.annual.audit_assessment_score.partials.load_score_list', compact('scores'));
        } else {
            return response()->json(['status' => 'error', 'data' => $scores]);
        }
    }

    public function loadMinistryWiseEntity(Request $request)
    {
        //offices
        $officeResponseData = $this->initRPUHttp()->post(config('cag_rpu_api.office-ministry-wise-entity'),       ['office_ministry_id' => $request->ministry_id])->json();
        $offices = isSuccess($officeResponseData) ? $officeResponseData['data'] : [];

        return view('modules.audit_plan.annual.audit_assessment_score.partials.load_office_entity',compact('offices'));

    }

    public function store(Request $request)
    {
        $data['cdesk'] = $this->current_desk_json();
        $data['category_id'] = $request->category_id;
        $data['category_title_en'] = $request->category_title_en;
        $data['category_title_bn'] = $request->category_title_bn;
        $data['fiscal_year_id'] = $request->fiscal_year_id;
        $data['ministry_id'] = $request->ministry_id;
        $data['ministry_name_en'] = $request->ministry_name_en;
        $data['ministry_name_bn'] = $request->ministry_name_bn;
        $data['entity_id'] = $request->entity_id;
        $data['entity_name_en'] = $request->entity_name_en;
        $data['entity_name_bn'] = $request->entity_name_bn;

        $data['criteria_ids'] = $request->criteria_ids;
        $data['values'] = $request->values;
        $data['scores'] = $request->scores;

        $responseData = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_annual_plan.audit_assessment.score.store'), $data)->json();

        //dd($responseData);

        if ($responseData['status'] == 'success') {
            $responseData = $responseData['data'];
            return response()->json(['status' => 'success', 'data' => $responseData]);
        } else {
            return response()->json(['status' => 'error', 'data' => $responseData]);
        }
    }
}
