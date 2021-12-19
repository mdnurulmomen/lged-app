<?php

namespace App\Http\Controllers\QualityControl;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuditQacController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index($qac_type)
    {
//        dd($qac_type);
        $fiscal_years = $this->allFiscalYears();
        return view('modules.audit_quality_control.qac',compact('fiscal_years','qac_type'));
    }

    public function loadApottiQacList(Request $request){
        $data = Validator::make($request->all(), [
            'fiscal_year_id' => 'required|integer',
            'qac_type' => 'required',
        ])->validate();

        $data['cdesk'] = $this->current_desk_json();
        $apotti_list = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.apotti.list'), $data)->json();

//        dd($apotti_list);
        $qac_type =  $request->qac_type;

        if (isSuccess($apotti_list)) {
            $apotti_list = $apotti_list['data'];
            return view('modules.audit_quality_control.qac_apotti_list',
                compact('apotti_list','qac_type'));
        } else {
            return response()->json(['status' => 'error', 'data' => $apotti_list]);
        }
    }

    public function qacApotti(Request $request){
        $data = Validator::make($request->all(), [
            'apotti_id' => 'required|integer',
            'qac_type' => 'required',
        ])->validate();

        $apotti_id = $request->apotti_id;

        $data['cdesk'] = $this->current_desk_json();
        $qac_apotti_status = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_quality_control.qac.get_qac_apotti_status'), $data)->json();
//        dd($qac_apotti_status);
        if (isSuccess($qac_apotti_status)) {
            $qac_apotti_status = $qac_apotti_status['data'];
            return view('modules.audit_quality_control.qac_apotti_form',compact('apotti_id','qac_apotti_status'));

        } else {
            return response()->json(['status' => 'error', 'data' => $qac_apotti_status]);
        }
    }

    public function qacApottiSubmit(Request $request){
//        dd($request->all());

        Validator::make($request->all(), [
            'apotti_id' => 'required|integer',
            'apotti_type' => 'required',
        ])->validate();

        $data = [
            'cdesk' => $this->current_desk_json(),
            'apotti_type' => $request->apotti_type,
            'qac_type' => $request->qac_type,
            'apotti_id' => $request->apotti_id,
            'comment' => $request->comment,
        ];

        $apotti_submit = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_quality_control.qac.qac_apotti_submit'), $data)->json();

//        dd($apotti_submit);

        if (isSuccess($apotti_submit)) {
            $apotti_submit = $apotti_submit['data'];
            return response()->json(['status' => 'success', 'data' => $apotti_submit]);
        } else {
            return response()->json(['status' => 'error', 'data' => $apotti_submit]);
        }
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
