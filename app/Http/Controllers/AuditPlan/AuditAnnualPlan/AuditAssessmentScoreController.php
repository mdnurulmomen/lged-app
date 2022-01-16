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
        $fiscal_years = $this->allFiscalYears();

        //categories
        $categoryResponseData = $this->initRPUHttp()->post(config('cag_rpu_api.get-office-category-types'), [])->json();
        $categories = isSuccess($categoryResponseData) ? $categoryResponseData['data'] : [];

        //ministries
        $ministryResponseData = $this->initRPUHttp()->post(config('cag_rpu_api.get-office-ministry-list'),       ['directorate_id' => $this->current_office_id()])->json();
        $ministries = isSuccess($ministryResponseData) ? $ministryResponseData['data'] : [];

        return view('modules.audit_plan.annual.audit_assessment_score.create', compact('fiscal_years','categories',
            'ministries'));

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
        $data['office_type'] = $request->category_id;
        $data['office_ministry_id'] = $request->ministry_id;
        $officeResponseData = $this->initRPUHttp()->post(config('cag_rpu_api.office-ministry-wise-entity'),$data)->json();
        $offices = isSuccess($officeResponseData) ? $officeResponseData['data'] : [];
        return view('modules.audit_plan.annual.audit_assessment_score.partials.load_office_entity',compact('offices'));
    }

    public function loadCategoryWiseCriteriaList(Request $request)
    {
        $data['category_id'] = $request->category_id;
        $criteriaResponseData = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.audit_assessment.criteria.list-category-wise'), $data)->json();
        $criteriaList = isSuccess($criteriaResponseData) ? $criteriaResponseData['data'] : [];
        return view('modules.audit_plan.annual.audit_assessment_score.partials.load_criteria_table',compact('criteriaList'));
    }

    public function edit(Request $request)
    {
        $fiscal_years = $this->allFiscalYears();

        //categories
        $categoryResponseData = $this->initRPUHttp()->post(config('cag_rpu_api.get-office-category-types'), [])->json();
        $categories = isSuccess($categoryResponseData) ? $categoryResponseData['data'] : [];

        //ministries
        $ministryResponseData = $this->initRPUHttp()->post(config('cag_rpu_api.get-office-ministry-list'),       ['directorate_id' => $this->current_office_id()])->json();
        $ministries = isSuccess($ministryResponseData) ? $ministryResponseData['data'] : [];

        //edit
        $data['cdesk'] = $this->current_desk_json();
        $data['audit_assessment_score_id'] = $request->audit_assessment_score_id;
        $auditAssessmentScoreInfo = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_annual_plan.audit_assessment.score.edit'), $data)->json();
        //dd($auditAssessmentScoreInfo);
        if (isSuccess($auditAssessmentScoreInfo)) {
            $auditAssessmentScoreInfo = $auditAssessmentScoreInfo['data'];
            return view('modules.audit_plan.annual.audit_assessment_score.edit', compact('fiscal_years','categories','ministries','auditAssessmentScoreInfo'));
        } else {
            return response()->json(['status' => 'error', 'data' => $auditAssessmentScoreInfo]);
        }
    }

    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'category_id' => 'required|integer',
            'fiscal_year_id' => 'required',
            'ministry_id' => 'required',
            'entity_id' => 'required',
            'point' => 'required',
        ],
        [
            'category_id.required'  => 'Category is required',
            'fiscal_year_id.required'  => 'Fiscal year is required',
            'ministry_id.required'  => 'Ministry is required',
            'entity_id.required'  => 'Entity is required',
            'point.required'  => 'Point is required',
        ])->validate();

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
        $data['point'] = $request->point;

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
