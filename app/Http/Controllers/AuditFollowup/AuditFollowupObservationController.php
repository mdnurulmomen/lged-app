<?php

namespace App\Http\Controllers\AuditFollowup;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AuditFollowupObservationController extends Controller
{
    public function lists()
    {
        $observations = $this->initHttpWithToken()->post(config('amms_bee_routes.follow_up.audit_observations'), [])->json();
        $fiscal_years = $this->allFiscalYears();
        return view('modules.audit_followup.observation.observation_list', compact(
            'observations',
            'fiscal_years'
        ));
    }

    public function search(Request $request)
    {
        $observations = $this->initHttpWithToken()->post(
            config('amms_bee_routes.follow_up.audit_observation_search'),
            $request->all()
        )->json();

        return view('modules.audit_followup.observation.search', compact(
            'observations'
        ));
    }

    public function getAuditPlan(Request $request)
    {
        $data = [
            'office_id' => $this->current_office_id(),
            'rp_office_id' => $request->rp_office_id,
            'fiscal_year_id' => $request->fiscal_year_id
        ];
        $plans = $this->initHttpWithToken()->post(
            config('amms_bee_routes.follow_up.audit_observation_get_audit_plan'),
            $data
        )->json();

        $data = [];
        if (count($plans['data']) > 0) {
            foreach ($plans['data'] as $key => $plan) {
                $data[] = [
                    'data' => getDecryptedData($plan['plan_description']),
                    'id' => $plan['id']
                ];
            }
        }
        return $data;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('modules.audit_followup.observation.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fiscal_years = $this->allFiscalYears();
        return view('modules.audit_followup.observation.create_observation', compact(
            'fiscal_years'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'ministry_id' => 'required|numeric',
            'division_id' => 'required|numeric',
            'parent_office_id' => 'required|numeric',
            'rp_office_id' => 'required|numeric',
            'directorate_id' => 'required|numeric',
            'team_leader_id' => 'required|numeric',
            'observation_en' => 'required_without:observation_bn',
            'observation_bn' => 'required_without:observation_en',
            'observation_type' => 'required',
            'amount' => 'required',
            'initiation_date' => 'required',
            'fiscal_year_id' => 'required|numeric',
            'cover_page.*' => 'nullable|mimes:jpeg,jpg,png,gif,pdf,doc,docx|max:10420',
            'main_attachments.*' => 'nullable|mimes:jpeg,jpg,png,gif,pdf,doc,docx|max:10420',
            'appendix_attachments.*' => 'nullable|mimes:jpeg,jpg,png,gif,pdf,doc,docx|max:10420',
            'authentic_attachments.*' => 'nullable|mimes:jpeg,jpg,png,gif,pdf,doc,docx|max:10420',
            'other_attachments.*' => 'nullable|mimes:jpeg,jpg,png,gif,pdf,doc,docx|max:10420',
        ])->validate();

        $data = [
            ['name' => 'audit_id', 'contents' => $request->audit_id],
            ['name' => 'ministry_id', 'contents' => $request->ministry_id],
            ['name' => 'division_id', 'contents' => $request->division_id],
            ['name' => 'parent_office_id', 'contents' => $request->parent_office_id],
            ['name' => 'rp_office_id', 'contents' => $request->rp_office_id],
            ['name' => 'directorate_id', 'contents' => $this->current_office_id()],
            ['name' => 'team_leader_id', 'contents' => $request->team_leader_id],
            ['name' => 'observation_en', 'contents' => $request->observation_en],
            ['name' => 'observation_bn', 'contents' => $request->observation_bn],
            ['name' => 'observation_details', 'contents' => $request->observation_details],
            ['name' => 'observation_type', 'contents' => $request->observation_type],
            ['name' => 'amount', 'contents' => $request->amount],
            ['name' => 'initiation_date', 'contents' => $request->initiation_date],
            ['name' => 'fiscal_year_id', 'contents' => $request->fiscal_year_id],
            ['name' => 'status', 'contents' => $request->status],
        ];

        if ($request->hasfile('cover_page')) {
            foreach ($request->file('cover_page') as $attachment) {
                $data[] = [
                    'name'     => 'cover_page',
                    'contents' => file_get_contents($attachment->getRealPath()),
                    'filename' => $attachment->getClientOriginalName(),
                ];
            }
        }

        if ($request->hasfile('main_attachments')) {
            foreach ($request->file('main_attachments') as $attachment) {
                $data[] = [
                    'name'     => 'main_attachments[]',
                    'contents' => file_get_contents($attachment->getRealPath()),
                    'filename' => $attachment->getClientOriginalName(),
                ];
            }
        }

        if ($request->hasfile('appendix_attachments')) {
            foreach ($request->file('appendix_attachments') as $attachment) {
                $data[] = [
                    'name'     => 'appendix_attachments[]',
                    'contents' => file_get_contents($attachment->getRealPath()),
                    'filename' => $attachment->getClientOriginalName(),
                ];
            }
        }

        if ($request->hasfile('authentic_attachments')) {
            foreach ($request->file('authentic_attachments') as $attachment) {
                $data[] = [
                    'name'     => 'authentic_attachments[]',
                    'contents' => file_get_contents($attachment->getRealPath()),
                    'filename' => $attachment->getClientOriginalName(),
                ];
            }
        }

        if ($request->hasfile('other_attachments')) {
            foreach ($request->file('other_attachments') as $attachment) {
                $data[] = [
                    'name'     => 'other_attachments[]',
                    'contents' => file_get_contents($attachment->getRealPath()),
                    'filename' => $attachment->getClientOriginalName(),
                ];
            }
        }

        $response = $this->fileUPloadWithData(
            'POST',
            config('amms_bee_routes.follow_up.audit_observation_create'),
            $data
        );

        $response = json_decode($response->getBody(), true);
        if (isset($response['status']) && $response['status'] == 'success') {
            return response()->json(responseFormat('success', 'Saved Successfully'));
        } else {
            return response()->json(['status' => 'error', 'data' => $response]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $data = $this->initHttpWithToken()->post(
            config('amms_bee_routes.follow_up.audit_observation_show'),
            ['id' => $id]
        )->json();

        $data = $data['data'];

        return view('modules.audit_followup.observation.view_observation', compact(
            'data'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $fiscal_years = $this->allFiscalYears();
        $data = $this->initHttpWithToken()->post(
            config('amms_bee_routes.follow_up.audit_observation_show'),
            ['id' => $id]
        )->json();

        $data = $data['data'];

        return view('modules.audit_followup.observation.edit_observation', compact('fiscal_years', 'data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        Validator::make($request->all(), [
            'id' => 'required|numeric',
            'ministry_id' => 'required|numeric',
            'division_id' => 'required|numeric',
            'parent_office_id' => 'required|numeric',
            'rp_office_id' => 'required|numeric',
            'directorate_id' => 'required|numeric',
            'team_leader_id' => 'required|numeric',
            'observation_en' => 'required_without:observation_bn',
            'observation_bn' => 'required_without:observation_en',
            'observation_type' => 'required',
            'amount' => 'required',
            'initiation_date' => 'required',
            'fiscal_year_id' => 'required|numeric',
            'cover_page.*' => 'nullable|mimes:jpeg,jpg,png,gif,pdf,doc,docx|max:10420',
            'main_attachments.*' => 'nullable|mimes:jpeg,jpg,png,gif,pdf,doc,docx|max:10420',
            'appendix_attachments.*' => 'nullable|mimes:jpeg,jpg,png,gif,pdf,doc,docx|max:10420',
            'authentic_attachments.*' => 'nullable|mimes:jpeg,jpg,png,gif,pdf,doc,docx|max:10420',
            'other_attachments.*' => 'nullable|mimes:jpeg,jpg,png,gif,pdf,doc,docx|max:10420',
        ])->validate();

        $data = [
            ['name' => 'id', 'contents' => $request->id],
            ['name' => 'ministry_id', 'contents' => $request->ministry_id],
            ['name' => 'division_id', 'contents' => $request->division_id],
            ['name' => 'parent_office_id', 'contents' => $request->parent_office_id],
            ['name' => 'rp_office_id', 'contents' => $request->rp_office_id],
            ['name' => 'directorate_id', 'contents' => $request->directorate_id],
            ['name' => 'team_leader_id', 'contents' => $request->team_leader_id],
            ['name' => 'observation_en', 'contents' => $request->observation_en],
            ['name' => 'observation_bn', 'contents' => $request->observation_bn],
            ['name' => 'observation_details', 'contents' => $request->observation_details],
            ['name' => 'observation_type', 'contents' => $request->observation_type],
            ['name' => 'amount', 'contents' => $request->amount],
            ['name' => 'initiation_date', 'contents' => $request->initiation_date],
            ['name' => 'fiscal_year_id', 'contents' => $request->fiscal_year_id],
            ['name' => 'status', 'contents' => $request->status]
        ];


        if ($request->hasfile('cover_page')) {
            foreach ($request->file('cover_page') as $attachment) {
                $data[] = [
                    'name'     => 'cover_page',
                    'contents' => file_get_contents($attachment->getRealPath()),
                    'filename' => $attachment->getClientOriginalName(),
                ];
            }
        }

        if ($request->hasfile('main_attachments')) {
            foreach ($request->file('main_attachments') as $attachment) {
                $data[] = [
                    'name'     => 'main_attachments[]',
                    'contents' => file_get_contents($attachment->getRealPath()),
                    'filename' => $attachment->getClientOriginalName(),
                ];
            }
        }

        if ($request->hasfile('appendix_attachments')) {
            foreach ($request->file('appendix_attachments') as $attachment) {
                $data[] = [
                    'name'     => 'appendix_attachments[]',
                    'contents' => file_get_contents($attachment->getRealPath()),
                    'filename' => $attachment->getClientOriginalName(),
                ];
            }
        }

        if ($request->hasfile('authentic_attachments')) {
            foreach ($request->file('authentic_attachments') as $attachment) {
                $data[] = [
                    'name'     => 'authentic_attachments[]',
                    'contents' => file_get_contents($attachment->getRealPath()),
                    'filename' => $attachment->getClientOriginalName(),
                ];
            }
        }

        if ($request->hasfile('other_attachments')) {
            foreach ($request->file('other_attachments') as $attachment) {
                $data[] = [
                    'name'     => 'other_attachments[]',
                    'contents' => file_get_contents($attachment->getRealPath()),
                    'filename' => $attachment->getClientOriginalName(),
                ];
            }
        }

        $response = $this->fileUPloadWithData(
            'POST',
            config('amms_bee_routes.follow_up.audit_observation_update'),
            $data
        );
        $response = json_decode($response->getBody(), true);
        if (isset($response['status']) && $response['status'] == 'success') {
            return response()->json(responseFormat('success', 'Saved Successfully'));
        } else {
            return response()->json(['status' => 'error', 'data' => $response]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = $this->initHttpWithToken()->post(
            config('amms_bee_routes.follow_up.audit_observation_delete'),
            ['id' => $id]
        )->json();

        if (isset($response['status']) && $response['status'] == 'success') {
            return response()->json(responseFormat('success', 'Deleted Successfully'));
        } else {
            return response()->json(['status' => 'error', 'data' => $response]);
        }
    }

    public function imageDestroy($id)
    {
        $response = $this->initHttpWithToken()->post(
            config('amms_bee_routes.follow_up.audit_observation_removeAttachment'),
            ['id' => $id]
        )->json();

        if (isset($response['status']) && $response['status'] == 'success') {
            return response()->json(responseFormat('success', 'Deleted Successfully'));
        } else {
            return response()->json(['status' => 'error', 'data' => $response]);
        }
    }
}
