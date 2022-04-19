<?php

namespace App\Http\Controllers\AuditFollowup;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class BroadsheetReplyController extends Controller
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

//        dd($directorates);
        return view('modules.audit_followup.broadsheet_reply.index',compact('directorates'));
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


    //for apotti list
    public function getBroadSheetList(Request $request){
        $data = Validator::make($request->all(), [
            'per_page' => 'required|integer',
            'office_id' => 'required|integer',
            'page' => 'required|integer',
        ])->validate();

        $data['cdesk'] = $this->current_desk_json();

        $apottiItemList = $this->initHttpWithToken()->post(config('amms_bee_routes.follow_up.broadsheet_reply.get_broad_sheet_list'), $data)->json();

        $desk_officer_id = $this->current_desk()['officer_id'];

        $desk_officer_grade = $this->current_desk()['officer_grade'];

        if (isSuccess($apottiItemList)) {
            $apottiItemList = $apottiItemList['data'];
            $office_id = $request->office_id;
            return view('modules.audit_followup.broadsheet_reply.partials.load_apotti_list',
                compact('apottiItemList','desk_officer_id','desk_officer_grade','office_id'));
        } else {
            return response()->json(['status' => 'error', 'data' => $apottiItemList]);
        }
    }

    public function getBroadSheetItem(Request $request){

        $data = Validator::make($request->all(), [
            'broad_sheet_id' => 'required|integer',
            'office_id' => 'required|integer',
        ])->validate();

        $data['cdesk'] = $this->current_desk_json();

        $desk_officer_grade = $this->current_desk()['officer_grade'];

        $broadSheetInfo = $this->initHttpWithToken()->post(config('amms_bee_routes.follow_up.broadsheet_reply.get_broad_sheet_info'), $data)->json();
        $broadSheetItem = $this->initHttpWithToken()->post(config('amms_bee_routes.follow_up.broadsheet_reply.get_broad_sheet_items'), $data)->json();

        // dd($broadSheetInfo);

        if (isSuccess($broadSheetItem)) {
            $broadSheetInfo = $broadSheetInfo['data'];
            $broadSheetItem = $broadSheetItem['data'];
            $office_id = $request->office_id;
            return view('modules.audit_followup.broadsheet_reply.partials.broad_sheet_item',
                compact('broadSheetItem','broadSheetInfo','desk_officer_grade','office_id'));
        } else {
            return response()->json(['status' => 'error', 'data' => $broadSheetItem]);
        }
    }

    public function getApottiDecisionForm(Request $request){

        $data = Validator::make($request->all(), [
            'broad_sheet_id' => 'required|integer',
            'broad_sheet_type' => 'required',
            'apotti_item_id' => 'required|integer',
            'memo_id' => 'required|integer',
            'jorito_ortho' => 'nullable',
            'office_id' => 'nullable',
        ])->validate();

        $data['cdesk'] = $this->current_desk_json();

        $responseData = $this->initHttpWithToken()->post(config('amms_bee_routes.follow_up.broadsheet_reply.get_broad_sheet_item_info'), $data)->json();

        $apotti_item_info = isSuccess($responseData) ? $responseData['data'] : [];

        $data['apotti_item_info'] = $apotti_item_info;

        return view('modules.audit_followup.broadsheet_reply.partials.apotti_decision_form', $data);
    }

    public function getApottiDecisionSubmit(Request $request){
        try {
            $data = Validator::make($request->all(), [
                'broad_sheet_id' => 'required|integer',
                'office_id' => 'required|integer',
                'apotti_item_id' => 'required|integer',
                'memo_id' => 'required|integer',
                'jorito_ortho' => 'nullable',
                'collected_amount' => 'nullable',
                'adjusted_amount' => 'nullable',
                'apotti_status' => 'nullable',
                'comment' => 'nullable',
                'cag_comment' => 'nullable',
            ])->validate();

            $data['cdesk'] = $this->current_desk_json();

            $broadSheetItemUpdate = $this->initHttpWithToken()->post(config('amms_bee_routes.follow_up.broadsheet_reply.update_broad_sheet_item'), $data)->json();

//            dd($broadSheetItemUpdate);

            if (isSuccess($broadSheetItemUpdate)) {
                return response()->json(['status' => 'success', 'data' => $broadSheetItemUpdate['data']]);
            } else {
                return response()->json(['status' => 'error', 'data' => $broadSheetItemUpdate['data']]);
            }

        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'data' => $exception->getMessage()]);
        }

    }

    public function approveBroadSheetApotti(Request $request){
        try {
            $data = Validator::make($request->all(), [
                'broad_sheet_id' => 'required|integer',
                'apotti_item_id' => 'required|integer',
                'memo_id' => 'required|integer',
            ])->validate();

            $data['cdesk'] = $this->current_desk_json();

            $broadSheetItemUpdate = $this->initHttpWithToken()->post(config('amms_bee_routes.follow_up.broadsheet_reply.update_broad_sheet_item'), $data)->json();

            $data['approval_status'] = 'approved';

            $broadSheetItemApproved = $this->initHttpWithToken()->post(config('amms_bee_routes.follow_up.broadsheet_reply.approve_broad_sheet_item'), $data)->json();

            if (isSuccess($broadSheetItemApproved)) {
                return response()->json(['status' => 'success', 'data' => $broadSheetItemApproved['data']]);
            } else {
                return response()->json(['status' => 'error', 'data' => $broadSheetItemApproved['data']]);
            }

        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'data' => $exception->getMessage()]);
        }
    }

    public function showBroadSheet(Request $request){
        $scope = $request->scope;
        $data = Validator::make($request->all(), [
            'broad_sheet_id' => 'required|integer',
        ])->validate();

        $data['cdesk'] = $this->current_desk_json();

        $broadSheetinfo = $this->initHttpWithToken()->post(config('amms_bee_routes.follow_up.broadsheet_reply.get_broad_sheet_info'), $data)->json();

        $broadSheetItem = $this->initHttpWithToken()->post(config('amms_bee_routes.follow_up.broadsheet_reply.get_broad_sheet_items'), $data)->json();

        if (isSuccess($broadSheetItem)) {
            $broadSheetItem = $broadSheetItem['data'];
            $broadSheetinfo = $broadSheetinfo['data'];

            if($request->scope == 'pdf'){
                $pdf = \PDF::loadView('modules.audit_followup.broadsheet_reply.partials.single_broadsheet_book',
                    ['scope' => $scope, 'broadSheetItem'=> $broadSheetItem, 'broadSheetinfo' => $broadSheetinfo], [] , ['orientation' => 'P', 'format' => 'A4']);

                $fileName = 'broadsheet_'.$broadSheetinfo['sender_office_name_bn'].'_'. date('D_M_j_Y') . '.pdf';
                return $pdf->stream($fileName);
            }else{
                return view('modules.audit_followup.broadsheet_reply.partials.single_broadsheet_book',
                    compact('broadSheetItem','broadSheetinfo','scope'));
            }

        } else {
            return response()->json(['status' => 'error', 'data' => $broadSheetItem]);
        }
    }

    public function getBroadSheetApprovalAuthority(Request $request)
    {
        $data['broad_sheet_id'] = $request->broad_sheet_id;
        $data['cdesk'] = $this->current_desk_json();
        $office_id = $this->current_office_id();
        $responseData = $this->initHttpWithToken()->post(config('amms_bee_routes.follow_up.broadsheet_reply.broad_sheet_last_movement'), $data)->json();
        $last_air_movement = isSuccess($responseData) ? $responseData['data'] : [];

        $officer_lists = $this->initDoptorHttp()->post(config('cag_doptor_api.office_unit_designation_employee_map'),
            [
                'office_id' => $office_id,
                'designation_grade' => 6,
            ]
        )->json();

        $officer_lists = $officer_lists['status'] == 'success' ? $officer_lists['data'] : [];
        $broad_sheet_id = $request->broad_sheet_id;
        return view('modules.audit_followup.broadsheet_reply.partials.broadsheet_approval_authority', compact('officer_lists',  'broad_sheet_id','last_air_movement'));
    }

    public function broadSheetMovement(Request $request)
    {
        try {
            $data = Validator::make($request->all(), [
                'broad_sheet_id' => 'required|integer',
                'receiver_officer_id' => 'required|integer',
                'receiver_office_id' => 'required|integer',
                'receiver_unit_id' => 'required|integer',
                'receiver_unit_name_en' => 'required',
                'receiver_unit_name_bn' => 'required',
                'receiver_employee_id' => 'required|integer',
                'receiver_employee_name_en' => 'required',
                'receiver_employee_name_bn' => 'required',
                'receiver_employee_designation_id' => 'required|integer',
                'receiver_employee_designation_en' => 'required',
                'receiver_employee_designation_bn' => 'required',
                'receiver_officer_phone' => 'required',
                'receiver_officer_email' => 'required',
            ], [
                'broad_sheet_id.required' => 'AIR id is required',
                'receiver_officer_id.required' => 'You have to choose receiver',
                'receiver_office_id.required' => 'You have to choose receiver',
            ])->validate();

            $data['comments'] = $request->comments;
            $data['cdesk'] = $this->current_desk_json();

            $responseData = $this->initHttpWithToken()->post(config('amms_bee_routes.follow_up.broadsheet_reply.broad_sheet_movement'), $data)->json();

            if (isSuccess($responseData)) {
                return response()->json(['status' => 'success', 'data' => 'সফলভাবে প্রেরণ করা হয়েছে']);
            } else {
                return response()->json(['status' => 'error', 'data' => $responseData]);
            }
        } catch (ValidationException $exception) {
            return response()->json([
                'status' => 'error',
                'msg' => $exception->errors(),
                'statusCode' => '422',
            ]);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'data' => $exception->getMessage()]);
        }

    }

    public function sendBroadSheetReplyFrom(Request $request){
        $data = Validator::make($request->all(), [
            'broad_sheet_id' => 'required|integer',
            'memorandum_no' => 'required',
        ])->validate();

        return view('modules.audit_followup.broadsheet_reply.partials.rpu_braod_sheet_reply_form', $data);
    }

    public function storeBroadSheetReply(Request $request){

        $data = Validator::make($request->all(), [
            'broad_sheet_id' => 'required|integer',
            'ref_memorandum_no' => 'required',
            'memorandum_no' => 'required',
            'memorandum_date' => 'required',
            'rpu_office_head_details' => 'required',
            'subject' => 'required',
            'description' => 'required',
            'braod_sheet_cc' => 'nullable',
        ])->validate();

//        $data['memorandum_date'] = Carbon::parse($request->memorandum_date)->format('Y-m-d');
        $data['memorandum_date'] = date('Y-m-d',strtotime($request->memorandum_date));

//        dd($data);

        $data['cdesk'] = $this->current_desk_json();

        $responseData = $this->initHttpWithToken()->post(config('amms_bee_routes.follow_up.broadsheet_reply.store_broad_sheet_reply'), $data)->json();

        if (isSuccess($responseData)) {
            return response()->json(['status' => 'success', 'data' => $responseData['data']]);
        } else {
            return response()->json(['status' => 'error', 'data' => $responseData['data']]);
        }
    }

    public function sendBroadSheetReplyToRpu(Request $request){

        $data = Validator::make($request->all(), [
            'broad_sheet_id' => 'required|integer',
        ])->validate();

        $data['cdesk'] = $this->current_desk_json();

        $responseData = $this->initHttpWithToken()->post(config('amms_bee_routes.follow_up.broadsheet_reply.send_broad_sheet_reply_to_rpu'), $data)->json();
//        dd($responseData);
        if (isSuccess($responseData)) {
            return response()->json(['status' => 'success', 'data' => $responseData['data']]);
        } else {
            return response()->json(['status' => 'error', 'data' => $responseData['data']]);
        }
    }


    public function downloadSingleBroadsheet(Request $request){
        $requestData = [
            'cdesk' => $this->current_desk_json(),
            'apotti_item_id' => $request->apotti_item_id,
        ];

        $currentOfficeName = $this->current_office()['office_name_bn'];
        $apottiItemInfo = $this->initHttpWithToken()->post(config('amms_bee_routes.follow_up.broadsheet_reply.get_apotti_item_info'), $requestData)->json();
        $apottiItemInfo = isSuccess($apottiItemInfo)?$apottiItemInfo['data']:[];

        $pdf = \PDF::loadView('modules.audit_followup.broadsheet_reply.partials.single_broadsheet_book',
            ['currentOfficeName'=> $currentOfficeName, 'apottiItemInfo' => $apottiItemInfo], [] , ['orientation' => 'L', 'format' => 'A4']);

        $fileName = 'broadsheet_'.$request->cost_center_name_en.'_'. date('D_M_j_Y') . '.pdf';
        return $pdf->stream($fileName);
    }

    public function editApottiItem(Request $request){
        $requestData = [
            'cdesk' => $this->current_desk_json(),
            'apotti_item_id' => $request->apotti_item_id,
        ];
        $apottiItemInfo = $this->initHttpWithToken()->post(config('amms_bee_routes.follow_up.broadsheet_reply.get_apotti_item_info'), $requestData)->json();
        $apottiItemInfo = isSuccess($apottiItemInfo)?$apottiItemInfo['data']:[];

        if ($request->scope == 'jobab'){
            return view('modules.audit_followup.broadsheet_reply.partials.load_apotti_jobab',compact('apottiItemInfo'));
        }elseif ($request->scope == 'response'){
            return view('modules.audit_followup.broadsheet_reply.partials.edit_apotti_item',compact('apottiItemInfo'));
        }
        return view('modules.audit_followup.broadsheet_reply.partials.reply_apotti_item',compact('apottiItemInfo'));
    }

    public function showSentBroadSheetReply(Request $request){

        $data = Validator::make($request->all(), [
            'broad_sheet_id' => 'required|integer',
        ])->validate();

        $scope = $request->scope;

        $data['cdesk'] = $this->current_desk_json();

        $office_name_bn =  $this->current_office()['office_name_bn'];

        $broadSheetinfo = $this->initHttpWithToken()->post(config('amms_bee_routes.follow_up.broadsheet_reply.get_sent_broad_sheet_info'), $data)->json();

        $broadSheetItem = $this->initHttpWithToken()->post(config('amms_bee_routes.follow_up.broadsheet_reply.get_broad_sheet_items'), $data)->json();

//        dd($broadSheetItem);

        if (isSuccess($broadSheetItem)) {
            $broadSheetItem = $broadSheetItem['data'];
            $broadSheetinfo = $broadSheetinfo['data'];

            if($request->scope == 'download'){
                $pdf = \PDF::loadView('modules.audit_followup.broadsheet_reply.partials.sent_broadsheet_book',
                    ['scope' => $scope,'broadSheetItem'=> $broadSheetItem, 'broadSheetinfo' => $broadSheetinfo], [] , ['orientation' => 'P', 'format' => 'A4']);

                $fileName = 'broadsheet_'.$office_name_bn.'_'. date('D_M_j_Y') . '.pdf';
                return $pdf->stream($fileName);
            }else{
                return view('modules.audit_followup.broadsheet_reply.partials.sent_broadsheet_book',
                    compact('broadSheetItem','broadSheetinfo','office_name_bn','scope'));
            }

        } else {
            return response()->json(['status' => 'error', 'data' => $broadSheetItem]);
        }
    }

}
