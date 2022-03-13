<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PacController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        return view('modules.pac.index');
    }

    public function pacMeeting(){

        return view('modules.pac.pac_meeting');

    }

    public function pacMeetingList(Request $request){

        $data = Validator::make($request->all(), [
            'per_page' => 'required|integer',
            'page' => 'required|integer',
        ])->validate();

        $data['cdesk'] = $this->current_desk_json();

        $pacMeetingList = $this->initHttpWithToken()->post(config('amms_bee_routes.pac.get-pac-meeting-list'), $data)->json();

        if (isSuccess($pacMeetingList)) {
            return view('modules.pac.partials.load_pac_meeting_list',compact('pacMeetingList'));
        } else {
            return response()->json(['status' => 'error', 'data' => $pacMeetingList]);
        }
    }

    public function pacMeetingCreate(){

        $offices = $this->cagDoptorOtherOffices(0);
        return view('modules.pac.pac_meeting_create',compact('offices'));
    }

    public function pacMeetingStore(Request $request){
        $data = Validator::make($request->all(), [
            'meeting_no' => 'required',
            'parliament_no' => 'required',
            'meeting_subject' => 'required',
            'meeting_place' => 'required',
            'meeting_date' => 'required',
            'final_report' => 'required',
            'directorate_id' => 'required',
            'directorate_bn' => 'required',
            'directorate_en' => 'required',
        ])->validate();

        $office_member_info = json_decode($request->office_member_info,true);
        $pac_member_info = json_decode($request->pac_member_info,true);
        $ministry_member_info = json_decode($request->ministry_member_info,true);
        $apottis = json_decode($request->apottis,true);
        $meeting_members = array_merge($office_member_info,$pac_member_info,$ministry_member_info);

        $data['apottis'] = $apottis;
        $data['meeting_members'] = $meeting_members;
        $data['meeting_date'] = Carbon::parse($request->meeting_date)->format('Y-m-d');
        $data['cdesk'] = $this->current_desk_json();

        $storeMeeting = $this->initHttpWithToken()->post(config('amms_bee_routes.pac.pac-meeting-store'), $data)->json();

        if (isSuccess($storeMeeting)) {
            return response()->json(['status' => 'success', 'data' => $storeMeeting['data']]);
        } else {
            return response()->json(['status' => 'error', 'data' => $storeMeeting]);
        }
    }

    public function pacMeetingShow(Request $request){

        $data = Validator::make($request->all(), [
            'pac_meeting_id' => 'required',
        ])->validate();

        $meetingInfo = $this->initHttpWithToken()->post(config('amms_bee_routes.pac.get-meeting-info'), $data)->json();

//        dd($meetingInfo);

        if (isSuccess($meetingInfo)) {
            return view('modules.pac.partials.show_pac_meeting',compact('meetingInfo'));
        } else {
            return response()->json(['status' => 'error', 'data' => $meetingInfo]);
        }
    }

    public function pacMeetingMinutes(Request $request){

        $data = Validator::make($request->all(), [
            'pac_meeting_id' => 'required',
        ])->validate();

        $meetingInfo = $this->initHttpWithToken()->post(config('amms_bee_routes.pac.get-meeting-info'), $data)->json();

//        dd($meetingInfo);

        if (isSuccess($meetingInfo)) {
            $meetingInfo = $meetingInfo['data'];
            return view('modules.pac.partials.pac_meeting_apotti_list',compact('meetingInfo'));
        } else {
            return response()->json(['status' => 'error', 'data' => $meetingInfo]);
        }
    }

    public function loadPacMemberList(Request $request){

        $pac_users = $this->initRPUHttp()->post(config('cag_rpu_api.get-user-list'), [
            'user_role_id' => $request->user_role_id
        ])->json();

        if (isSuccess($pac_users)) {
            $pac_users = $pac_users['data'];
            return view('modules.pac.partials.laod_pac_member_tree',compact('pac_users'));
        } else {
            return response()->json(['status' => 'error', 'data' => $pac_users]);
        }

    }

    public function loadOfficeMemberList(Request $request)
    {
        Validator::make($request->all(), ['office_id' => 'integer|required'])->validate();

        $office_id = $request->office_id ?: $this->current_office_id();

        $officer_lists = $this->cagDoptorOfficeUnitDesignationEmployees($office_id);

        $office_type = $request->office_type;

        return view('modules.pac.partials.load_office_member_tree', compact('officer_lists', 'office_type'));
    }

    public function loadPacFinalReport(Request $request){

        $data = Validator::make($request->all(), [
            'office_id' => 'required|integer',
        ])->validate();

        $data['is_printing_done'] = 1;

        $report_list = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_report.air.get_audit_final_report'), $data)->json();

        if (isSuccess($report_list)) {
            $report_list = $report_list['data'];
            return view('modules.pac.partials.final_report_select',compact('report_list'));
        } else {
            return response()->json(['status' => 'error', 'data' => $report_list]);
        }

    }


    public function airWiseApotti(Request $request){

        $data = Validator::make($request->all(), [
            'office_id' => 'required|integer',
            'air_id' => 'required|integer',
        ])->validate();

        $data['apotti_type'] = 'approved';
        $data['qac_type'] = 'cqat';

        $apotti_list = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_report.air.get_air_and_apotti_type_wise_qac_apotti'), $data)->json();

        if (isSuccess($apotti_list)) {
            $apotti_list = $apotti_list['data'];
            return view('modules.pac.partials.apotti_list',compact('apotti_list'));
        } else {
            return response()->json(['status' => 'error', 'data' => $apotti_list]);
        }
    }

    public function pacApottiDecisionForm(Request $request){
        $data = Validator::make($request->all(), [
            'apotti_id' => 'required|integer',
        ])->validate();

        return view('modules.pac.partials.pac_apotti_decision_form',$data);
    }

    public function pacApottiDecisionStore(Request $request){

        $data = Validator::make($request->all(), [
            'apotti_id' => 'required|integer',
            'pac_meeting_id' => 'required|integer',
            'apotti_status' => 'nullable',
            'final_report_id' => 'required|integer',
            'rp_report' => 'nullable',
            'cag_comment' => 'nullable',
            'decision_last_date' => 'nullable',
            'follower_office' => 'nullable',
        ])->validate();

        $data['decision_last_date'] = Carbon::parse($request->decision_last_date)->format('Y-m-d');
        $data['pac_decision'] = $request->pac_decision;
        $data['cdesk'] = $this->current_desk_json();

//        dd($data);

        $apotti_decision_store = $this->initHttpWithToken()->post(config('amms_bee_routes.pac.pac-meeting-decision-store'), $data)->json();

        if (isSuccess($apotti_decision_store)) {
            return response()->json(['status' => 'success', 'data' => $apotti_decision_store['data']]);
        } else {
            return response()->json(['status' => 'error', 'data' => $apotti_decision_store]);
        }
    }

    public function sentToPac(Request $request){

        $data = Validator::make($request->all(), [
            'pac_meeting_id' => 'required|integer',
        ])->validate();

        $data['cdesk'] = $this->current_desk_json();

        $sent_to_pac = $this->initHttpWithToken()->post(config('amms_bee_routes.pac.sent-to-pac'), $data)->json();
//        dd($apotti_decision_store);
        if (isSuccess($sent_to_pac)) {
            return response()->json(['status' => 'success', 'data' => $sent_to_pac['data']]);
        } else {
            return response()->json(['status' => 'error', 'data' => $sent_to_pac]);
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function pacMeetingReportCreate(Request $request)
    {
        $data['template_type'] = 'pac_report';
        $data['cdesk'] = $this->current_desk_json();
        $responseData = $this->initHttpWithToken()->post(config('amms_bee_routes.pac.create-pac-report'), $data)->json();
        if (isSuccess($responseData)) {
            $content = $responseData['data']['content'];
            return view('modules.pac.partials.load_pac_report_create',compact('content'));
        }
        else {
            return ['status' => 'error', 'data' => $responseData['data']];
        }
    }
}
