<?php

namespace App\Http\Controllers\AuditExecution;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuditExecutionAreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Areay|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        return view('modules.audit_execution.audit_execution_area.x_audit_area_list');
        // return view('modules.audit_execution.audit_execution_area.index');
    }

    public function getAuditAreaList()
    {
        $audit_area_list = $this->initHttpWithToken()->get(config('amms_bee_routes.audit_execution.areas'), [
            'all' => 1
        ])->json();

        // dd($audit_area_list);

        if ($audit_area_list['status'] == 'success') {
            $audit_area_list = $audit_area_list['data'];
            return view('modules.audit_execution.audit_execution_area.partials.get_audit_area_list', compact('audit_area_list'));
        } else {
            return response()->json(['status' => 'error', 'data' => $audit_area_list]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('modules.audit_execution.audit_execution_area.partials.create_audit_area_form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_en' => 'required|string|max:255',
            'name_bn' => 'required|string|max:255',
        ]);

        $currentUserId = $this->current_desk()['officer_id'];
        
        $data = [
            'name_en' => $request->name_en,
            'name_bn' => $request->name_bn,
            'created_by' => $currentUserId,
            'updated_by' => $currentUserId,
        ];

        $create_audit_assessment = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_execution.areas'), $data)->json();
        //    dd($create_audit_assessment);
        if (isset($create_audit_assessment['status']) && $create_audit_assessment['status'] == 'success') {
            return response()->json(responseFormat('success', 'Created Successfully'));
        } else {
            return response()->json(['status' => 'error', 'data' => $create_audit_assessment]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function auditAreaEdit(Request $request)
    {
        $id = $request->id;
        $name_en = $request->name_en;
        $name_bn = $request->name_bn;

        return view('modules.audit_execution.audit_execution_area.partials.update_audit_area_form', compact('id', 'name_en', 'name_bn'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name_en' => 'required|string|max:255',
            'name_bn' => 'required|string|max:255',
        ]);
        
        $data = [
            'id' => $request->id,
            'name_en' => $request->name_en,
            'name_bn' => $request->name_bn,
            'updated_by' => $this->current_desk()['officer_id'],
        ];

        $update_audit_area = $this->initHttpWithToken()->put(config('amms_bee_routes.audit_execution.areas')."/$id", $data)->json();
//        dd($create_audit_query);
        if (isset($update_audit_area['status']) && $update_audit_area['status'] == 'success') {
            return response()->json(['status' => 'success', 'data' => $update_audit_area['data']]);
        } else {
            return response()->json(['status' => 'error', 'data' => $update_audit_area]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = [
            'id' => $id,
        ];
    //    dd($data);
        $delete_audit_area = $this->initHttpWithToken()->delete(config('amms_bee_routes.audit_execution.areas')."/$id", $data)->json();
        if (isset($delete_audit_area['status']) && $delete_audit_area['status'] == 'success') {
            return response()->json(responseFormat('success', 'Deleted Successfully'));
        } else {
            return response()->json(['status' => 'error', 'data' => $delete_audit_area]);
        }
    }
}
