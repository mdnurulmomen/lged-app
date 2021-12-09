<?php

namespace App\Http\Controllers\AuditExecution;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuditExecutionApottiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        return view('modules.audit_execution.audit_execution_apotti.index');
    }

    public function loadApottiList(Request $request){
        $data['cdesk'] = $this->current_desk_json();
        $apotti_list = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.apotti.list'), $data)->json();
//        dd($apotti_list);
        if (isSuccess($apotti_list)) {
            $apotti_list = $apotti_list['data'];
            return view('modules.audit_execution.audit_execution_apotti.apotti_list',
                compact('apotti_list'));
        } else {
            return response()->json(['status' => 'error', 'data' => $apotti_list]);
        }
    }

    public function onucchedMargeForm(Request $request)
    {
        return view('modules.audit_execution.audit_execution_apotti.partial.onucched_form');
    }

    public function onucchedMarge(Request $request)
    {
        $data = [
                'cdesk' => $this->current_desk_json(),
                'apotti_title' => $request->apotti_title,
                'apotti_description' => $request->apotti_description,
                'irregularity_cause' => $request->irregularity_cause,
                'response_of_rpu' => $request->response_of_rpu,
                'audit_conclusion' => $request->audit_conclusion,
                'audit_recommendation' => $request->audit_recommendation,
                'apotti_id' => json_decode($request->apottiId,true),
            ];

        $merged_apotti = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.apotti.onucched_merge'), $data)->json();

        dd($merged_apotti);

        if (isSuccess($merged_apotti)) {
            $merged_apotti = $merged_apotti['data'];
            return response()->json(['status' => 'success', 'data' => $merged_apotti]);
        } else {
            return response()->json(['status' => 'error', 'data' => $merged_apotti]);
        }
    }
}
