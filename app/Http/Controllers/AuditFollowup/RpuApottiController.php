<?php

namespace App\Http\Controllers\AuditFollowup;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class RpuApottiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $all_directorates = $this->allAuditDirectorates();

        $self_directorate = current(array_filter($all_directorates, function ($item) {
            return $this->current_office_id() == $item['office_id'];
        }));

        $directorates = $self_directorate ? [$self_directorate] : $all_directorates;

        $fiscal_years = $this->allFiscalYears();

        return view('modules.audit_followup.rpu_apotti.index', compact('fiscal_years', 'directorates'));
    }

    public function getMinistryWiseApottiEntitySelect(Request $request){

        $data =  Validator::make($request->all(), [
            'directorate_id' => 'required',
            'ministry_id' => 'required',
        ])->validate();

        $entity_list = $this->initRPUHttp()->post(config('cag_rpu_api.get-ministry-wise-apotti-entity'), $data)->json();

        $entity_list = isSuccess($entity_list) ? $entity_list['data']: [];

        return view('modules.audit_plan.calendar.entity_select', compact('entity_list'));

    }

    public function getRpuApottiItem(Request $request){

        $data =  Validator::make($request->all(), [
            'directorate_id' => 'required',
            'ministry_id' => 'required',
            'memo_type' => 'required',
            'entity_id' => 'nullable',
        ],[
            'directorate_id.required' => 'অধিদপ্তর বাছাই করুন',
            'ministry_id.required' => 'মন্ত্রণালয় বাছাই করুন',
            'memo_type.required' => 'ক্যাটাগরি বাছাই করুন',
        ])->validate();

        $apotti_item_list = $this->initRPUHttp()->post(config('cag_rpu_api.get-rpu-apotti-item'), $data)->json();

        $apotti_item_list = isSuccess($apotti_item_list) ? $apotti_item_list['data']: [];

        return view('modules.audit_followup.rpu_apotti.load_rpu_apotti_item', compact('apotti_item_list'));

    }

    public function getRpuApottiResponseForm(Request $request){

        $request = Validator::make($request->all(), [
            'directorate_id' => 'required',
            'apotti_item_id' => 'required',
            'apotti_title_bn' => 'string',
        ])->validate();

        return view('modules.audit_followup.rpu_apotti.rpu_apotti_response_form',$request);
    }

    public function rpuResponseSubmit(Request $request){
        $data =  Validator::make($request->all(), [
            'directorate_id' => 'required',
            'apotti_item_id' => 'required',
            'ministry_response' => 'nullable',
            'entity_response' => 'nullable',
            'unit_response' => 'nullable',
        ])->validate();

        $apotti_item_response = $this->initRPUHttp()->post(config('cag_rpu_api.apotti-response-submit'), $data)->json();

        if (isSuccess($apotti_item_response)) {
            return response()->json(['status' => 'success', 'data' => $apotti_item_response['data']]);
        } else {
            return response()->json(['status' => 'error', 'data' => $apotti_item_response]);
        }

    }

    public function rpuBroadSheetForm(Request $request)
    {
        $request = Validator::make($request->all(), [
            'directorate_id' => 'required',
            'apottis' => 'required',
        ])->validate();

        return view('modules.audit_followup.rpu_apotti.rpu_broad_sheet_form',$request);
    }

    public function rpuBroadSheetSubmit(Request $request){

        $data = Validator::make($request->all(), [
            'directorate_id' => 'required',
            'directorate_bn' => 'required',
            'directorate_en' => 'required',
            'ministry_id' => 'required',
            'ministry_en' => 'required',
            'ministry_bn' => 'required',
            'entity_id' => 'nullable',
            'entity_bn' => 'nullable',
            'entity_en' => 'nullable',
            'memorandum_no' => 'required',
            'memorandum_date' => 'required',
            'receiver_details' => 'nullable',
            'subject' => 'nullable',
            'details' => 'nullable',
            'cc_list' => 'nullable',
            'memo_type' => 'required',
            'sender_type' => 'required',
        ],[
            'memorandum_no.required' => 'স্মারক নং অবশ্যক',
            'memorandum_date.required' => 'স্মারক তারিখ অবশ্যক',
            'memo_type.required' => 'আপত্তি ক্যাটাগরি অবশ্যক',
        ])->validate();

        $data['apottis'] = explode(",",$request->apottis);
        $data['memorandum_date'] = date("y-m-d",strtotime($request->memorandum_date));

        $store_broad_sheet = $this->initRPUHttp()->post(config('cag_rpu_api.store-rpu-broad-sheet'), $data)->json();

        if(isSuccess($store_broad_sheet)){
            $response_data = $store_broad_sheet['data'];
            $send_to_directorate = $this->initHttpWithToken()->post(config('amms_bee_routes.rpu-apotti.send-apotti-reply'), $response_data)->json();
//            dd($send_to_directorate);
        }

        if (isSuccess($send_to_directorate)) {
            return response()->json(['status' => 'success', 'data' => $send_to_directorate['data']]);
        } else {
            return response()->json(['status' => 'error', 'data' => $send_to_directorate]);
        }

    }

}
