<?php

namespace App\Http\Controllers\AuditPlan\Plan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RevisedPlanController extends Controller
{
    public function index()
    {
        $fiscal_years = $this->allFiscalYears();
        return view('modules.audit_plan.audit_plan.plan_revised.audit_plan', compact('fiscal_years'));
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function showAuditablePlanLists(Request $request)
    {
        $data = Validator::make($request->all(), [
            'fiscal_year_id' => 'required|integer',
            'per_page' => 'required|integer',
            'page' => 'required|integer',
        ])->validate();
        $data['cdesk'] = json_encode($this->current_desk());
        $all_entities = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_entity_plan.ap_entity_lists'), $data)->json();
        if (isSuccess($all_entities)) {
            $all_entities = $all_entities['data'];
            return view('modules.audit_plan.audit_plan.plan_revised.plan_lists', compact('all_entities'));
        } else {
            return response()->json(['status' => 'error', 'data' => $all_entities]);
        }
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function createAuditPlan(Request $request)
    {
        $data = Validator::make($request->all(), [
            'activity_id' => 'required|integer',
            'annual_plan_id' => 'required|integer',
            'fiscal_year_id' => 'required|integer',
        ])->validate();

        $data['cdesk'] = json_encode($this->current_desk());

        $audit_plan = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_entity_plan.ap_entity_plan_create_draft'), $data)->json();

        $parent_office_data = $this->initRPUHttp()->post(config('cag_rpu_api.get-office-other-info'), ['office_id' => 20307])->json();

        $parent_office_data = isSuccess($parent_office_data) ? $parent_office_data['data'] : [];
        $parent_office_content = is_array($parent_office_data) ? json_encode($parent_office_data['content_list']) : '';
        $activity_id = $request->activity_id;
        $annual_plan_id = $request->annual_plan_id;
        if (isSuccess($audit_plan)) {
            $audit_plan = $audit_plan['data'];
            $content = $audit_plan['plan_description'];
            $cover_info = [
                'directorate_name' => $this->current_office()['office_name_bn'],
                'party_name' => $audit_plan['annual_plan']['controlling_office_bn'],
                'fiscal_year' => enTobn($audit_plan['annual_plan']['fiscal_year']['start']) . ' - ' . enTobn($audit_plan['annual_plan']['fiscal_year']['end']),
            ];
            return view('modules.audit_plan.audit_plan.plan_revised.create_entity_audit_plan', compact('activity_id', 'annual_plan_id', 'audit_plan', 'content', 'cover_info', 'parent_office_content'));
        } else {
            return ['status' => 'error', 'data' => $audit_plan];
        }
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateAuditPlan(Request $request)
    {
        $data = Validator::make($request->all(), [
            'audit_plan_id' => 'required|integer',
            'fiscal_year_id' => 'required|integer',
            'annual_plan_id' => 'required|integer',
        ])->validate();

        $data['cdesk'] = json_encode($this->current_desk());

        $audit_plan = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_entity_plan.ap_entity_plan_edit_draft'), $data)->json();

        if (isSuccess($audit_plan)) {
            $audit_plan = $audit_plan['data'];
            $content = json_decode(getDecryptedData($audit_plan['plan_description']));
            $activity_id = $audit_plan['activity_id'];
            $annual_plan_id = $audit_plan['annual_plan_id'];
            return view('modules.audit_plan.audit_plan.plan_revised.edit_entity_audit_plan', compact('activity_id', 'annual_plan_id', 'audit_plan', 'content'));
        } else {
            return ['status' => 'error', 'data' => $audit_plan];
        }
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function showDraftEntityAuditPlanBook(Request $request)
    {
        Validator::make($request->all(), [
            'party_id' => 'required|integer',
            'yearly_plan_rp_id' => 'required|integer',
        ])->validate();
        $data = [
            'party_id' => $request->party_id,
            'yearly_plan_rp_id' => $request->yearly_plan_rp_id,
            'cdesk' => json_encode($this->current_desk()),
            'lang' => 'en',
        ];

        return $this->initHttpWithToken()->post(config('amms_bee_routes.audit_entity_plan.ap_entity_plan_draft_show'), $data)->json();
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function saveDraftEntityAuditPlan(Request $request): \Illuminate\Http\JsonResponse
    {
        Validator::make($request->all(), [
            'activity_id' => 'required|integer',
            'annual_plan_id' => 'required|integer',
            'audit_plan_id' => 'sometimes|integer',
            'plan_description' => 'required',
        ])->validate();

        if ($request->has('audit_plan_id') && $request->audit_plan_id > 0) {
            $data['audit_plan_id'] = $request->audit_plan_id;
        }
        $data['activity_id'] = $request->activity_id;
        $data['annual_plan_id'] = $request->annual_plan_id;
        $data['plan_description'] = makeEncryptedData(json_encode($request->plan_description));
        $data['cdesk'] = json_encode($this->current_desk());
        $save_draft = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_entity_plan.ap_entity_plan_make_draft'), $data)->json();
        if (isSuccess($save_draft)) {
            return response()->json(['status' => 'success', 'data' => 'Successfully Saved']);
        } else {
            return response()->json(['status' => 'error', 'data' => $save_draft]);
        }
    }

    public function printAuditPlan(Request $request)
    {
        $plans = $request->plan;
        $cover = $plans[0];
        array_shift($plans);
        $index = $plans[0];
        array_shift($plans);
        return view('modules.audit_plan.audit_plan.plan_revised.partials.audit_plan_book_print', compact('plans', 'cover', 'index'));
    }

    public function generatePlanPDF(Request $request)
    {
        $plans = $request->plan;
        $cover = $plans[0];
        array_shift($plans);
        $pdf = \PDF::loadView('modules.audit_plan.audit_plan.plan_revised.partials.audit_plan_book', compact('plans', 'cover'));
        return $pdf->stream('document.pdf');
    }
}
