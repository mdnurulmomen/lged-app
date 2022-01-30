<?php

namespace App\Http\Controllers\AuditFollowup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
    public function getApottiItemList(Request $request){
        $data = Validator::make($request->all(), [
            'per_page' => 'required|integer',
            'page' => 'required|integer',
        ])->validate();
        $data['cdesk'] = $this->current_desk_json();
        $apottiItemList = $this->initHttpWithToken()->post(config('amms_bee_routes.follow_up.broadsheet_reply.get_apotti_item_list'), $data)->json();
        if (isSuccess($apottiItemList)) {
            $apottiItemList = $apottiItemList['data'];
            return view('modules.audit_followup.broadsheet_reply.partials.load_apotti_list',
                compact('apottiItemList'));
        } else {
            return response()->json(['status' => 'error', 'data' => $apottiItemList]);
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
