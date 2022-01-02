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

    public function create()
    {
        $data['cdesk'] = $this->current_desk_json();

        $fiscal_years = $this->allFiscalYears();

        //categories
        $categoryResponseData = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.audit_assessment.category.lists'), [])->json();
        $categories = isSuccess($categoryResponseData) ? $categoryResponseData['data'] : [];

        //ministries
        $ministryResponseData = $this->initRPUHttp()->post(config('cag_rpu_api.get-office-ministry-list'),       ['directorate_id' => $this->current_office_id()])->json();
        $ministries = isSuccess($ministryResponseData) ? $ministryResponseData['data'] : [];

        //criteria
        $criteriaResponseData = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.audit_assessment.criteria.lists'), $data)->json();
        $criteriaList = isSuccess($criteriaResponseData) ? $criteriaResponseData['data'] : [];

        return view('modules.audit_plan.annual.audit_assessment.create', compact('fiscal_years','categories',
            'ministries','criteriaList'));

    }

    public function list(Request $request)
    {
        $data['cdesk'] = $this->current_desk_json();
        $data['fiscal_year_id'] = $request->fiscal_year_id;
        $entities = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_annual_plan.audit_assessment.list'), $data)->json();
        //dd($entities);
        if (isSuccess($entities)) {
            $entities = $entities['data'];
            return view('modules.audit_plan.annual.audit_assessment.partials.load_assessment_list', compact('entities'));
        } else {
            return response()->json(['status' => 'error', 'data' => $entities]);
        }
    }

    public function store(Request $request)
    {
        $data['cdesk'] = $this->current_desk_json();
        $data['category_id'] = $request->category_id;
        $data['fiscal_year_id'] = $request->fiscal_year_id;
        $data['ministry_id'] = $request->ministry_id;
        $data['ministry_name_en'] = $request->ministry_name_en;
        $data['ministry_name_bn'] = $request->ministry_name_bn;
        $data['entity_id'] = $request->entity_id;
        $data['entity_name_en'] = $request->entity_name_en;
        $data['entity_name_bn'] = $request->entity_name_bn;

        $data['criteria_ids'] = $request->criteria_ids;
        $data['weights'] = $request->weights;
        $data['values'] = $request->values;
        $data['scores'] = $request->scores;

        $responseData = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_annual_plan.audit_assessment.store'), $data)->json();

        //dd($responseData);

        if ($responseData['status'] == 'success') {
            $responseData = $responseData['data'];
            return response()->json(['status' => 'success', 'data' => $responseData]);
        } else {
            return response()->json(['status' => 'error', 'data' => $responseData]);
        }
    }
}
