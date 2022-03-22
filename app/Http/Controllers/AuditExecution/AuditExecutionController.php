<?php

namespace App\Http\Controllers\AuditExecution;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuditExecutionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->filter_data){
            $filter_data = urldecode(base64_decode($request->filter_data));
            $filter_data = json_decode($filter_data);
            if($filter_data->from == 'dashboard'){
                $filterData = [
                    'directorate_id' => $filter_data->directorate_id,
                    'fiscal_year_id' => $filter_data->fiscal_year_id,
                    'entity_id' => $filter_data->entity_id,
                    'cost_center_id' => $filter_data->cost_center_id,
                    'team_filter' => $filter_data->team_filter,
                    'activity_id' => $filter_data->activity_id,
                    'status' => $filter_data->status,
                ];
                Session::put('dashboard_filter_data',json_encode($filterData));
            }
        }
        $this->userPermittedMenusByModule(request()->path());
        return view('modules.audit_execution.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
