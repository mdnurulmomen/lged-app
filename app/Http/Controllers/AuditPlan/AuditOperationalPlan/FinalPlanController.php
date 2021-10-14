<?php

namespace App\Http\Controllers\AuditPlan\AuditOperationalPlan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FinalPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $response = $this->initHttpWithToken()->post(config('amms_bee_routes.final_plan_file.list'),[
                'document_type' => 'operation'
            ]
        )->json();
        $data['final_plan_file_list'] = $response['data'];
        //dd($response);
        return view('modules.audit_plan.operational.final_plan.index',$data);

        //return view('modules.audit_plan.strategic.final_plan.strategic_plan_final_lists');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $plan_durations = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.fiscal_year_lists'), [
            'all' => 1
        ])->json();
        if ($plan_durations['status'] == 'success') {
            $data['plan_durations'] = $plan_durations['data'];
        } else {
            $data['plan_durations'] = [];
        }

        return view('modules.audit_plan.operational.final_plan.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'fiscal_year' => 'required',
            'file' => 'required|mimes:pdf|max:10420',
        ])->validate();

        $data = [
            ['name' => 'id', 'contents' => $request->id],
            ['name' => 'document_type', 'contents' => 'operation'],
            ['name' => 'fiscal_year', 'contents' => $request->fiscal_year]
        ];

        $attachment = $request->file;
        if ($request->hasfile('file')) {
            $data[] = [
                'name'     => 'file',
                'contents' => file_get_contents($attachment->getRealPath()),
                'filename' => $attachment->getClientOriginalName(),
            ];
        }

        if (empty($request->id)){
            $response = $this->fileUPloadWithData(
                'POST',
                config('amms_bee_routes.final_plan_file.store'),
                $data
            );

        }
        else{
            $response = $this->fileUPloadWithData(
                'POST',
                config('amms_bee_routes.final_plan_file.update'),
                $data
            );
        }

        return json_decode($response->getBody(), true);



        /*if (isset($response['status']) && $response['status'] == 'success') {
            return response()->json(responseFormat('success', 'Saved Successfully'));
        } else {
            return response()->json(['status' => 'error', 'data' => $response]);
        }*/
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(Request $request)
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
        $plan_durations = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.fiscal_year_lists'), [
            'all' => 1
        ])->json();
        if ($plan_durations['status'] == 'success') {
            $data['plan_durations'] = $plan_durations['data'];
        } else {
            $data['plan_durations'] = [];
        }

        $file_info = $this->initHttpWithToken()->post(config('amms_bee_routes.final_plan_file.edit'), [
            'id' => $id
        ])->json();
        if ($file_info['status'] == 'success') {
            $data['file_info'] = $file_info['data'];
        } else {
            $data['file_info'] = [];
        }

        return view('modules.audit_plan.operational.final_plan.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        Validator::make($request->all(), [
            'id' => 'required|numeric',
            'fiscal_year' => 'required',
            'file' => 'required|mimes:pdf|max:10420',
        ])->validate();

        $data = [
            ['name' => 'id', 'contents' => $request->id],
            ['name' => 'document_type', 'contents' => 'operation'],
            ['name' => 'fiscal_year', 'contents' => $request->fiscal_year]
        ];

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
            config('amms_bee_routes.final_plan_file.update'),
            $data
        );
        return json_decode($response->getBody(), true);
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

    public function isDocumentExist(Request $request)
    {
        $responseData = $this->initHttpWithToken()->post(config('amms_bee_routes.document_is_exist'), [
            'document_type' => 'operation',
            'fiscal_year' => $request->fiscal_year,
        ])->json();

        if ($responseData['status'] == 'success') {
            return response()->json(['status' => 'success', 'data' => $responseData['data']]);
        } else {
            return response()->json(['status' => 'error', 'data' => 'Server Error']);
        }
    }
}
