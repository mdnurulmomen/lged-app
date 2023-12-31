<?php

namespace App\Http\Controllers\AuditExecution;

use App\Http\Controllers\Controller;
use App\Services\FireNotificationServices;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuditExecutionQueryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        /*return view('modules.audit_execution.audit_execution_query.index');*/
    }


    public function auditQuery(Request $request)
    {
        $team_id = $request->team_id;
        $audit_plan_id = $request->audit_plan_id;
        $schedule_id = $request->schedule_id;
        $entity_id = $request->entity_id;
        $cost_center_id = $request->cost_center_id;
        $cost_center_name_bn = $request->cost_center_name_bn;
        $cost_center_name_en = $request->cost_center_name_en;
        $project_name_bn = $request->project_name_bn;

        return view(
            'modules.audit_execution.audit_execution_query.audit_query',
            compact(
                'team_id',
                'audit_plan_id',
                'schedule_id',
                'entity_id',
                'cost_center_id',
                'cost_center_name_bn',
                'cost_center_name_en',
                'project_name_bn',
            )
        );
    }

    public function loadAuditQuery(Request $request)
    {
        $team_id= $request->team_id;
        $schedule_id = $request->schedule_id;
        $project_name_bn = $request->project_name_bn;
        $data['audit_plan_id'] = $request->audit_plan_id;
        $data['entity_id'] = $request->entity_id;
        $data['cost_center_id'] = $request->cost_center_id;
        $data['cdesk'] = $this->current_desk_json();
        $audit_query_list = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.load_audit_query'), $data)->json();
        $audit_query_list = $audit_query_list['status'] == 'success' ? $audit_query_list['data'] : [];

        return view(
            'modules.audit_execution.audit_execution_query.partials.load_query_list',
            compact('audit_query_list', 'team_id','schedule_id','project_name_bn')
        );
    }

    public function loadTypeWiseAuditQuery(Request $request)
    {
        $data['cost_center_type_id'] = $request->cost_center_type_id;
        $audit_query_list = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.load_type_wise_audit_query'), $data)->json();
        //dd($audit_query_list);
        $audit_query_list = $audit_query_list['status'] == 'success' ? $audit_query_list['data'] : [];
        return view(
            'modules.audit_execution.audit_execution_query.partials.load_type_wise_query_list',
            compact('audit_query_list')
        );
    }

    public function sendAuditQuery(Request $request)
    {
        $data = Validator::make($request->all(), [
            'ac_query_id' => 'required|integer',
        ])->validate();
        $data['cdesk'] = $this->current_desk_json();
        $send_audit_queries = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.send_audit_query'), $data)->json();
        if ($send_audit_queries['status'] == 'success') {
            $mail_data = [
                'cost_center_ids' => $request->cost_center_id,
                'notifiable_type' => 'query',
            ];
            $send_mail_to_rpu = (new FireNotificationServices())->sendMailToRpu($mail_data);
            $send_audit_queries = $send_audit_queries['data'];
            return response()->json(['status' => 'success', 'data' => $send_audit_queries]);
        } else {
            return response()->json(['status' => 'error', 'data' => $send_audit_queries]);
        }
    }

    public function receivedAuditQuery(Request $request)
    {
        $data['cdesk'] = $this->current_desk_json();
        $data['ac_query_item_id'] = $request->ac_query_item_id;
        $data['ac_query_id'] = $request->ac_query_id;
        $received_audit_queries = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.received_audit_query'), $data)->json();
        //dd($received_audit_queries);
        if ($received_audit_queries['status'] == 'success') {
            $received_audit_queries = $received_audit_queries['data'];
            return response()->json(['status' => 'success', 'data' => $received_audit_queries]);
        } else {
            return response()->json(['status' => 'error', 'data' => $received_audit_queries]);
        }
    }

    public function auditQueryCreate(Request $request)
    {
        $cost_center_types = $this->allCostCenterType();
        $audit_plan_id = $request->audit_plan_id;
        $schedule_id = $request->schedule_id;
        $entity_id = $request->entity_id;
        $cost_center_id = $request->cost_center_id;
        $cost_center_name_bn = $request->cost_center_name_bn;
        $cost_center_name_en = $request->cost_center_name_en;
        $project_name_bn = $request->project_name_bn;
        $team_id = $request->team_id;
        $get_team = $this->getTeam($team_id);
        //dd($get_team);
        //dd(json_decode($get_team[0]['team_members'],true));
        return view(
            'modules.audit_execution.audit_execution_query.create',
            compact(
                'cost_center_types',
                'audit_plan_id',
                'schedule_id',
                'entity_id',
                'cost_center_id',
                'cost_center_name_bn',
                'cost_center_name_en',
                'team_id',
                'project_name_bn',
                'get_team',
            )
        );
    }

    public function loadRejectAuditQuery(Request $request)
    {
        $ac_query_id = $request->ac_query_id;
        $cost_center_type_id = $request->cost_center_type_id;
        $query_title_bn = $request->query_title_bn;
        return view(
            'modules.audit_execution.audit_execution_query.partials.load_query_reject',
            compact('ac_query_id', 'cost_center_type_id', 'query_title_bn')
        );
    }

    public function storeAuditQuery(Request $request)
    {
        $data = Validator::make(
            $request->all(),
            [
                'schedule_id' => 'required',
                'memorandum_no' => 'required',
                'memorandum_date' => 'required',
                'rpu_office_head_details' => 'required',
                'subject' => 'required',
            ],
            [
                'schedule_id.required' => 'Schedule id is required',
                'memorandum_no.required' => 'Memorandum no is required',
                'memorandum_date.required' => 'Memorandum date is required',
                'rpu_office_head_details.required' => 'RP office head details is required',
                'subject.required' => 'Subject is required',
            ]
        )->validate();

        $data['cdesk'] = $this->current_desk_json();
        $data['suthro'] = $request->suthro;
        $data['audit_query_items'] = $request->audit_query_items;
        $data['description'] = $request->description;
        $data['cc'] = $request->cc;
        $data['issued_by'] = $request->issued_by;
        $data['team_leader_name'] = $request->team_leader_name;
        $data['team_leader_designation'] = $request->team_leader_designation;
        $data['sub_team_leader_name'] = $request->sub_team_leader_name;
        $data['sub_team_leader_designation'] = $request->sub_team_leader_designation;
        $data['responsible_person_details'] = $request->responsible_person_details;

        $store_audit_query = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.store_audit_query'), $data)->json();

        if (isSuccess($store_audit_query)) {
            $store_audit_query = $store_audit_query['data'];
            return response()->json(['status' => 'success', 'data' => $store_audit_query]);
        }else {
            return response()->json(['status' => 'error', 'data' => $store_audit_query]);
        }
    }

    public function rejectAuditQuery(Request $request)
    {
        $data['cdesk'] = $this->current_desk_json();
        $data['ac_query_id'] = $request->ac_query_id;
        $data['comment'] = $request->comment;
        $rejected_audit_query = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.rejected_audit_query'), $data)->json();
        if ($rejected_audit_query['status'] == 'success') {
            $rejected_audit_query = $rejected_audit_query['data'];
            return response()->json(['status' => 'success', 'data' => $rejected_audit_query]);
        } else {
            return response()->json(['status' => 'error', 'data' => $rejected_audit_query]);
        }
    }

    //edit
    public function editAuditQuery(Request $request)
    {
        $data['cdesk'] = $this->current_desk_json();
        $data['ac_query_id'] = $request->ac_query_id;
        $schedule_id = $request->schedule_id;
        $audit_plan_id = $request->audit_plan_id;
        $entity_id = $request->entity_id;
        $team_id = $request->team_id;
        $project_name_bn = $request->project_name_bn;
        $audit_query = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.view_audit_query'), $data)->json();

        if (isSuccess($audit_query)) {
            $auditQueryInfo = $audit_query['data'];
            $cost_center_types = $this->allCostCenterType();
            $get_team = $this->getTeam($team_id);
            return view('modules.audit_execution.audit_execution_query.edit', compact('auditQueryInfo', 'cost_center_types', 'schedule_id','audit_plan_id','entity_id','get_team','team_id','project_name_bn'));
        } else {
            return response()->json(['status' => 'error', 'data' => $audit_query]);
        }
    }

    //update
    public function updateAuditQuery(Request $request)
    {
        $data = Validator::make(
            $request->all(),
            [
                'ac_query_id' => 'required',
                'memorandum_no' => 'required',
                'memorandum_date' => 'required',
                'rpu_office_head_details' => 'required',
                'subject' => 'required',
            ],
            [
                'ac_query_id.required' => 'Query id is required',
                'memorandum_no.required' => 'Memorandum no is required',
                'memorandum_date.required' => 'Memorandum date is required',
                'rpu_office_head_details.required' => 'RP office head details is required',
                'subject.required' => 'Subject is required',
            ]
        )->validate();

        $data['cdesk'] = $this->current_desk_json();
        $data['suthro'] = $request->suthro;
        $data['description'] = $request->description;
        $data['audit_query_items'] = $request->audit_query_items;
        $data['cc'] = $request->cc;
        $data['issued_by'] = $request->issued_by;
        $data['team_leader_name'] = $request->team_leader_name;
        $data['team_leader_designation'] = $request->team_leader_designation;
        $data['sub_team_leader_name'] = $request->sub_team_leader_name;
        $data['sub_team_leader_designation'] = $request->sub_team_leader_designation;
        $data['responsible_person_details'] = $request->responsible_person_details;

        $rejected_audit_query = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.update_audit_query'), $data)->json();
        if ($rejected_audit_query['status'] == 'success') {
            $rejected_audit_query = $rejected_audit_query['data'];
            return response()->json(['status' => 'success', 'data' => $rejected_audit_query]);
        } else {
            return response()->json(['status' => 'error', 'data' => $rejected_audit_query]);
        }
    }

    //view
    public function viewAuditQuery(Request $request)
    {
        $data['cdesk'] = $this->current_desk_json();
        if ($request->has('directorate_id')) {
            $data['directorate_id'] = $request->directorate_id;
        }
        $data['ac_query_id'] = $request->ac_query_id;
        $audit_query = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.view_audit_query'), $data)->json();

        if (isSuccess($audit_query)) {
            $auditQueryInfo = $audit_query['data'];
            $hasSentToRpu = $request->has_sent_to_rpu;
            $scopeAuthority = $request->scope_authority;
            return view(
                'modules.audit_execution.audit_execution_query.show',
                compact('auditQueryInfo', 'hasSentToRpu', 'scopeAuthority')
            );
        } else {
            return response()->json(['status' => 'error', 'data' => $audit_query]);
        }
    }

    //download
    public function downloadAuditQuery(Request $request)
    {
        $data['cdesk'] = $this->current_desk_json();
        if ($request->has('directorate_id')) {
            $data['directorate_id'] = $request->directorate_id;
        }
        $data['ac_query_id'] = $request->ac_query_id;
        $responseData = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.view_audit_query'), $data)->json();
        $auditQueryInfo = isSuccess($responseData) ? $responseData['data'] : [];

        $pdf = \PDF::loadView(
            'modules.audit_execution.audit_execution_query.partials.query_book',
            compact('auditQueryInfo')
        );
        return $pdf->stream('query_' . $request->ac_query_id . '.pdf');
    }

    //authority
    public function authorityQueryList()
    {
        $all_directorates = $this->allAuditDirectorates();

        $fiscal_years = $this->allFiscalYears();

        $self_directorate = current(array_filter($all_directorates, function ($item) {
            return $this->current_office_id() == $item['office_id'];
        }));

        $directorates = $self_directorate ? [$self_directorate] : $all_directorates;

        return view('modules.audit_execution.audit_execution_query.authority_query_list', compact('directorates', 'fiscal_years'));
    }

    public function loadAuthorityQueryList(Request $request)
    {
        if (session::has('dashboard_filter_data')) {
            Session::forget('dashboard_filter_data');
        }

        $data['cdesk'] = $this->current_desk_json();
        $data['office_id'] = $request->directorate_id;
        $data['team_id'] = $request->team_id;
        $data['fiscal_year_id'] = $request->fiscal_year_id;
        $data['entity_id'] = $request->entity_id;
        $data['activity_id'] = $request->activity_id;
        $data['cost_center_id'] = $request->cost_center_id;

        if ($request->start_date && $request->end_date) {
            $start_date = str_replace('/', '-', $request->start_date);
            $data['start_date'] = Carbon::parse($start_date)->format('Y-m-d');
            $end_date = str_replace('/', '-', $request->end_date);
            $data['end_date'] = Carbon::parse($end_date)->format('Y-m-d');
        }

        $audit_query_list = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.authority_query_list'), $data)->json();
        //        dd($audit_query_list);
        $audit_query_list = isSuccess($audit_query_list) ? $audit_query_list['data'] : $audit_query_list['data'];

        return view(
            'modules.audit_execution.audit_execution_query.partials.load_authority_query_list',
            compact('audit_query_list')
        );
    }
}
