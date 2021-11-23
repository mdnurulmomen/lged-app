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
        $data['cdesk'] = $this->current_desk_json();

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

    public function showAnnualPlanEntities(Request $request)
    {
        $data = Validator::make($request->all(), [
            'fiscal_year_id' => 'required|integer',
        ])->validate();

        $data['cdesk'] = $this->current_desk_json();

        $planListResponseData = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_annual_plan_revised.ap_yearly_plan_entities_list_show'),
            $data)->json();


        if (isSuccess($planListResponseData)) {
            $plan_list = $planListResponseData['data']['annual_plan_list'];
            $approval_status = $planListResponseData['data']['approval_status'];
        }

        $fiscal_year = $request->fiscal_year;
        $fiscal_year_id = $request->fiscal_year_id;

        return view('modules.audit_plan.annual.annual_plan_revised.show_annual_entity_selection',
            compact('plan_list', 'fiscal_year',
                'fiscal_year_id', 'approval_status'));

    }

    public function showStaffAssignList(Request $request)
    {
        $responseData = $this->initDoptorHttp()
            ->post(config('cag_doptor_api.office_and_grade_wise_designation'),
                [
                    'office_ids' => $this->current_office_id(),
                    'grade_id' => 12,
                ])->json();

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
//        $temp = url()->previous();
//        dd($temp);
//        dd(\URL::previous());
        \Session::put('url', request()->fullUrl());
//        dd(\Session::get('url'));

        $data = Validator::make($request->all(), [
            'fiscal_year_id' => 'required|integer',
            'op_audit_calendar_event_id' => 'required|integer',
        ])->validate();

        $all_activity = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_operational_plan.get_all_op_activity'),
            $data)->json();

        $fiscal_year_id = $request->fiscal_year_id;
        $op_audit_calendar_event_id = $request->op_audit_calendar_event_id;

        if (isSuccess($all_activity)) {
            $all_activity = $all_activity['data'];
            return view('modules.audit_plan.annual.annual_plan_revised.create_annual_plan_info', compact('all_activity', 'fiscal_year_id', 'op_audit_calendar_event_id'));
        } else {
            return response()->json(['status' => 'error', 'data' => $all_activity]);
        }

    }

    public function activityWiseMilestoneSelect(Request $request)
    {
        $data = Validator::make($request->all(), [
            'activity_id' => 'required|integer',
        ])->validate();

        $all_milestone = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_operational_plan.op_activity_milestones_load'),
            $data)->json();

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
//        dd(json_decode($request->milestone_list,true));

        try {
            Validator::make($request->all(), [
                'op_audit_calendar_event_id' => 'required',
                'activity_id' => 'required|integer',
//                'milestone_id' => 'required|integer',
                'fiscal_year_id' => 'required|integer',
                'ministry_info' => 'required',
                'controlling_office' => 'required',
                'parent_office' => 'required',
                'office_type' => 'required',
                'selected_entity' => 'required',
                'subject_matter' => 'required|string',
                'total_unit_no' => 'required|string',
                'staff_comment' => 'sometimes',
                'staff_info' => 'sometimes',
                'budget' => 'nullable|string',
                'cost_center_total_budget' => 'nullable',
            ])->validate();

            $data = [
                'id' => $request->id,
                'cdesk' => $this->current_desk_json(),
                'activity_id' => $request->activity_id,
                'audit_calendar_event_id' => $request->op_audit_calendar_event_id,
                'fiscal_year_id' => $request->fiscal_year_id,
//                'milestone_id' => $request->milestone_id,
                'subject_matter' => $request->subject_matter,
                'office_type' => $request->office_type,
                'total_unit_no' => $request->total_unit_no,
                'comment' => $request->comment,
                'budget' => $request->budget,
                'cost_center_total_budget' => $request->cost_center_total_budget,
                'milestone_list' => json_decode($request->milestone_list,true),
            ];
            $nominated_offices = [];

            foreach ($request->selected_entity as $nominated_office) {
                $nominated_office = json2Array($nominated_office);
                $nominated_offices[$nominated_office['office_id']] = $nominated_office;
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

//            dd($staffs);

            $nominated_man_powers = [
                'comment' => $request->staff_comment ?? '',
                'nominated_man_power_counts' => $total_man_power,
                'staffs' => $staffs,
            ];

            $data['ministry_info'] = $request->ministry_info;
            $data['controlling_office'] = $request->controlling_office;
            $data['parent_office'] = $request->parent_office;
            $data['nominated_offices'] = json_encode($nominated_offices, JSON_UNESCAPED_UNICODE);
            $data['nominated_man_powers'] = json_encode($nominated_man_powers, JSON_UNESCAPED_UNICODE);
            $data['nominated_man_power_counts'] = $total_man_power;


            if ($request->id) {
                $store_plan = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_annual_plan_revised.ap_yearly_plan_update'), $data)->json();
            } else {
                $store_plan = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_annual_plan_revised.ap_yearly_plan_submission'), $data)->json();
            }

//            dd($store_plan);

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

        $annual_plan_info = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_annual_plan_revised.get_annual_plan_info'),
            $data)->json();

//        dd($annual_plan_info);

        $all_activity = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_operational_plan.get_all_op_activity'),
            $data)->json();

        $master_designation = $this->initDoptorHttp()
            ->post(config('cag_doptor_api.office_and_grade_wise_designation'),
                [
                    'office_ids' => $this->current_office_id(),
                    'grade_id' => 12,
                ])->json();

        $fiscal_year_id = $request->fiscal_year_id;
        $op_audit_calendar_event_id = $request->op_audit_calendar_event_id;

        if (isSuccess($all_activity)) {
            $all_activity = $all_activity['data'];
            $annual_plan_info = $annual_plan_info['data'];
            $designations = $master_designation['data']['designations'];
//            dd($designations);
            $nominated_office_list = json_decode($annual_plan_info['nominated_offices'], true);
            $nominated_man_powers = json_decode($annual_plan_info['nominated_man_powers'], true);
            $staff_list = $nominated_man_powers['staffs'];
            $staff_comment = $nominated_man_powers['comment'];
            $parent_office_info = json_encode(
                [
                    'parent_office_id' => $annual_plan_info['parent_office_id'],
                    'parent_office_name_en' => $annual_plan_info['parent_office_name_en'],
                    'parent_office_name_bn' => $annual_plan_info['parent_office_name_bn'],
                ]
            );

            $controlling_office_info = json_encode(
                [
                    'controlling_office_id' => $annual_plan_info['controlling_office_id'],
                    'controlling_office_name_en' => $annual_plan_info['controlling_office_en'],
                    'controlling_office_name_bn' => $annual_plan_info['controlling_office_bn'],
                ]
            );

            $ministry_info = json_encode(
                [
                    'ministry_id' => $annual_plan_info['ministry_id'],
                    'ministry_name_en' => $annual_plan_info['ministry_name_en'],
                    'ministry_name_bn' => $annual_plan_info['ministry_name_bn'],
                ]
            );

            return view('modules.audit_plan.annual.annual_plan_revised.edit_annual_plan_info',
                compact(
                    'annual_plan_info',
                    'all_activity',
                    'fiscal_year_id',
                    'op_audit_calendar_event_id',
                    'nominated_office_list',
                    'parent_office_info',
                    'controlling_office_info',
                    'ministry_info',
                    'staff_list',
                    'designations',
                    'staff_comment',
                ));
        } else {
            return response()->json(['status' => 'error', 'data' => $all_activity]);
        }

    }

    public function exportAnnualPlanBook(Request $request)
    {
        $data = Validator::make($request->all(), [
            'fiscal_year_id' => 'required|integer',
        ])->validate();
        $data['cdesk'] = $this->current_desk_json();
        $data['office_id'] = $this->current_office_id();

        $plan_infos = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_annual_plan_revised.ap_yearly_plan_book'), $data)->json();

        if (isSuccess($plan_infos)) {
            $plan_infos = $plan_infos['data'];
            $pdf = \PDF::loadView('modules.audit_plan.annual.annual_plan_revised.partials.annual_plan_book', ['plan_infos' => $plan_infos], [], ['orientation' => 'L', 'format' => 'A4']);
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

    public function showRPChildAuditeeOfficesList(Request $request)
    {
        $data = [
            'parent_office_id' => $request->parent_office_id,
            'parent_ministry_id' => $request->parent_ministry_id,
            'parent_office_layer_id' => $request->parent_office_layer_id,
        ];
//        dd($data);
        $rp_offices = $this->initRPUHttp()->post(config('cag_rpu_api.get-parent-wise-child-office'), $data)->json();

//       dd($rp_offices);

        if (isSuccess($rp_offices)) {
            $rp_offices = $rp_offices['data'];
            return view('modules.audit_plan.annual.annual_plan_revised.partials.load_rp_auditee_offices_list', compact('rp_offices'));
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
            'op_audit_calendar_event_id' => 'required|integer',
        ])->validate();

        $officeId = config('cag_amms_config.ocag_office_id');
        $fiscal_year_id = $request->fiscal_year_id;
        $op_audit_calendar_event_id = $request->op_audit_calendar_event_id;
        $officer_lists = $this->cagDoptorOfficeUnitDesignationEmployees($officeId);

        $responseData = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_annual_plan_revised.get_current_desk_approval_authority'), $data)->json();
        //dd($responseData);
        $current_desk_approval_authority = isSuccess($responseData) ? $responseData['data'] : [];
        return view('modules.audit_plan.annual.annual_plan_revised.partials.load_approval_authority',
            compact('officeId', 'fiscal_year_id', 'op_audit_calendar_event_id',
                'officer_lists', 'current_desk_approval_authority'));
    }

    public function sendAnnualPlanSenderToReceiver(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            //dd($request->all());
            $data = Validator::make($request->all(), [
                'fiscal_year_id' => 'required|integer',
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
}
