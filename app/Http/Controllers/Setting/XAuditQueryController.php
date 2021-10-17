<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class XAuditQueryController extends Controller
{
    public function index()
    {
//        $strategic_durations = $this->allStrategicPlanDurations();
        return view('modules.settings.x_audit_query.x_audit_query_lists');
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

    public function update(Request $request)
    {
        $data = [
            'cost_center_type_id' => $request->cost_center_type_id,
            'query_title_en' => $request->query_title_en,
            'query_title_bn' => $request->query_title_bn,
        ];
        $create_audit_query = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.audit_query_update'), $data)->json();

        if (isset($create_audit_query['status']) && $create_audit_query['status'] == 'success') {
            return response()->json(responseFormat('success', 'Updated Successfully'));
        } else {
            return response()->json(['status' => 'error', 'data' => $create_audit_query]);
        }
    }

    public function destroy($audit_query_id)
    {
        $data = [
            'audit_query_id' => $audit_query_id,
        ];
        $create_audit_query = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.audit_query_delete'), $data)->json();

        if (isset($create_audit_query['status']) && $create_audit_query['status'] == 'success') {
            return response()->json(responseFormat('success', 'Updated Successfully'));
        } else {
            return response()->json(['status' => 'error', 'data' => $create_audit_query]);
        }
    }
}
