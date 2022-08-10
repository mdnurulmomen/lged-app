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
            'fiscal_year_id' => 'required',
        ],[
            'directorate_id.required' => 'অধিদপ্তর বাছাই করুন',
            'fiscal_year_id.required' => 'অর্থ বছর বাছাই করুন',
        ])->validate();

        $data['ministry_id'] = $request->ministry_id;
        $data['entity_id'] = $request->entity_id;
        $data['memo_type'] = $request->memo_type;
        $data['memo_title_bn'] = $request->memo_title_bn;

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

    public function rpuBroadSheetSubmit(Request $request)
    {
        $data = Validator::make($request->all(), [
            'directorate_id' => 'required',
            'directorate_bn' => 'required',
            'directorate_en' => 'required',
            'ministry_id' => 'required',
            'ministry_en' => 'required',
            'ministry_bn' => 'required',
            'entity_id' => 'required',
            'entity_bn' => 'required',
            'entity_en' => 'required',
            'memorandum_no' => 'required',
            'memorandum_date' => 'required',
            'receiver_details' => 'nullable',
            'subject' => 'nullable',
            'details' => 'nullable',
            'cc_list' => 'nullable',
            'memo_type' => 'required',
            'sender_type' => 'required',
            'broad_sheet_type' => 'required',
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
            $send_data = [
                ['name' => 'broadsheet_reply_id', 'contents' => $response_data["broadsheet_reply_id"]],
                ['name' => 'apottiItems', 'contents' => json_encode($response_data["apottiItems"])],
                ['name' => 'directorate_id', 'contents' => $response_data["directorate_id"]],
                ['name' => 'directorate_bn', 'contents' => $response_data["directorate_bn"]],
                ['name' => 'directorate_en', 'contents' => $response_data["directorate_en"]],
                ['name' => 'ministry_id', 'contents' => $response_data["ministry_id"]],
                ['name' => 'ministry_name_en', 'contents' => $response_data["ministry_name_en"]],
                ['name' => 'ministry_name_bn', 'contents' => $response_data["ministry_name_bn"]],
                ['name' => 'memorandum_no', 'contents' => $response_data["memorandum_no"]],
                ['name' => 'memorandum_date', 'contents' => $response_data["memorandum_date"]],
                ['name' => 'sender_office_id', 'contents' => $response_data["sender_office_id"]],
                ['name' => 'sender_office_name_bn', 'contents' => $response_data["sender_office_name_bn"]],
                ['name' => 'sender_office_name_en', 'contents' => $response_data["sender_office_name_en"]],
                ['name' => 'sender_name_bn', 'contents' => $response_data["sender_name_bn"]],
                ['name' => 'sender_name_en', 'contents' => $response_data["sender_name_en"]],
                ['name' => 'sender_designation_bn', 'contents' => $response_data["sender_designation_bn"]],
                ['name' => 'sender_designation_en', 'contents' => $response_data["sender_designation_en"]],
                ['name' => 'sender_type', 'contents' => $response_data["sender_type"]],
                ['name' => 'receiver_details', 'contents' => $response_data["receiver_details"]],
                ['name' => 'subject', 'contents' => $response_data["subject"]],
                ['name' => 'details', 'contents' => $response_data["details"]],
                ['name' => 'cc_list', 'contents' => $response_data["cc_list"]],
                ['name' => 'broad_sheet_type', 'contents' => $response_data["broad_sheet_type"]],
            ];

            //braod sheet hard copy
            if ($request->hasfile('broad_sheet_hard_copy')) {
                $file =  $request->file('broad_sheet_hard_copy');
                $send_data[] = [
                    'name' => 'broad_sheet_hard_copy',
                    'contents' => file_get_contents($file->getRealPath()),
                    'filename' => $file->getClientOriginalName(),
                ];
            }

            $response = $this->fileUPloadWithData(
                config('amms_bee_routes.rpu-apotti.send-apotti-reply'),
                $send_data
            );

//            dd($response);

            return json_decode($response->getBody(), true);
        }

    }

}
