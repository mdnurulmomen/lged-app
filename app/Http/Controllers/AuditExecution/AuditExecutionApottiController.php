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
        $fiscal_years = $this->allFiscalYears();
        return view('modules.audit_execution.audit_execution_apotti.index',compact('fiscal_years'));
    }

    public function loadApottiList(Request $request){
        $data = Validator::make($request->all(), [
            'fiscal_year_id' => 'required|integer',
        ])->validate();

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
        $data = Validator::make($request->all(), [
            'apottiId' => 'required',
        ])->validate();
        $data['cdesk'] = $this->current_desk_json();

        $apotti_item_list = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.apotti.apotti_wise_all_tiem'), $data)->json();


        if (isSuccess($apotti_item_list)) {
            $apotti_item_list = $apotti_item_list['data'];
            $jorito_ourtho = 0;
            foreach ($apotti_item_list as $apotti_item){
                $jorito_ourtho += $apotti_item['jorito_ortho_poriman'];
            }
            $apotti_ids = json_encode($request->apottiId);
            return view('modules.audit_execution.audit_execution_apotti.partial.onucched_form',compact('apotti_item_list','apotti_ids','jorito_ourtho'));
        } else {
            return response()->json(['status' => 'error', 'data' => $apotti_item_list]);
        }
    }

    public function onucchedMarge(Request $request)
    {
        $data = [
                'cdesk' => $this->current_desk_json(),
                'onucched_no' => $request->onucched_no,
                'apotti_title' => $request->apotti_title,
                'apotti_description' => $request->apotti_description,
                'total_jorito_ortho_poriman' => $request->total_jorito_ortho_poriman,
                'irregularity_cause' => $request->irregularity_cause,
                'response_of_rpu' => $request->response_of_rpu,
                'audit_conclusion' => $request->audit_conclusion,
                'audit_recommendation' => $request->audit_recommendation,
                'apotti_id' => json_decode($request->apottiId,true),
            ];

        $merged_apotti = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.apotti.onucched_merge'), $data)->json();

//        dd($merged_apotti);

        if (isSuccess($merged_apotti)) {
            $merged_apotti = $merged_apotti['data'];
            return response()->json(['status' => 'success', 'data' => $merged_apotti]);
        } else {
            return response()->json(['status' => 'error', 'data' => $merged_apotti]);
        }
    }

    public function onucchedUnMarge(Request $request)
    {
        $data = [
            'cdesk' => $this->current_desk_json(),
            'apotti_item_id' => $request->apotti_item_id,
        ];

        $unmerged_apotti = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.apotti.onucched_unmerge'), $data)->json();

//        dd($unmerged_apotti);

        if (isSuccess($unmerged_apotti)) {
            $unmerged_apotti = $unmerged_apotti['data'];
            return response()->json(['status' => 'success', 'data' => $unmerged_apotti]);
        } else {
            return response()->json(['status' => 'error', 'data' => $unmerged_apotti]);
        }
    }

    public function onucchedReArrange(Request $request)
    {
        $data = [
            'cdesk' => $this->current_desk_json(),
            'apotti_sequence' => $request->apotti_sequence,
        ];

        $rearrange_apotti = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.apotti.onucched_rearrange'), $data)->json();

        if (isSuccess($rearrange_apotti)) {
            $rearrange_apotti = $rearrange_apotti['data'];
            return response()->json(['status' => 'success', 'data' => $rearrange_apotti]);
        } else {
            return response()->json(['status' => 'error', 'data' => $rearrange_apotti]);
        }
    }

    public function onucchedShow(Request $request)
    {
        $data = [
            'cdesk' => $this->current_desk_json(),
            'apotti_id' => $request->apotti_id,
        ];

        $apotti_info = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.apotti.get_apotti_info'), $data)->json();

//        dd($apotti_info);

        if (isSuccess($apotti_info)) {
            $apotti_info = $apotti_info['data'];
            return view('modules.audit_execution.audit_execution_apotti.apotti_show',
                compact('apotti_info'));
        } else {
            return response()->json(['status' => 'error', 'data' => $apotti_info]);
        }
    }

    public function editApotti(Request $request)
    {
        $data = Validator::make($request->all(), [
            'apotti_id' => 'required',
        ])->validate();

        $data['cdesk'] = $this->current_desk_json();


        $apotti_info = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.apotti.get_apotti_info'), $data)->json();
//        dd($apotti_info);
        if (isSuccess($apotti_info)) {
            $apotti_info = $apotti_info['data'];
            return view('modules.audit_execution.audit_execution_apotti.apotti_edit',
                compact('apotti_info'));
        } else {
            return response()->json(['status' => 'error', 'data' => $apotti_info]);
        }
    }

    public function updateApotti(Request $request){

        Validator::make($request->all(), [
            'apotti_id' => 'required',
        ])->validate();

        $data = [
            'apotti_id' => $request->apotti_id,
            'cdesk' => $this->current_desk_json(),
            'onucched_no' => $request->onucched_no,
            'apotti_title' => $request->apotti_title,
            'apotti_description' => $request->apotti_description,
            'irregularity_cause' => $request->irregularity_cause,
            'response_of_rpu' => $request->response_of_rpu,
            'audit_conclusion' => $request->audit_conclusion,
            'audit_recommendation' => $request->audit_recommendation,
        ];

        $apotti_info = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.apotti.update_apotti'), $data)->json();

        if (isSuccess($apotti_info)) {
            $apotti_info = $apotti_info['data'];
            return view('modules.audit_execution.audit_execution_apotti.apotti_edit',
                compact('apotti_info'));
        } else {
            return response()->json(['status' => 'error', 'data' => $apotti_info]);
        }
    }

    public function auditPlanWiseEntitySelect(Request $request){
        $entity_list = json_decode($request->entity_list,true);
        return view('modules.audit_execution.audit_execution_apotti.plan_wise_enitity_select',
            compact('entity_list'));
    }

    public function apottiItemInfo(Request $request)
    {
        $data = Validator::make($request->all(), [
            'apotti_item_id' => 'required',
        ])->validate();
        $data['cdesk'] = $this->current_desk_json();

        $apotti_info = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.apotti.get_apotti_item_info'), $data)->json();
//        dd($apotti_info);
        if (isSuccess($apotti_info)) {
            $apotti_info = $apotti_info['data'];
            return view('modules.audit_execution.audit_execution_apotti.apotti_item_show',
                compact('apotti_info'));
        } else {
            return response()->json(['status' => 'error', 'data' => $apotti_info]);
        }
    }
}
