<?php

namespace App\Http\Controllers\AuditExecution;

use App\Http\Controllers\Controller;
use App\Services\FireNotificationServices;
use Illuminate\Http\Request;
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
        $schedule_id = $request->schedule_id;
        $cost_center_id = $request->cost_center_id;
        $cost_center_name_bn = $request->cost_center_name_bn;
        $cost_center_name_en = $request->cost_center_name_en;
        return view('modules.audit_execution.audit_execution_query.audit_query',
            compact('schedule_id', 'cost_center_id', 'cost_center_name_bn',
                'cost_center_name_en'));
    }

    public function loadAuditQuery(Request $request)
    {
        $schedule_id = $request->schedule_id;
        $data['cost_center_id'] = $request->cost_center_id;
        $data['cdesk'] = $this->current_desk_json();
        $audit_query_list = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.load_audit_query'), $data)->json();
        //dd($data);
        $audit_query_list = $audit_query_list['status'] == 'success' ? $audit_query_list['data'] : [];
        return view('modules.audit_execution.audit_execution_query.partials.load_query_list',
            compact('audit_query_list', 'schedule_id'));
    }

    public function loadTypeWiseAuditQuery(Request $request)
    {
        $data['cost_center_type_id'] = $request->cost_center_type_id;
        $audit_query_list = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.load_type_wise_audit_query'), $data)->json();
        //dd($audit_query_list);
        $audit_query_list = $audit_query_list['status'] == 'success' ? $audit_query_list['data'] : [];
        return view('modules.audit_execution.audit_execution_query.partials.load_type_wise_query_list',
            compact('audit_query_list'));
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
        $schedule_id = $request->schedule_id;
        $cost_center_id = $request->cost_center_id;
        $cost_center_name_bn = $request->cost_center_name_bn;
        $cost_center_name_en = $request->cost_center_name_en;
        return view('modules.audit_execution.audit_execution_query.create',
            compact('cost_center_types', 'schedule_id', 'cost_center_id', 'cost_center_name_bn', 'cost_center_name_en'));
    }

    public function loadRejectAuditQuery(Request $request)
    {
        $ac_query_id = $request->ac_query_id;
        $cost_center_type_id = $request->cost_center_type_id;
        $query_title_bn = $request->query_title_bn;
        return view('modules.audit_execution.audit_execution_query.partials.load_query_reject',
            compact('ac_query_id', 'cost_center_type_id', 'query_title_bn'));
    }

    public function storeAuditQuery(Request $request)
    {
        $data = Validator::make($request->all(), [
            'schedule_id' => 'required|integer',
            'memorandum_no' => 'required',
            'memorandum_date' => 'required',
            'rpu_office_head_details' => 'required',
            'subject' => 'required',
            'audit_query_items' => 'required',
        ])->validate();

        $data['cdesk'] = $this->current_desk_json();
        $data['description'] = $request->description;
        $data['cc'] = $request->cc;

        $store_audit_query = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.store_audit_query'), $data)->json();

//        dd($store_audit_query);

        if ($store_audit_query['status'] == 'success') {
            $store_audit_query = $store_audit_query['data'];
            return response()->json(['status' => 'success', 'data' => $store_audit_query]);
        } else {
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
        $audit_query = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.view_audit_query'), $data)->json();
        if (isSuccess($audit_query)) {
            $auditQueryInfo = $audit_query['data'];
            $cost_center_types = $this->allCostCenterType();
            return view('modules.audit_execution.audit_execution_query.edit',
                compact('auditQueryInfo', 'cost_center_types', 'schedule_id'));
        } else {
            return response()->json(['status' => 'error', 'data' => $audit_query]);
        }
    }

    //update
    public function updateAuditQuery(Request $request)
    {
        $data = Validator::make($request->all(), [
            'ac_query_id' => 'required|integer',
            'memorandum_no' => 'required',
            'memorandum_date' => 'required',
            'rpu_office_head_details' => 'required',
            'subject' => 'required',
            'audit_query_items' => 'required',
        ])->validate();

        $data['cdesk'] = $this->current_desk_json();
        $data['description'] = $request->description;
        $data['cc'] = $request->cc;
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
        $data['ac_query_id'] = $request->ac_query_id;
        $audit_query = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.view_audit_query'), $data)->json();
        if (isSuccess($audit_query)) {
            $auditQueryInfo = $audit_query['data'];
            $hasSentToRpu = $request->has_sent_to_rpu;
            $scopeAuthority = $request->scope_authority;
            return view('modules.audit_execution.audit_execution_query.show',
                compact('auditQueryInfo', 'hasSentToRpu', 'scopeAuthority'));
        } else {
            return response()->json(['status' => 'error', 'data' => $audit_query]);
        }
    }

    //download
    public function downloadAuditQuery(Request $request)
    {
        $data['cdesk'] = $this->current_desk_json();
        $data['ac_query_id'] = $request->ac_query_id;
        $responseData = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.view_audit_query'), $data)->json();
        $auditQueryInfo = isSuccess($responseData) ? $responseData['data'] : [];

        $directorateName = $this->current_office()['office_name_bn'];

        if ($this->current_office_id() == 14) {
            $directorateAddress = 'অডিট কমপ্লেক্স (৩য় তলা) <br> সেগুনবাগিচা,ঢাকা-১০০০।';
            $directorateWebsite = 'www.worksaudit.org.bd';
        } elseif ($this->current_office_id() == 3) {
            $directorateAddress = 'অডিট কমপ্লেক্স (২য় তলা) <br> সেগুনবাগিচা,ঢাকা-১০০০।';
            $directorateWebsite = 'www.dgcivil-cagbd.org';
        } else {
            $directorateAddress = 'অডিট কমপ্লেক্স (৮ম তলা) <br> সেগুনবাগিচা,ঢাকা-১০০০।';
            $directorateWebsite = 'www.cad.org.bd';
        }

        $pdf = \PDF::loadView('modules.audit_execution.audit_execution_query.partials.query_book',
            compact('auditQueryInfo', 'directorateName', 'directorateAddress', 'directorateWebsite'));
        return $pdf->stream('query_' . $request->ac_query_id . '.pdf');
    }

    //authority
    public function authorityQueryList()
    {
        return view('modules.audit_execution.audit_execution_query.authority_query_list');
    }

    public function loadAuthorityQueryList(Request $request)
    {
        $data['cdesk'] = $this->current_desk_json();
        $audit_query_list = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.authority_query_list'), $data)->json();
        $audit_query_list = isSuccess($audit_query_list) ? $audit_query_list['data'] : [];
        return view('modules.audit_execution.audit_execution_query.partials.load_authority_query_list',
            compact('audit_query_list'));
    }
}
