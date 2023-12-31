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
        $data['cdesk'] = $this->current_desk_json();

        $annual_plans = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_annual_plan.ap_yearly_plan_lists'), $data)->json();
        $fiscal_year_id = $request->fiscal_year_id;

        if (isSuccess($annual_plans)) {
            $annual_plans = $annual_plans['data'];
            return view('modules.audit_plan.annual.annual_plan.partials.load_annual_plan_lists', compact('annual_plans', 'fiscal_year_id'));
        } else {
            return response()->json(['status' => 'error', 'data' => $annual_plans]);
        }

    }


    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function showEntitySelection(Request $request)
    {
        $data = Validator::make($request->all(), [
            'activity_id' => 'required|integer',
            'schedule_id' => 'required|integer',
            'milestone_id' => 'required|integer',
        ])->validate();
        $data['cdesk'] = $this->current_desk_json();

        $activity_id = $request->activity_id;
        $schedule_id = $request->schedule_id;
        $milestone_id = $request->milestone_id;

        return view('modules.audit_plan.annual.annual_plan.show_annual_entity_selection', compact('activity_id', 'schedule_id', 'milestone_id'));

    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function showSelectedAuditeeEntities(Request $request)
    {
        $data = Validator::make($request->all(), [
            'activity_id' => 'required|integer',
            'schedule_id' => 'required|integer',
            'milestone_id' => 'required|integer',
        ])->validate();
        $data['cdesk'] = $this->current_desk_json();

        $entities = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_annual_plan.ap_yearly_plan_selected_rp_lists'), $data)->json();
        if (isSuccess($entities)) {
            $entities = $entities['data'];
            $party_ids = [];
            foreach ($entities as $entity) {
                $party_ids[] = $entity['party_id'];
            }
            $party_ids = $party_ids ? json_encode($party_ids) : json_encode([]);
            return view('modules.audit_plan.annual.annual_plan.partials.load_selected_auditee_entities', compact('entities', 'party_ids'));
        } else {
            return response()->json(['status' => 'error', 'data' => $entities]);
        }
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function storeSelectedAuditeeEntities(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = Validator::make($request->all(), [
            'activity_id' => 'required|integer',
            'schedule_id' => 'required|integer',
            'milestone_id' => 'required|integer',
            'selected_entity' => 'required',
        ])->validate();
        $data['cdesk'] = $this->current_desk_json();
        $selected_entities_data = [];
        $selected_entities = $request->selected_entity;
        foreach ($selected_entities as $selected_entity) {
            $selected_entity = json_decode($selected_entity, true);
            $selected_entities_data[] = [
                "party_id" => $selected_entity['entity_id'],
                "party_name_en" => $selected_entity['entity_name_en'],
                "party_name_bn" => $selected_entity['entity_name_bn'],
                "ministry_id" => $selected_entity['ministry_id'],
                "ministry_name_en" => $selected_entity['ministry_name_en'],
                "ministry_name_bn" => $selected_entity['ministry_name_bn'],
            ];
        }
        $data['selected_entities'] = json_encode($selected_entities_data, JSON_UNESCAPED_UNICODE);
        unset($data['selected_entity']);

        $entities = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_annual_plan.ap_yearly_plan_selected_rp_store'), $data)->json();
        if (isSuccess($entities)) {
            return response()->json(['status' => 'success', 'data' => 'Added!']);
        } else {
            return response()->json(['status' => 'error', 'data' => $entities]);
        }
    }

    public function showAnnualSubmissionHRModal(Request $request)
    {
        $plan_responsible_party_id = $request->plan_responsible_party_id;
        $officer_lists = $this->cagDoptorOfficeUnitDesignationEmployees($this->current_office_id());

        return view('modules.audit_plan.annual.annual_plan.partials.load_annual_plan_submission_hr_modal', compact('officer_lists', 'plan_responsible_party_id'));
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function storeAnnualSubmissionHR(Request $request): \Illuminate\Http\JsonResponse
    {
        Validator::make($request->all(), [
            'activity_id' => 'required|integer',
            'schedule_id' => 'required|integer',
            'milestone_id' => 'required|integer',
            'plan_responsible_party_id' => 'required|integer',
            'budget' => 'required|integer',
            'designation_to_assign' => 'required',
            'designation_role' => 'required',
            'start' => 'required|date',
            'end' => 'required|date',
        ])->validate();

        $designation_lists = $request->designation_to_assign;
        $designation_roles = $request->designation_role;

        $designations = [];

        foreach ($designation_lists as $designation_list) {
            foreach ($designation_roles as $designations_role) {
                $designation = explode('_', $designations_role);
                $designation_list_decoded = json_decode($designation_list, true);
                if ($designation[1] == $designation_list_decoded['designation_id']) {
                    $designations[] = [
                        'designation_id' => $designation_list_decoded['designation_id'],
                        'designation_en' => $designation_list_decoded['designation_en'],
                        'designation_bn' => $designation_list_decoded['designation_bn'],

                        'officer_id' => $designation_list_decoded['officer_id'],
                        'officer_grade' => $designation_list_decoded['employee_grade'],
                        'officer_name_en' => $designation_list_decoded['officer_name_en'],
                        'officer_name_bn' => $designation_list_decoded['officer_name_bn'],

                        'unit_id' => $designation_list_decoded['unit_id'],
                        'unit_name_en' => $designation_list_decoded['unit_name_en'],
                        'unit_name_bn' => $designation_list_decoded['unit_name_bn'],
                        'office_id' => $designation_list_decoded['office_id'],
                        'officer_category' => $designation[0],
                    ];
                }
            }
        }

        $data = [
            'schedule_id' => $request->schedule_id,
            'activity_id' => $request->activity_id,
            'milestone_id' => $request->milestone_id,
            'start_date' => $request->start,
            'end_date' => $request->end,
            'budget' => $request->budget,
            'plan_responsible_party_id' => $request->plan_responsible_party_id,
            'designations' => json_encode($designations, JSON_UNESCAPED_UNICODE),
            'cdesk' => $this->current_desk_json(),
        ];

        $assign = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_annual_plan.ap_yearly_plan_submission'), $data)->json();

        if (isSuccess($assign)) {
            return response()->json(['status' => 'success', 'data' => 'Submission Successful!']);
        } else {
            return response()->json(['status' => 'error', 'data' => $assign]);
        }
    }

    public function showRPAuditeeOffices(Request $request)
    {
        $ministry_id = $request->ministry_id;
        $layer_id = $request->layer_id;
        $ministry = [
            'id' => $request->ministry_id,
            'name_en' => $request->ministry_name_en,
            'name_bn' => $request->ministry_name_bn,
        ];
        $data = [
            'office_ministry_id' => $ministry_id,
            'office_layer_id' => $layer_id,
        ];
        $rp_offices = $this->initRPUHttp()->post(config('cag_rpu_api.get-rp-office-ministry-and-layer-wise'), $data)->json();
        if (isSuccess($rp_offices)) {
            $rp_offices = $rp_offices['data'];
            return view('modules.audit_plan.annual.annual_plan.partials.load_rp_auditee_offices', compact('rp_offices', 'ministry'));
        } else {
            return response()->json(['status' => 'error', 'data' => $rp_offices]);
        }
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function submitPlanToOCAG(Request $request)
    {
        $data = Validator::make($request->all(), [
            'fiscal_year_id' => 'required|integer',
        ])->validate();

        $data['cdesk'] = $this->current_desk_json();

        $submit_plan = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_annual_plan.ap_submit_plan_to_ocag'), $data)->json();

        if (isSuccess($submit_plan)) {
            return response()->json(['status' => 'success', 'data' => 'Submission Successful!']);
        } else {
            return response()->json(['status' => 'error', 'data' => $submit_plan]);
        }
    }


}
