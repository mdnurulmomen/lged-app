<?php

namespace App\Http\Controllers\Setting\XAuditAssessment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CriteriaController extends Controller
{
    public function index()
    {
        $strategic_durations = $this->allStrategicPlanDurations();
        return view('modules.settings.x_audit_assessment.criteria.index', compact('strategic_durations'));
    }

    public function create()
    {
        //categories
        $categoryResponseData = $this->initRPUHttp()->post(config('cag_rpu_api.get-office-category-types'), [])->json();
        $categories = isSuccess($categoryResponseData) ? $categoryResponseData['data'] : [];
        return view('modules.settings.x_audit_assessment.criteria.create', compact('categories'));
    }

    public function list(Request $request)
    {
        $criteriaList = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.audit_assessment.criteria.lists'), [
            'all' => 1
        ])->json();

        if ($criteriaList['status'] == 'success') {
            $criteriaList = $criteriaList['data'];
            return view('modules.settings.x_audit_assessment.criteria.partials.load_criteria_list', compact('criteriaList'));
        } else {
            return response()->json(['status' => 'error', 'data' => $criteriaList]);
        }
    }

    public function store(Request $request)
    {
        $data = [
            'category_id' => $request->category_id,
            'category_title_en' => $request->category_title_en,
            'category_title_bn' => $request->category_title_bn,
            'name_en' => $request->name_en,
            'name_bn' => $request->name_bn,
            'weight' => $request->weight,
        ];
        $responseData = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.audit_assessment.criteria.create'), $data)->json();

        //dd($responseData);
        if ($responseData['status'] == 'success') {
            return response()->json(responseFormat('success', 'Created Successfully'));
        } else {
            return response()->json(['status' => 'error', 'data' => $responseData]);
        }
    }

    public function update(Request $request)
    {
        $data = [
            'fiscal_year_id' => $request->fiscal_year_id,
            'duration_id' => $request->duration_id,
            'start_year' => $request->start_year,
            'end_year' => $request->end_year,
            'description' => $request->description,
        ];
        $create_fiscal_year = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.fiscal_year_update'), $data)->json();

        if (isset($create_fiscal_year['status']) && $create_fiscal_year['status'] == 'success') {
            return response()->json(responseFormat('success', 'Updated Successfully'));
        } else {
            return response()->json(['status' => 'error', 'data' => $create_fiscal_year]);
        }
    }

    public function destroy($fiscal_year_id)
    {
        $data = [
            'fiscal_year_id' => $fiscal_year_id,
        ];
        $create_fiscal_year = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.fiscal_year_delete'), $data)->json();

        if (isset($create_fiscal_year['status']) && $create_fiscal_year['status'] == 'success') {
            return response()->json(responseFormat('success', 'Updated Successfully'));
        } else {
            return response()->json(['status' => 'error', 'data' => $create_fiscal_year]);
        }
    }
}
