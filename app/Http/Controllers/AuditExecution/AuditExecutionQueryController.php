<?php

namespace App\Http\Controllers\AuditExecution;

use App\Http\Controllers\Controller;
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
        return view('modules.audit_execution.audit_execution_query.index');
    }

    public function querySchedule()
    {
        return view('modules.audit_execution.audit_execution_query.query_schedule');
    }

    public function loadQueryScheduleList(Request $request)
    {
        $data['cdesk'] = json_encode_unicode($this->current_desk());
        $data['fiscal_year_id'] = 1;
        $audit_query_schedule_list = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.get_query_schedule_list'), $data)->json();
        if ($audit_query_schedule_list['status'] == 'success') {
            $audit_query_schedule_list = $audit_query_schedule_list['data'];
            return view('modules.audit_execution.audit_execution_query.partials.load_query_schedule_list', compact('audit_query_schedule_list'));
        } else {
            return response()->json(['status' => 'error', 'data' => $audit_query_schedule_list]);
        }
    }


    public function auditQuery(Request $request)
    {
        $cost_center_types = $this->allCostCenterType();
        $cost_center_id = $request->cost_center_id;
        $cost_center_name_bn = $request->cost_center_name_bn;
        $cost_center_name_en = $request->cost_center_name_en;
        $cost_center_type_id = $request->cost_center_type_id;
        return view('modules.audit_execution.audit_execution_query.audit_query',
            compact('cost_center_type_id', 'cost_center_types', 'cost_center_id',
                'cost_center_name_bn', 'cost_center_name_en'));
    }

    public function loadAuditQuery(Request $request)
    {
        $data['cost_center_id'] = $request->cost_center_id;
        $data['cost_center_type_id'] = $request->cost_center_type_id;
        $data['cdesk'] = json_encode_unicode($this->current_desk());
        $audit_query_list = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.audit_query_cost_center_type_wise'), $data)->json();
        $cost_center_types = $this->allCostCenterType();
        //dd($data);
        if ($audit_query_list['status'] == 'success') {
            $audit_query_list = $audit_query_list['data'];
            return view('modules.audit_execution.audit_execution_query.partials.load_query_list',
                compact('audit_query_list', 'cost_center_types'));
        }
    }

    public function sendAuditQuery(Request $request)
    {
        $data = Validator::make($request->all(), [
            'cost_center_type_id' => 'required|integer',
            'cost_center_id' => 'required|integer',
            'cost_center_name_bn' => 'required',
            'cost_center_name_en' => 'required',
            'queries' => 'required',
        ])->validate();
        $data['cdesk'] = json_encode_unicode($this->current_desk());
        $data['fiscal_year_id'] = 1;
        $data['cost_center_type_id'] = $request->cost_center_type_id;
        $data['cost_center_id'] = $request->cost_center_id;
        $data['cost_center_name_bn'] = $request->cost_center_name_bn;
        $data['cost_center_name_en'] = $request->cost_center_name_en;
        $data['queries'] = $request->queries;
        $send_audit_queries = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.send_audit_query'), $data)->json();
        if ($send_audit_queries['status'] == 'success') {
            $send_audit_queries = $send_audit_queries['data'];
            return response()->json(['status' => 'success', 'data' => $send_audit_queries]);
        } else {
            return response()->json(['status' => 'error', 'data' => $send_audit_queries]);
        }
    }

    public function receivedAuditQuery(Request $request)
    {
        $data['cdesk'] = json_encode_unicode($this->current_desk());
        $data['fiscal_year_id'] = 1;
        $data['cost_center_type_id'] = $request->cost_center_type_id;
        $data['cost_center_id'] = $request->cost_center_id;
        $data['cost_center_name_bn'] = $request->cost_center_name_bn;
        $data['cost_center_name_en'] = $request->cost_center_name_en;
        $data['query_id'] = $request->query_id;
        $received_audit_queries = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.received_audit_query'), $data)->json();
        if ($received_audit_queries['status'] == 'success') {
            $received_audit_queries = $received_audit_queries['data'];
            return response()->json(['status' => 'success', 'data' => $received_audit_queries]);
        } else {
            return response()->json(['status' => 'error', 'data' => $received_audit_queries]);
        }
    }

    public function loadQueryCreateForm(Request $request)
    {
        //($request->all());
        $cost_center_types = $this->allCostCenterType();
        $cost_center_type_id = $request->cost_center_type_id;
        return view('modules.audit_execution.audit_execution_query.partials.load_query_add_form',
            compact('cost_center_types','cost_center_type_id'));
    }

    public function loadRejectAuditQuery(Request $request)
    {
        $ac_query_id = $request->ac_query_id;
        $cost_center_type_id = $request->cost_center_type_id;
        $query_title_bn = $request->query_title_bn;
        return view('modules.audit_execution.audit_execution_query.partials.load_query_reject',
            compact('ac_query_id','cost_center_type_id','query_title_bn'));
    }

    public function rejectAuditQuery(Request $request)
    {
        $data['cdesk'] = json_encode_unicode($this->current_desk());
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
}
