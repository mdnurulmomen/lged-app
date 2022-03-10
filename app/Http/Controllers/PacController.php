<?php

namespace App\Http\Controllers;

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

//        dd($data);

        $data['cdesk'] = $this->current_desk_json();

        $pacMeetingList = $this->initHttpWithToken()->post(config('amms_bee_routes.pac.get-pac-meeting-list'), $data)->json();

//        dd($pacMeetingList);

        $desk_officer_id = $this->current_desk()['officer_id'];

        $desk_officer_grade = $this->current_desk()['officer_grade'];

        if (isSuccess($pacMeetingList)) {
            $apottiItemList = $pacMeetingList['data'];
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
        dd($request->all());
    }

    public function loadPacMemberList(Request $request){

        $pac_users = $this->initRPUHttp()->post(config('cag_rpu_api.get-user-list'), [
            'user_role_id' => $request->user_role_id
        ])->json();

        if (isSuccess($pac_users)) {
            $pac_users = $pac_users['data'];
//            dd($pac_users);
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

//        dd($report_list);

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

//        dd($data);

        $apotti_list = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_report.air.get_air_and_apotti_type_wise_qac_apotti'), $data)->json();
//        dd($apotti_list);
        if (isSuccess($apotti_list)) {
            $apotti_list = $apotti_list['data'];
            return view('modules.pac.partials.apotti_list',compact('apotti_list'));
        } else {
            return response()->json(['status' => 'error', 'data' => $apotti_list]);
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
}
