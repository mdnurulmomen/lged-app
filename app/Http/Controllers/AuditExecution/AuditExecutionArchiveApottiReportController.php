<?php

namespace App\Http\Controllers\AuditExecution;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuditExecutionArchiveApottiReportController extends Controller
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
        return view(
            'modules.audit_execution.audit_execution_archive_apotti_report.index',
            compact('directorates')
        );
    }

    public function create()
    {
        $all_directorates = $this->allAuditDirectorates();
        $self_directorate = current(array_filter($all_directorates, function ($item) {
            return $this->current_office_id() == $item['office_id'];
        }));
        $directorates = $self_directorate ? [$self_directorate] : $all_directorates;
        return view(
            'modules.audit_execution.audit_execution_archive_apotti_report.create',
            compact('directorates')
        );
    }

    public function list(Request $request)
    {
        $data['directorate_id'] = $request->directorate_id;
        $data['ministry_id'] = $request->ministry_id;
        $data['entity_id'] = $request->entity_id;
        $data['year_from'] = $request->year_from;
        $data['year_to'] = $request->year_to;

        $apotti_report_list = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.archive_apotti_report.list'), $data)->json();
        //dd($apotti_report_list);
        if (isSuccess($apotti_report_list)) {
            $apotti_report_list = $apotti_report_list['data'];
            return view('modules.audit_execution.audit_execution_archive_apotti_report.partials.load_apotti_report_list', compact('apotti_report_list'));
        } else {
            return response()->json(['status' => 'error', 'data' => $apotti_report_list]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validator::make(
            $request->all(),
            [
                'audit_report_name' => 'required',
                'ortho_bochor' => 'required',
                'year_from' => 'required',
                'year_to' => 'required',
                'directorate_id' => 'required',
                'ministry_id' => 'required',
            ],
            [
                'audit_report_name.required' => 'Audit report name field is required.',
                'ortho_bochor.required' => 'Ortho bochor field is required.',
                'year_from.required' => 'From year field is required.',
                'year_to.required' => 'To year field is required.',
                'directorate_id.required' => 'Directorate field is required.',
                'ministry_id.required' => 'Ministry field is required.',
            ]
        )->validate();

        $data = [
            ['name' => 'audit_report_name', 'contents' => $request->audit_report_name],
            ['name' => 'ortho_bochor', 'contents' => $request->ortho_bochor],
            ['name' => 'year_from', 'contents' => $request->year_from],
            ['name' => 'year_to', 'contents' => $request->year_to],
            ['name' => 'directorate_id', 'contents' => $request->directorate_id],
            ['name' => 'directorate_name', 'contents' => $request->directorate_name],
            ['name' => 'ministry_id', 'contents' => $request->ministry_id],
            ['name' => 'ministry_name', 'contents' => $request->ministry_name],
            ['name' => 'entity_id', 'contents' => $request->entity_id],
            ['name' => 'entity_name', 'contents' => $request->entity_name],
            ['name' => 'is_alochito', 'contents' => $request->is_alochito],
            ['name' => 'cdesk', 'contents' => $this->current_desk_json()],
        ];


        //cover_page
        if ($request->hasfile('cover_page')) {
            foreach ($request->file('cover_page') as $file) {
                $data[] = [
                    'name' => 'cover_page[]',
                    'contents' => file_get_contents($file->getRealPath()),
                    'filename' => $file->getClientOriginalName(),
                ];
            }
        }


        //apottis
        if ($request->hasfile('apottis')) {
            foreach ($request->file('apottis') as $file) {
                $data[] = [
                    'name' => 'apottis[]',
                    'contents' => file_get_contents($file->getRealPath()),
                    'filename' => $file->getClientOriginalName(),
                ];
            }
        }

        $response = $this->fileUPloadWithData(
            config('amms_bee_routes.audit_conduct_query.archive_apotti_report.store'),
            $data
        );

        return json_decode($response->getBody(), true);
    }


    public function view(Request $request)
    {
        //apotii edit
        $apotti_data['apotti_id'] = $request->apotti_id;
        $apottiResponseData = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.archive_apotti_report.view'), $apotti_data)->json();
        $apotti = isSuccess($apottiResponseData) ? $apottiResponseData['data'] : [];
        //dd($apotti);
        return view('modules.audit_execution.audit_execution_archive_apotti.view', compact('apotti'));
    }


    public function apottiUploadPage(Request $request)
    {
        $all_directorates = $this->allAuditDirectorates();
        $self_directorate = current(array_filter($all_directorates, function ($item) {
            return $this->current_office_id() == $item['office_id'];
        }));
        $directorates = $self_directorate ? [$self_directorate] : $all_directorates;

        $data['report_id'] = $request->report_id;
        $response = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.archive_apotti_report.view'), $data)->json();
        $report = isSuccess($response) ? $response['data'] : [];
        //dd($report);

        return view(
            'modules.audit_execution.audit_execution_archive_apotti_report.create_apotti',
            compact('directorates', 'report')
        );
    }

    public function apottiStore(Request $request)
    {
        $data = Validator::make(
            $request->all(),
            [
                'id' => 'nullable',
                'report_id' => 'required',
                'jorito_ortho_poriman' => 'required',
                'audit_report_name' => 'required',
                'orthobosor_start' => 'required',
                'orthobosor_end' => 'required',
                'nirikkhito_ortho_bosor' => 'required',
                'nirikkha_dhoron' => 'required',
                'directorate_id' => 'required',
                'ministry_id' => 'required',
                'onucched_no' => 'required',
                'apotti_title' => 'required',
            ],
            [
                'report_id.required' => 'Report ID is required',
                'jorito_ortho_poriman.required' => 'Jorito ortho poriman is required',
                'audit_report_name.required' => 'Audit  is required',
                'orthobosor_start.required' => 'Jorito ortho is required',
                'orthobosor_end.required' => 'Audit year start is required',
                'nirikkhito_ortho_bosor.required' => 'Audit year end is required',
                'nirikkha_dhoron.required' => 'Audit year end is required',
                'directorate_id.required' => 'Audit year end is required',
                'ministry_id.required' => 'Audit year end is required',
                'onucched_no.required' => 'Onucched no is required',
                'apotti_title.required' => 'Apotti title is required',
            ]
        )->validate();
        $data['onucched_no']              = bnToen($request->onucched_no);
        $data['jorito_ortho_poriman']     = bnToen($request->jorito_ortho_poriman);
        $data['directorate_name']         = $request->directorate_name;
        $data['ministry_name']            = $request->ministry_name;
        $data['entity_id']                = $request->entity_id;
        $data['entity_name']              = $request->entity_name;
        $data['parent_office_id']         = $request->unit_group_office_id;
        $data['parent_office_name']       = $request->parent_office_name;
        $data['cost_center_id']           = $request->cost_center_id;
        $data['cost_center_name']         = $request->cost_center_name;
        $data['is_alocito']               = $request->is_alocito;
        $data['is_nispottikrito']         = $request->is_nispottikrito;
        $data['apotti_status']            = $request->apotti_status;
        $data['pa_commitee_meeting']      = $request->pa_commitee_meeting;
        $data['pa_commitee_siddhanto']    = $request->pa_commitee_siddhanto;
        $data['ministry_actions']         = $request->ministry_actions;
        $data['audit_department_actions'] = $request->audit_department_actions;
        $data['cdesk']                    = $this->current_desk_json();
        $response = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.archive_apotti_report.store_report_apotti'), $data)->json();

        if ($response['status'] == 'success') {
            return response()->json(['status' => 'success', 'data' => $response['data']]);
        } else {
            return response()->json(['status' => 'error', 'data' => $response]);
        }
    }

    public function reportSync(Request $request)
    {
        //        dd($request->all());
        $data['report_id'] = $request->report_id;
        $data['cdesk'] = $this->current_desk_json();
        $response = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.archive_apotti_report.report_sync'), $data)->json();
        if ($response['status'] == 'success') {
            return response()->json(['status' => 'success', 'data' => $response['data']]);
        } else {
            return response()->json(['status' => 'error', 'data' => $response]);
        }
    }

    public function reportDetails(Request $request)
    {
        $data['report_id'] = $request->report_id;
        $response = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.archive_apotti_report.view'), $data)->json();
        $report_details = isSuccess($response) ? $response['data'] : [];

        return view('modules.audit_execution.audit_execution_archive_apotti_report.view', compact('report_details'));

    }

    public function reportApottiDelete(Request $request){
        $data['apotti_id'] = $request->apotti_id;
        $response = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.archive_apotti_report.report_apotti_delete'), $data)->json();
        if ($response['status'] == 'success') {
            return response()->json(['status' => 'success', 'data' => $response['data']]);
        } else {
            return response()->json(['status' => 'error', 'data' => $response]);
        }
    }

    public function reportApottiEditForm(Request $request){
        $data['apotti_id'] = $request->apotti_id;
        $all_directorates = $this->allAuditDirectorates();
        $self_directorate = current(array_filter($all_directorates, function ($item) {
            return $this->current_office_id() == $item['office_id'];
        }));
        $directorates = $self_directorate ? [$self_directorate] : $all_directorates;
        $apotti_details = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.archive_apotti_report.get_arc_report_apotti_info'), $data)->json();
//        dd($apotti_details);
        $apotti_details = isSuccess($apotti_details) ? $apotti_details['data'] : [];
        return view(
            'modules.audit_execution.audit_execution_archive_apotti_report.edit_apotti',
            compact('directorates','apotti_details')
        );
    }
}
