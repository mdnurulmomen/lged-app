<?php

namespace App\Http\Controllers\AuditPlan\AuditAnnualPlan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AnnualPlanRevisedController extends Controller
{
    public function index()
    {
        $fiscal_years = $this->allFiscalYears();
        return view('modules.audit_plan.annual.annual_plan_revised.annual_plan_lists', compact('fiscal_years'));
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

        $annual_plans = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_annual_plan_revised.ap_yearly_plan_lists'), $data)->json();
        $fiscal_year_id = $request->fiscal_year_id;
        $fiscal_year = $request->fiscal_year;

        if (isSuccess($annual_plans)) {
            $annual_plans = $annual_plans['data'];
            return view('modules.audit_plan.annual.annual_plan_revised.partials.load_annual_plan_lists', compact('annual_plans', 'fiscal_year_id', 'fiscal_year'));
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
            'fiscal_year_id' => 'required|integer',
        ])->validate();
        $data['cdesk'] = json_encode($this->current_desk());

        $planListResponseData = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_annual_plan_revised.ap_yearly_plan_list_show'),
            $data)->json();
        if (isSuccess($planListResponseData)) {
            $plan_list = $planListResponseData['data'];
        }

        $activity_id = $request->activity_id;
        $schedule_id = $request->schedule_id;
        $milestone_id = $request->milestone_id;
        $fiscal_year = $request->fiscal_year;
        $fiscal_year_id = $request->fiscal_year_id;
        $activity_title = $request->activity_title;

        return view('modules.audit_plan.annual.annual_plan_revised.show_annual_entity_selection',
            compact('plan_list', 'activity_id', 'schedule_id', 'milestone_id', 'fiscal_year',
                'fiscal_year_id', 'activity_title'));

    }

    public function showStaffAssignList(Request $request)
    {
        //dd($this->current_office_id());
        $responseData = $this->initDoptorHttp()
            ->post(config('cag_doptor_api.office_and_grade_wise_designation'),
                [
                    'office_ids' => $this->current_office_id(),
                    'grade_id' => 12,
                ])->json();

        //dd($responseData);

        if (isSuccess($responseData)) {
            $data['designations'] = $responseData['data']['designations'];
            $data['count'] = $request->count;
        } else {
            $data['designations'] = [];
            $data['count'] = $request->count;
        }

        return view('modules.audit_plan.annual.annual_plan_revised.partials.load_staff_assign_area', $data);
    }


    public function addAnnualPlanInfo(Request $request)
    {
        $data = Validator::make($request->all(), [
            'activity_id' => 'required|integer',
            'schedule_id' => 'required|integer',
            'milestone_id' => 'required|integer',
            'fiscal_year_id' => 'required|integer',
        ])->validate();

        return view('modules.audit_plan.annual.annual_plan_revised.create_annual_plan_info')->with($data);
    }

    public function storeAnnualPlanInfo(Request $request)
    {
        try {
            //dd($request->all());
            Validator::make($request->all(), [
                'activity_id' => 'required|integer',
                'schedule_id' => 'required|integer',
                'milestone_id' => 'required|integer',
                'fiscal_year_id' => 'required|integer',
                'ministry_info' => 'required',
                'controlling_office' => 'required',
                'parent_office' => 'required',
                'selected_entity' => 'required',
                'subject_matter' => 'required|string',
                'total_unit_no' => 'required|string',
                'staff_comment' => 'sometimes',
                'staff_info' => 'sometimes',
                'budget' => 'nullable|string',
                'comment' => 'required|string',
            ])->validate();

            $data = [
                'cdesk' => json_encode($this->current_desk()),
                'activity_id' => $request->activity_id,
                'schedule_id' => $request->schedule_id,
                'fiscal_year_id' => $request->fiscal_year_id,
                'milestone_id' => $request->milestone_id,
                'subject_matter' => $request->subject_matter,
                'total_unit_no' => $request->total_unit_no,
                'comment' => $request->comment,
                'budget' => $request->budget,
            ];

            $ministry_info = [];
            $controlling_office = [];
            $parent_office = [];
            $parent_entities = [];
            $controlling_entities = [];
            $ministry_entities = [];
            $nominated_offices = [];

            foreach ($request->ministry_info as $ministry_info_data) {
                $ministry_info_data = json2Array($ministry_info_data);
                $ministry_entities[] = $ministry_info_data['entity_id'];
                $ministry_info_data['entity_ids'] = $ministry_entities;
                $ministry_info[$ministry_info_data['ministry_id']] = $ministry_info_data;
            }

            foreach ($request->controlling_office as $controlling_office_data) {
                $controlling_office_data = json2Array($controlling_office_data);
                $controlling_entities[] = $controlling_office_data['entity_id'];
                $controlling_office_data['entity_ids'] = $controlling_entities;
                $controlling_office_data['office_type'] = 'budgetary';
                $controlling_office[$controlling_office_data['controlling_office_id']] = $controlling_office_data;
            }

            foreach ($request->parent_office as $parent_office_data) {
                $parent_office_data = json2Array($parent_office_data);
                $parent_entities[] = $parent_office_data['entity_id'];
                $parent_office_data['entity_ids'] = $parent_entities;
                $parent_office_data['office_type'] = 'budgetary';
                $parent_office[$parent_office_data['parent_office_id']] = $parent_office_data;
            }

            foreach ($request->selected_entity as $nominated_office) {
                $nominated_office = json2Array($nominated_office);
                $nominated_offices[$nominated_office['office_id']] = $nominated_office;
            }


            $staff_infos = $request->staff_info;
            $staffs = [];
            $total_man_power = 0;
            if (is_array($staff_infos)) {
                foreach ($staff_infos as $staff_info) {
                    //dump($staff_info);
                    $staff_info_arr = explode('_', $staff_info);
                    $designation = $staff_info_arr[0];
                    $responsibility = $staff_info_arr[1];
                    $staff = $staff_info_arr[2];
                    $total_man_power = $total_man_power + $staff;
                    $staffs[] = [
                        "staff" => $staff,
                        "designation_en" => explode('|', $designation)[0],
                        "designation_bn" => explode('|', $designation)[1],
                        "responsibility_en" => explode('|', $responsibility)[0],
                        "responsibility_bn" => explode('|', $responsibility)[1],
                    ];
                }
            }

            $nominated_man_powers = [
                'comment' => $request->staff_comment ?? '',
                'nominated_man_power_counts' => $total_man_power,
                'staffs' => $staffs,
            ];

            $data['ministry_info'] = json_encode($ministry_info);
            $data['controlling_office'] = json_encode($controlling_office);
            $data['parent_office'] = json_encode($parent_office);
            $data['nominated_offices'] = json_encode($nominated_offices);
            $data['nominated_man_powers'] = json_encode($nominated_man_powers);
            $data['nominated_man_power_counts'] = $total_man_power;

            $store_plan = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_annual_plan_revised.ap_yearly_plan_submission'), $data)->json();
            //dd($store_plan);
            if (isSuccess($store_plan)) {
                return response()->json(['status' => 'success', 'data' => 'Added!']);
            } else {
                return response()->json(['status' => 'error', 'data' => $store_plan]);
            }
        } catch (ValidationException $exception) {
            return response()->json([
                'status' => 'error',
                'msg' => $exception->errors(),
                'statusCode' => '422',
            ]);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'data' => $exception->getMessage()]);
        }

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
        $data['cdesk'] = json_encode($this->current_desk());

        $entities = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_annual_plan_revised.ap_yearly_plan_selected_rp_lists'), $data)->json();
        if (isSuccess($entities)) {
            $entities = $entities['data'];
            $party_ids = [];
            foreach ($entities as $entity) {
                $party_ids[] = $entity['party_id'];
            }
            $party_ids = $party_ids ? json_encode($party_ids) : json_encode([]);
            return view('modules.audit_plan.annual.annual_plan_revised.partials.load_selected_auditee_entities', compact('entities', 'party_ids'));
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
        $data['cdesk'] = json_encode($this->current_desk());
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
        $data['selected_entities'] = json_encode($selected_entities_data, true);
        unset($data['selected_entity']);

        $entities = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_annual_plan_revised.ap_yearly_plan_selected_rp_store'), $data)->json();
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

        return view('modules.audit_plan.annual.annual_plan_revised.partials.load_annual_plan_submission_hr_modal', compact('officer_lists', 'plan_responsible_party_id'));
    }

    public function exportAnnualPlanBook(Request $request)
    {
        $data = Validator::make($request->all(), [
            'fiscal_year_id' => 'required|integer',
        ])->validate();
        $data['cdesk'] = json_encode($this->current_desk());

        $plan_infos = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_annual_plan_revised.ap_yearly_plan_book'), $data)->json();

        if (isSuccess($plan_infos)) {
            $plan_infos = $plan_infos['data'];
            $pdf = \PDF::loadView('modules.audit_plan.annual.annual_plan_revised.partials.annual_plan_book', ['plan_infos' => $plan_infos], [], ['orientation' => 'L', 'format' => 'A4']);

            return $pdf->stream('annual_plan.pdf');
        } else {
            return response()->json(['status' => 'error', 'data' => $plan_infos]);
        }
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
            'designations' => json_encode($designations),
            'cdesk' => json_encode($this->current_desk()),
        ];

        $assign = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_annual_plan_revised.ap_yearly_plan_submission'), $data)->json();

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
        //dd($rp_offices);
        if (isSuccess($rp_offices)) {
            $rp_offices = $rp_offices['data'];
            return view('modules.audit_plan.annual.annual_plan_revised.partials.load_rp_auditee_offices', compact('rp_offices', 'ministry'));
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

        $data['cdesk'] = json_encode($this->current_desk());

        $submit_plan = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_annual_plan_revised.ap_submit_plan_to_ocag'), $data)->json();

        if (isSuccess($submit_plan)) {
            return response()->json(['status' => 'success', 'data' => 'Submission Successful!']);
        } else {
            return response()->json(['status' => 'error', 'data' => $submit_plan]);
        }
    }


}
