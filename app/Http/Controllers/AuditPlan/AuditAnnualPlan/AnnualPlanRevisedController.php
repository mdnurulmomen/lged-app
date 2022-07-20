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
        $all_directorates = $this->allAuditDirectorates();
        $self_directorate = current(array_filter($all_directorates, function ($item) {
            return $this->current_office_id() == $item['office_id'];
        }));
        $directorates = $self_directorate ? [$self_directorate] : $all_directorates;

        $fiscal_years = $this->allFiscalYears();
        return view('modules.audit_plan.annual.annual_plan_revised.annual_plan_lists', compact('directorates','fiscal_years'));
    }

    public function annualPlanCalender()
    {
        $fiscal_years = $this->allFiscalYears();
        return view('modules.audit_plan.annual.annual_plan_revised.partials.annual_plan_calender', compact('fiscal_years'));
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

        $annual_plans = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_annual_plan_revised.ap_yearly_plan_lists'), $data)->json();
        $fiscal_year_id = $request->fiscal_year_id;
        $fiscal_year = $request->fiscal_year;

        //        dd($annual_plans);

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

    public function showAnnualPlanEntities(Request $request)
    {
        $data = Validator::make($request->all(), [
            'office_id' => 'required',
            'fiscal_year_id' => 'required|integer',
            'activity_id' => 'nullable',
            'office_ministry_id' => 'nullable',
        ],[
            'office_id.required' => 'অধিদপ্তর বাছাই করুন',
            'fiscal_year_id.required' => 'অর্থবছর বাছাই করুন',
        ])->validate();

//        dd($data);

        $data['cdesk'] = $this->current_desk_json();
        if (session('dashboard_audit_type') == 'Compliance Audit') {
            $data['activity_type'] = 'compliance';
        } else if (session('dashboard_audit_type') == 'Performance Audit') {
            $data['activity_type'] = 'performance';
            $data['activity_key'] = 'performance';
        } else if (session('dashboard_audit_type')  == 'Financial Audit') {
            $data['activity_type'] = 'financial';
        }

        $current_designation_id = $this->current_designation_id();

        $planListResponseData = $this->initHttpWithToken()->post(
            config('amms_bee_routes.audit_annual_plan_revised.ap_yearly_plan_entities_list_show'),
            $data
        )->json();
//        dd($planListResponseData);

        $plan_list = isSuccess($planListResponseData) ? $planListResponseData['data']['annual_plan_list'] : [];
        //        $approval_status = isSuccess($planListResponseData)?$planListResponseData['data']['approval_status']:[];
        $op_audit_calendar_event_id = isSuccess($planListResponseData) ? $planListResponseData['data']['op_audit_calendar_event_id'] : [];

        $fiscal_year = $request->fiscal_year;
        $fiscal_year_id = $request->fiscal_year_id;
        $current_office_id = $this->current_office_id();

        return view(
            'modules.audit_plan.annual.annual_plan_revised.show_annual_entity_selection',
            compact(
                'plan_list',
                'fiscal_year',
                'fiscal_year_id',
                'op_audit_calendar_event_id',
                'current_designation_id',
                'current_office_id'
            )
        );
    }

    public function showStaffAssignList(Request $request)
    {
        $responseData = $this->initDoptorHttp()
            ->post(
                config('cag_doptor_api.office_and_grade_wise_designation'),
                [
                    'office_ids' => $this->current_office_id(),
                    'grade_id' => 12,
                ]
            )->json();

        //        dd($request->all());

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
            'fiscal_year_id' => 'required|integer',
            'op_audit_calendar_event_id' => 'required|integer',
        ])->validate();

        if (session('dashboard_audit_type') == 'Compliance Audit') {
            $data['activity_type'] = 'compliance';
        } else if (session('dashboard_audit_type') == 'Performance Audit') {
            $data['activity_type'] = 'performance';
            $data['activity_key'] = 'performance';
        } else if (session('dashboard_audit_type')  == 'Financial Audit') {
            $data['activity_type'] = 'financial';
        }

        $all_activity = $this->initHttpWithToken()->post(
            config('amms_bee_routes.audit_operational_plan.get_all_op_activity'),
            $data
        )->json();

        $office_id = $this->current_office_id();

        $all_project = $office_id == 18 ?  $this->initRPUHttp()->post(config('cag_rpu_api.get-all-project'), $data)->json() : [];
        $all_project = $all_project ? $all_project['data'] : [];

        //        dd($all_project);

        $fiscal_year_id = $request->fiscal_year_id;
        $op_audit_calendar_event_id = $request->op_audit_calendar_event_id;
        $annual_plan_main_id = $request->annual_plan_main_id;

        if (isSuccess($all_activity)) {
            $all_activity = $all_activity['data'];
            return view('modules.audit_plan.annual.annual_plan_revised.create_annual_plan_info', compact('all_activity', 'fiscal_year_id', 'op_audit_calendar_event_id', 'annual_plan_main_id', 'all_project', 'office_id'));
        } else {
            return response()->json(['status' => 'error', 'data' => $all_activity]);
        }
    }

    public function fiscalYearWiseActivitySelect(Request $request)
    {
        $data = Validator::make($request->all(), [
            'fiscal_year_id' => 'required|integer',
        ])->validate();

        //        dd($data);

        if (session('dashboard_audit_type') == 'Compliance Audit') {
            $data['activity_type'] = 'compliance';
        } else if (session('dashboard_audit_type') == 'Performance Audit') {
            $data['activity_type'] = 'performance';
            $data['activity_key'] = 'performance';
        } else if (session('dashboard_audit_type')  == 'Financial Audit') {
            $data['activity_type'] = 'financial';
        }

        $all_activity = $this->initHttpWithToken()->post(
            config('amms_bee_routes.audit_operational_plan.get_all_op_activity'),
            $data
        )->json();

        if (isSuccess($all_activity)) {
            $all_activity = $all_activity['data'];
            return view('modules.audit_plan.operational.audit_activity.activity_select', compact('all_activity'));
        } else {
            return response()->json(['status' => 'error', 'data' => $all_activity]);
        }
    }

    public function activityWiseMilestoneSelect(Request $request)
    {
        $data = Validator::make($request->all(), [
            'activity_id' => 'required|integer',
        ])->validate();

        $all_milestone = $this->initHttpWithToken()->post(
            config('amms_bee_routes.audit_operational_plan.op_activity_milestones_load'),
            $data
        )->json();

        //        dd($all_milestone);

        if (isSuccess($all_milestone)) {
            $all_milestone = $all_milestone['data'];
            return view('modules.audit_plan.annual.annual_plan_revised.milestone_select', compact('all_milestone'));
        } else {
            return response()->json(['status' => 'error', 'data' => $all_milestone]);
        }
    }

    public function storeAnnualPlanInfo(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            Validator::make($request->all(), [
                'op_audit_calendar_event_id' => 'required',
                'activity_id' => 'required|integer',
                'fiscal_year_id' => 'required|integer',
                'office_type' => 'nullable',
                'office_type_en' => 'nullable',
                'office_type_id' => 'nullable',
                'subject_matter' => 'required|string',
                'total_unit_no' => 'required|string',
                'staff_comment' => 'nullable',
                'staff_info' => 'nullable',
                'budget' => 'nullable|string',
            ], [
                'activity_id.required' => 'অ্যাক্টিভিটি অ্যাক্টিভিটি বাছাই করুন',
                'subject_matter.required' => 'সাবজেক্ট ম্যাটার আবশ্যক',
                'total_unit_no.required' => 'প্রতিষ্ঠানের মোট ইউনিট সংখ্যা আবশ্যক',
            ])->validate();

            $data = [
                'id' => $request->id,
                'cdesk' => $this->current_desk_json(),
                'entity_list' => json_decode($request->entity_list, true),
                'activity_id' => $request->activity_id,
                'annual_plan_main_id' => $request->annual_plan_main_id,
                'audit_calendar_event_id' => $request->op_audit_calendar_event_id,
                'fiscal_year_id' => $request->fiscal_year_id,
                'subject_matter' => $request->subject_matter,
                'sub_subject_list' => json_decode($request->sub_subject_list, true),
                'vumika' => $request->vumika,
                'audit_objective' => $request->audit_objective,
                'sub_objective_list' => json_decode($request->sub_objective_list, true),
                'audit_approach' => $request->audit_approach,
                'office_type' => $request->office_type,
                'office_type_en' => $request->office_type_en,
                'office_type_id' => $request->office_type_id,
                'total_unit_no' => $request->total_unit_no,
                'total_selected_unit_no' => $request->total_selected_unit_no ? $request->total_selected_unit_no : 0,
                'comment' => $request->comment,
                'budget' => $request->budget ? $request->budget : 0,
                'cost_center_total_budget' => $request->cost_center_total_budget ? $request->cost_center_total_budget : 0,
                'total_expenditure' => $request->total_expenditure ? $request->total_expenditure : 0,
                'milestone_list' => json_decode($request->milestone_list, true),
                'annual_plan_type' => $request->annual_plan_type,
                'thematic_title' => $request->thematic_title,
                'project_id' => $request->project_id,
                'project_name_bn' => $request->project_name_bn,
                'project_name_en' => $request->project_name_en,
            ];

            //            dd($data);

            if (session('dashboard_audit_type') == 'Compliance Audit') {
                $data['activity_type'] = 'compliance';
            } else if (session('dashboard_audit_type') == 'Performance Audit') {
                $data['activity_type'] = 'performance';
                $data['activity_key'] = 'performance';
            } else if (session('dashboard_audit_type')  == 'Financial Audit') {
                $data['activity_type'] = 'financial';
            }

            $staff_infos = $request->staff_info;
            //
            $staffs = [];
            $total_man_power = 0;
            if (is_array($staff_infos)) {
                foreach ($staff_infos as $staff_info) {
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

            $data['nominated_man_powers'] = json_encode($nominated_man_powers, JSON_UNESCAPED_UNICODE);
            $data['nominated_man_power_counts'] = $total_man_power;

//            dd($staffs);


            if ($request->id) {
                $store_plan = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_annual_plan_revised.ap_yearly_plan_update'), $data)->json();
            } else {
                $store_plan = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_annual_plan_revised.ap_yearly_plan_submission'), $data)->json();
                //                dd($store_plan);
            }
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

    public function editAnnualPlanInfo(Request $request)
    {
        $data = Validator::make($request->all(), [
            'annual_plan_id' => 'required|integer',
            'fiscal_year_id' => 'required|integer',
            'op_audit_calendar_event_id' => 'required|integer',
        ])->validate();

        $data['cdesk'] = $this->current_desk_json();

        $annual_plan_info = $this->initHttpWithToken()->post(
            config('amms_bee_routes.audit_annual_plan_revised.get_annual_plan_info'),
            $data
        )->json();

        //        dd($annual_plan_info);

        if (session('dashboard_audit_type') == 'Compliance Audit') {
            $data['activity_type'] = 'compliance';
        } else if (session('dashboard_audit_type') == 'Performance Audit') {
            $data['activity_type'] = 'performance';
            $data['activity_key'] = 'performance';
        }

        $all_activity = $this->initHttpWithToken()->post(
            config('amms_bee_routes.audit_operational_plan.get_all_op_activity'),
            $data
        )->json();

        $master_designation = $this->initDoptorHttp()
            ->post(
                config('cag_doptor_api.office_and_grade_wise_designation'),
                [
                    'office_ids' => $this->current_office_id(),
                    'grade_id' => 12,
                ]
            )->json();

        $fiscal_year_id = $request->fiscal_year_id;
        $op_audit_calendar_event_id = $request->op_audit_calendar_event_id;

        if (isSuccess($all_activity)) {
            $all_activity = $all_activity['data'];
            $annual_plan_info = $annual_plan_info['data'];
            $designations = $master_designation['data']['designations'];
            $nominated_man_powers = json_decode($annual_plan_info['nominated_man_powers'], true);
            //            dd($nominated_man_powers);
            $staff_list = $nominated_man_powers['staffs'];
            $staff_comment = $nominated_man_powers['comment'];
//            dd($staff_list);
            return view(
                'modules.audit_plan.annual.annual_plan_revised.edit_annual_plan_info',
                compact(
                    'annual_plan_info',
                    'all_activity',
                    'fiscal_year_id',
                    'op_audit_calendar_event_id',
                    'staff_list',
                    'designations',
                    'staff_comment',
                )
            );
        } else {
            return response()->json(['status' => 'error', 'data' => $all_activity]);
        }
    }

    public function showAnnualPlanInfo(Request $request)
    {
        $data = Validator::make($request->all(), [
            'annual_plan_id' => 'required|integer',
            'office_id' => 'required|integer',
        ])->validate();

        $data['cdesk'] = $this->current_desk_json();

        $annual_plan_info = $this->initHttpWithToken()->post(
            config('amms_bee_routes.audit_annual_plan_revised.get_annual_plan_info'),
            $data
        )->json();


        if (isSuccess($annual_plan_info)) {
            $annual_plan_info = $annual_plan_info['data'];
            if (session('dashboard_audit_type') == 'Performance Audit') {
                $annual_plan_subject_matter_info = $this->initHttpWithToken()->post(
                    config('amms_bee_routes.audit_annual_plan_revised.get_annual_plan_subject_matter_info'),
                    $data
                )->json();
                $annual_plan_subject_matter_info = $annual_plan_subject_matter_info['data'];
            } else {
                $annual_plan_subject_matter_info = [];
            }

            $nominated_man_powers = json_decode($annual_plan_info['nominated_man_powers'], true);

            return view(
                'modules.audit_plan.annual.annual_plan_revised.show_annual_plan_info',
                compact('annual_plan_info', 'nominated_man_powers', 'annual_plan_subject_matter_info')
            );
        } else {
            return response()->json(['status' => 'error', 'data' => $annual_plan_info]);
        }
        //        dd($annual_plan_info);
    }

    public function deleteAnnualPlan(Request $request)
    {
        $data = Validator::make($request->all(), [
            'annual_plan_id' => 'required|integer',
        ])->validate();

        $data['cdesk'] = $this->current_desk_json();

        $delete_annual_plan = $this->initHttpWithToken()->post(
            config('amms_bee_routes.audit_annual_plan_revised.delete_annual_plan'),
            $data
        )->json();

        //        dd($delete_annual_plan);

        if (isSuccess($delete_annual_plan)) {
            return response()->json(['status' => 'success', 'data' => $delete_annual_plan['data']]);
        } else {
            return response()->json(['status' => 'error', 'data' => $delete_annual_plan['message']]);
        }
    }

    public function exportAnnualPlanBook(Request $request)
    {
        $data = Validator::make($request->all(), [
            'fiscal_year_id' => 'required|integer',
            'annual_plan_main_id' => 'required|integer',
            'activity_type' => 'nullable',
        ])->validate();

        $data['cdesk'] = $this->current_desk_json();
        $data['office_id'] = $this->current_office_id();

        $plan_infos = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_annual_plan_revised.ap_yearly_plan_book'), $data)->json();

        if (isSuccess($plan_infos)) {
            $plan_infos = $plan_infos['data'];
            $office_id = $this->current_office_id();
            $pdf = \PDF::loadView('modules.audit_plan.annual.annual_plan_revised.partials.annual_plan_book', ['plan_infos' => $plan_infos,'office_id' => $office_id], [], ['orientation' => 'L', 'format' => 'A4']);
            return $pdf->stream('annual_plan.pdf');
        } else {
            return response()->json(['status' => 'error', 'data' => $plan_infos]);
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
        //        dd($rp_offices);
        if (isSuccess($rp_offices)) {
            $rp_offices = $rp_offices['data'];
            if ($request->has('scope') && $request->scope == 'parent_office') {
                return view('modules.audit_plan.annual.annual_plan_revised.partials.load_rp_auditee_parent_offices', compact('rp_offices', 'ministry'));
            } else {
                return view('modules.audit_plan.annual.annual_plan_revised.partials.load_rp_auditee_offices', compact('rp_offices', 'ministry'));
            }
        } else {
            return response()->json(['status' => 'error', 'data' => $rp_offices]);
        }
    }

    public function showRPAuditeeOfficesMinistryWise(Request $request)
    {
        $ministry_id = $request->ministry_id;
        $office_category_type = $request->office_category_type;
        $ministry = [
            'id' => $request->ministry_id,
            'name_en' => $request->ministry_name_en,
            'name_bn' => $request->ministry_name_bn,
        ];

        $data = [
            'office_ministry_id' => $ministry_id,
            'office_category_type' => $office_category_type,
            'project_id' => $request->project_id,
            'directorate_id' => $this->current_office_id(),
        ];

        //office id 18 fapad
        if ($request->project_id && $this->current_office_id() == 18) {
            $rp_offices = $this->initRPUHttp()->post(config('cag_rpu_api.get-project-wise-entity'), $data)->json();
        } else {
            $rp_offices = $this->initRPUHttp()->post(config('cag_rpu_api.get-rp-office-ministry-wise'), $data)->json();
        }

        //        dd($rp_offices);

        if (isSuccess($rp_offices)) {
            $rp_offices = $rp_offices['data'];
            if ($request->has('scope') && $request->scope == 'parent_office') {
                return view('modules.audit_plan.annual.annual_plan_revised.partials.load_rp_auditee_parent_offices', compact('rp_offices', 'ministry'));
            } else {
                return view('modules.audit_plan.annual.annual_plan_revised.partials.load_rp_auditee_offices', compact('rp_offices', 'ministry'));
            }
        } else {
            return response()->json(['status' => 'error', 'data' => $rp_offices]);
        }
    }

    public function showRPChildAuditeeOffices(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = [
            'parent_office_id' => $request->parent_office_id,
            'parent_ministry_id' => $request->parent_ministry_id,
        ];
        $nominated_offices = $this->initRPUHttp()->post(config('cag_rpu_api.get-parent-wise-child-office'), $data)->json();

        if (isSuccess($nominated_offices)) {
            return response()->json(['status' => 'success', 'data' => $nominated_offices['data']]);
        } else {
            return response()->json(['status' => 'error', 'data' => $nominated_offices]);
        }
    }

    public function loadAssessmentEntity(Request $request)
    {
        $data = [
            'office_ministry_id' => $request->parent_ministry_id,
            'office_category_type' => $request->office_category_type,
            'activity_id' => $request->activity_id,
            'fiscal_year_id' => 1,
            'cdesk' => $this->current_desk_json(),
        ];

        //        dd($data);

        $rp_offices = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_annual_plan.audit_assessment.get_assessment_entity'), $data)->json();
        //        dd($rp_offices);
        if (isSuccess($rp_offices)) {
            $rp_offices = $rp_offices['data'];
            return view('modules.audit_plan.annual.annual_plan_revised.partials.load_assessment_entity', compact('rp_offices'));
        } else {
            return response()->json(['status' => 'error', 'data' => $rp_offices]);
        }
    }

    public function showRPChildAuditeeOfficesList(Request $request)
    {
        $data = [
            'parent_office_id' => $request->parent_office_id,
            'parent_ministry_id' => $request->parent_ministry_id,
            'parent_office_layer_id' => $request->parent_office_layer_id,
            'project_id' => $request->project_id,
        ];
        //        dd($data);
        $office_id = $this->current_office_id();

        //office id 18 fapad
        if ($request->project_id && $office_id == 18) {
            $rp_offices = $this->initRPUHttp()->post(config('cag_rpu_api.get-project-wise-cost-center'), $data)->json();
        } else {
            $rp_offices = $this->initRPUHttp()->post(config('cag_rpu_api.get-ministry-parent-wise-child-office'), $data)->json();
        }

        //        dd($rp_offices);

        if (isSuccess($rp_offices)) {
            $rp_offices = $rp_offices['data'];
            $entity_id = $request->parent_office_id;
            $entity_name_en = $request->parent_office_en;
            $entity_name_bn = $request->parent_office_bn;
            //            dd($rp_offices);
            return view('modules.audit_plan.annual.annual_plan_revised.partials.load_rp_auditee_offices_list', compact('rp_offices', 'entity_id', 'entity_name_en', 'entity_name_bn'));
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

        $submit_plan = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_annual_plan_revised.ap_submit_plan_to_ocag'), $data)->json();

        if (isSuccess($submit_plan)) {
            return response()->json(['status' => 'success', 'data' => 'Submission Successful!']);
        } else {
            return response()->json(['status' => 'error', 'data' => $submit_plan]);
        }
    }

    public function loadAnnualPlanApprovalAuthority(Request $request)
    {
        $data = Validator::make($request->all(), [
            'fiscal_year_id' => 'required|integer',
            'annual_plan_main_id' => 'required|integer',
            'activity_type' => 'required|string',
            'op_audit_calendar_event_id' => 'required|integer',
        ])->validate();

        $officeId = config('cag_amms_config.ocag_office_id');
        $fiscal_year_id = $request->fiscal_year_id;
        $annual_plan_main_id = $request->annual_plan_main_id;
        $activity_type = $request->activity_type;
        $op_audit_calendar_event_id = $request->op_audit_calendar_event_id;
        $officer_lists = $this->cagDoptorOfficeUnitDesignationEmployees($officeId);

        $responseData = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_annual_plan_revised.get_current_desk_approval_authority'), $data)->json();
        //dd($responseData);
        $current_desk_approval_authority = isSuccess($responseData) ? $responseData['data'] : [];
        return view(
            'modules.audit_plan.annual.annual_plan_revised.partials.load_approval_authority',
            compact(
                'officeId',
                'fiscal_year_id',
                'annual_plan_main_id',
                'activity_type',
                'op_audit_calendar_event_id',
                'officer_lists',
                'current_desk_approval_authority'
            )
        );
    }

    public function sendAnnualPlanSenderToReceiver(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            //dd($request->all());
            $data = Validator::make($request->all(), [
                'fiscal_year_id' => 'required|integer',
                'annual_plan_main_id' => 'required|integer',
                'activity_type' => 'required|string',
                'op_audit_calendar_event_id' => 'required|integer',
                'receiver_type' => 'required',
                'receiver_office_id' => 'required',
                'receiver_office_name_en' => 'required',
                'receiver_office_name_bn' => 'required',
                'receiver_unit_id' => 'required',
                'receiver_unit_name_en' => 'required',
                'receiver_unit_name_bn' => 'required',
                'receiver_officer_id' => 'required',
                'receiver_name_en' => 'required',
                'receiver_name_bn' => 'required',
                'receiver_designation_id' => 'required',
                'receiver_designation_en' => 'required',
                'receiver_designation_bn' => 'required',
            ])->validate();

            $data['status'] = 'pending';
            $data['comments'] = $request->comments;
            $data['cdesk'] = $this->current_desk_json();

            $responseData = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_annual_plan_revised.send_annual_plan_sender_to_receiver'), $data)->json();
            //dd($responseData);
            if (isSuccess($responseData)) {
                return response()->json(['status' => 'success', 'data' => 'Added!']);
            } else {
                return response()->json(['status' => 'error', 'data' => $responseData]);
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

    public function movementHistoryAnnualPlan(Request $request)
    {
        $data = Validator::make($request->all(), [
            'fiscal_year_id' => 'required|integer',
            'op_audit_calendar_event_id' => 'required|integer',
        ])->validate();

        $responseData = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_annual_plan_revised.get_movement_histories'), $data)->json();
        //dd($responseData);

        if (isSuccess($responseData)) {
            $annual_plan_movement_list = $responseData['data'];
            return view('modules.audit_plan.annual.annual_plan_revised.partials.load_movement_histories', compact('annual_plan_movement_list'));
        } else {
            return response()->json(['status' => 'error', 'data' => $responseData]);
        }
    }

    public function loadEditAnnualPlanMilestone(Request $request)
    {
        $data = Validator::make($request->all(), [
            'schedule_id' => 'required|integer'
        ])->validate();

        $data['cdesk'] = $this->current_desk_json();


        $responseData = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_annual_plan_revised.get_schedule_info'), $data)->json();
        //        dd($responseData);
        if (isSuccess($responseData)) {
            $schedule_info = $responseData['data'];
            return view('modules.audit_plan.annual.annual_plan_revised.partials.load_plan_list_milestone_edit', compact('schedule_info'));
        } else {
            return response()->json(['status' => 'error', 'data' => $responseData]);
        }
    }

    public function editAnnualPlanMilestone(Request $request)
    {
        $data = Validator::make($request->all(), [
            'schedule_id' => 'required|integer',
            'activity_id' => 'required|integer',
            'fiscal_year_id' => 'required|integer',
            'no_of_items' => 'required|integer',
            'staff_assigne' => 'required|integer',
        ])->validate();

        $data['cdesk'] = $this->current_desk_json();

        $submit_plan = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_annual_plan_revised.submit_milestone_value'), $data)->json();
        //        dd($submit_plan);
        if (isSuccess($submit_plan)) {
            return response()->json(['status' => 'success', 'data' => 'Submission Successful!']);
        } else {
            return response()->json(['status' => 'error', 'data' => $submit_plan]);
        }
    }
}
