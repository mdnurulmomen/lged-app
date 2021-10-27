<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class XAuditQueryController extends Controller
{
    public function index()
    {
        $cost_center_types = $this->allCostCenterType();
        return view('modules.settings.x_audit_query.x_audit_query_lists',compact('cost_center_types'));
    }

    public function getAuditQueryLists(Request $request)
    {
        $audit_querys = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.audit_query_lists'), [
            'all' => 1
        ])->json();
//        dd($audit_querys);
        if ($audit_querys['status'] == 'success') {
            $audit_querys = $audit_querys['data'];
            return view('modules.settings.x_audit_query.partials.get_audit_query_lists', compact('audit_querys'));
        } else {
            return response()->json(['status' => 'error', 'data' => $audit_querys]);
        }
    }

    public function store(Request $request)
    {
        $data = [
            'cost_center_type_id' => $request->cost_center_type_id,
            'query_title_en' => $request->query_title_en,
            'query_title_bn' => $request->query_title_bn,
        ];

        $create_audit_query = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.audit_query_create'), $data)->json();

        if (isset($create_audit_query['status']) && $create_audit_query['status'] == 'success') {
            return response()->json(responseFormat('success', 'Created Successfully'));
        } else {
            return response()->json(['status' => 'error', 'data' => $create_audit_query]);
        }
    }

    public function auditQueryEdit(Request $request){
        $cost_center_types = $this->allCostCenterType();
        $audit_query_id = $request->audit_query_id;
        $audit_query_cost_center_type = $request->audit_query_cost_center_type;
        $audit_query_title_bn = $request->audit_query_title_bn;
        $audit_query_title_en = $request->audit_query_title_en;
        return view('modules.settings.x_audit_query.partials.update_query_modal',compact('cost_center_types','audit_query_id','audit_query_cost_center_type','audit_query_title_bn','audit_query_title_en'));
    }

    public function update(Request $request)
    {
        $data = [
            'id' => $request->audit_query_id,
            'cost_center_type_id' => $request->cost_center_type_id,
            'query_title_en' => $request->query_title_en,
            'query_title_bn' => $request->query_title_bn,
        ];

        $create_audit_query = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.audit_query_update'), $data)->json();
//        dd($create_audit_query);
        if (isset($create_audit_query['status']) && $create_audit_query['status'] == 'success') {
            return response()->json(['status' => 'success', 'data' => $create_audit_query['data']]);
        } else {
            return response()->json(['status' => 'error', 'data' => $create_audit_query]);
        }
    }

    public function destroy($audit_query_id)
    {
        $data = [
            'audit_query_id' => $audit_query_id,
        ];
//        dd($data);
        $create_audit_query = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.audit_query_delete'), $data)->json();
        if (isset($create_audit_query['status']) && $create_audit_query['status'] == 'success') {
            return response()->json(responseFormat('success', 'Updated Successfully'));
        } else {
            return response()->json(['status' => 'error', 'data' => $create_audit_query]);
        }
    }
}
