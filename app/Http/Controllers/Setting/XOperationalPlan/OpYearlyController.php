<?php

namespace App\Http\Controllers\Setting\XOperationalPlan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OpYearlyController extends Controller
{
    public function index()
    {
        return view('modules.settings.op.op_yearly.yearly_lists');
    }

    public function getYearlyLists(Request $request)
    {
        $op_yearlies = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.op_yearly_lists'), [
            'all' => 1
        ])->json();
        if ($op_yearlies['status'] == 'success') {
            $op_yearlies = $op_yearlies['data'];
            return view('modules.settings.op.op_yearly.partials.get_yearly_lists', compact('op_yearlies'));
        } else {
            return response()->json(['status' => 'error', 'data' => $op_yearlies]);
        }
    }

    public function store(Request $request)
    {
        $data = [
            'start_year' => $request->start_year,
            'end_year' => $request->end_year,
            'description' => $request->description,
        ];
        $create_op_yearly = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.op_yearly_create'),
            $data)
            ->json();

        if (isset($create_op_yearly['status']) && $create_op_yearly['status'] == 'success') {
            return response()->json(responseFormat('success', 'Created Successfully'));
        } else {
            return response()->json(['status' => 'error', 'data' => $create_op_yearly]);
        }
    }

    public function update(Request $request)
    {
        $data = [
            'op_yearly_id' => $request->op_yearly_id,
            'start_year' => $request->start_year,
            'end_year' => $request->end_year,
            'description' => $request->description,
        ];
        $create_op_yearly = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.op_yearly_update'),
            $data)
            ->json();

        if (isset($create_op_yearly['status']) && $create_op_yearly['status'] == 'success') {
            return response()->json(responseFormat('success', 'Updated Successfully'));
        } else {
            return response()->json(['status' => 'error', 'data' => $create_op_yearly]);
        }
    }

    public function destroy($op_yearly_id)
    {
        $data = [
            'op_yearly_id' => $op_yearly_id,
        ];
        $create_op_yearly = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.op_yearly_delete'),
            $data)
            ->json();

        if (isset($create_op_yearly['status']) && $create_op_yearly['status'] == 'success') {
            return response()->json(responseFormat('success', 'Updated Successfully'));
        } else {
            return response()->json(['status' => 'error', 'data' => $create_op_yearly]);
        }
    }
}
