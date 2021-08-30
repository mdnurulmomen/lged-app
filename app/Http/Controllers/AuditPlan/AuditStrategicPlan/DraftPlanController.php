<?php

namespace App\Http\Controllers\AuditPlan\AuditStrategicPlan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DraftPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        return view('modules.audit_plan.strategic.draft_plan.strategic_plan_draft_lists');
    }

    public function fileList(){
        $response = $this->initHttpWithToken()->post(
            config('amms_bee_routes.audit_strategic_plan.sp_file_list'),[]
        )->json();
        $data['sp_file_list'] = $response['data'];
        return view('modules.audit_plan.strategic.draft_plan.sp_file_list',$data);
    }

    public function fileUpload(){
        return view('modules.audit_plan.strategic.draft_plan.sp_file_upload');
    }

    public function storeFile(Request $request){

        $attachment = $request->file;

        if ($request->hasfile('file')) {
                $data[] = [
                    'name'     => 'file',
                    'contents' => file_get_contents($attachment->getRealPath()),
                    'filename' => $attachment->getClientOriginalName(),
                ];
        }

        $response = $this->fileUPloadWithData(
            'POST',
            config('amms_bee_routes.audit_strategic_plan.sp_file_upload'),
            $data
        );

        return json_decode($response->getBody(), true);

        if (isset($response['status']) && $response['status'] == 'success') {
            return response()->json(responseFormat('success', 'Saved Successfully'));
        } else {
            return response()->json(['status' => 'error', 'data' => $response]);
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

    public function show(Request $request)
    {
        return view('modules.audit_plan.strategic.draft_plan.view_strategic_plan_draft');
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
