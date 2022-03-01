<?php

namespace App\Http\Controllers\AuditFollowup;

use App\Http\Controllers\Controller;
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
        return view('modules.audit_followup.broadsheet_reply.index');
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
            'page' => 'required|integer',
        ])->validate();
        $data['cdesk'] = $this->current_desk_json();
        $apottiItemList = $this->initHttpWithToken()->post(config('amms_bee_routes.follow_up.broadsheet_reply.get_broad_sheet_list'), $data)->json();
//        dd($apottiItemList);
        if (isSuccess($apottiItemList)) {
            $apottiItemList = $apottiItemList['data'];
//            dd($apottiItemList);
            return view('modules.audit_followup.broadsheet_reply.partials.load_apotti_list',
                compact('apottiItemList'));
        } else {
            return response()->json(['status' => 'error', 'data' => $apottiItemList]);
        }
    }

    public function getBroadSheetItem(Request $request){

        $data = Validator::make($request->all(), [
            'broad_sheet_id' => 'required|integer',
        ])->validate();

        $data['cdesk'] = $this->current_desk_json();

        $broadSheetItem = $this->initHttpWithToken()->post(config('amms_bee_routes.follow_up.broadsheet_reply.get_broad_sheet_item'), $data)->json();
//        dd($broadSheetItem);
        if (isSuccess($broadSheetItem)) {
            $broadSheetItem = $broadSheetItem['data'];
            $memorandum_no = $request->memorandum_no;
            $memorandum_date = $request->memorandum_date;
            $entity_name = $request->entity_name;
            return view('modules.audit_followup.broadsheet_reply.partials.broad_sheet_item',
                compact('broadSheetItem','memorandum_no','memorandum_date','entity_name'));
        } else {
            return response()->json(['status' => 'error', 'data' => $broadSheetItem]);
        }
    }

    public function getApottiDecisionForm(Request $request){

        $data = Validator::make($request->all(), [
            'broad_sheet_id' => 'required|integer',
            'apotti_item_id' => 'required|integer',
            'memo_id' => 'required|integer',
            'jorito_ortho' => 'nullable',
        ])->validate();

        return view('modules.audit_followup.broadsheet_reply.partials.apotti_decision_form',$data);
    }

    public function getApottiDecisionSubmit(Request $request){

        $data = Validator::make($request->all(), [
            'broad_sheet_id' => 'required|integer',
            'apotti_item_id' => 'required|integer',
            'memo_id' => 'required|integer',
            'jorito_ortho' => 'nullable',
            'collected_amount' => 'nullable',
            'adjusted_amount' => 'nullable',
            'apotti_status' => 'nullable',
            'apotti_comment' => 'nullable',
        ])->validate();

//        dd($data);

        $data['cdesk'] = $this->current_desk_json();

        $broadSheetItemUpdate = $this->initHttpWithToken()->post(config('amms_bee_routes.follow_up.broadsheet_reply.update_broad_sheet_item'), $data)->json();

        //        dd($apottiItemList);
        if (isSuccess($broadSheetItemUpdate)) {
            return response()->json(['status' => 'success', 'data' => $broadSheetItemUpdate]);
        } else {
            return response()->json(['status' => 'error', 'data' => $broadSheetItemUpdate]);
        }

    }

    public function showBroadSheet(Request $request){

        $data = Validator::make($request->all(), [
            'broad_sheet_id' => 'required|integer',
        ])->validate();

        $data['cdesk'] = $this->current_desk_json();

        $broadSheetItem = $this->initHttpWithToken()->post(config('amms_bee_routes.follow_up.broadsheet_reply.get_broad_sheet_item'), $data)->json();
//        dd($apottiItemList);
        if (isSuccess($broadSheetItem)) {
            $broadSheetItem = $broadSheetItem['data'];
            $memorandum_no = $request->memorandum_no;
            $memorandum_date = $request->memorandum_date;
//            dd($apottiItemList);
            return view('modules.audit_followup.broadsheet_reply.partials.single_broadsheet_book',
                compact('broadSheetItem','memorandum_no','memorandum_date'));
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
//        dd($last_air_movement);
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
//        dd($request->all());
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


    public function downloadSingleBroadsheet(Request $request){
        $requestData = [
            'cdesk' => $this->current_desk_json(),
            'apotti_item_id' => $request->apotti_item_id,
        ];

        $currentOfficeName = $this->current_office()['office_name_bn'];
        $apottiItemInfo = $this->initHttpWithToken()->post(config('amms_bee_routes.follow_up.broadsheet_reply.get_apotti_item_info'), $requestData)->json();
        $apottiItemInfo = isSuccess($apottiItemInfo)?$apottiItemInfo['data']:[];
        //dd($apottiItemInfo);
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
}
