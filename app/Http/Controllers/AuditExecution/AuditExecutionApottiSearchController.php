<?php

namespace App\Http\Controllers\AuditExecution;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuditExecutionApottiSearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $fiscal_years = $this->allFiscalYears();
        $all_directorates = $this->allAuditDirectorates();
        $self_directorate = current(array_filter($all_directorates, function ($item) {
            return $this->current_office_id() == $item['office_id'];
        }));
//        dd($all_doners);
        $directorates = $self_directorate ? [$self_directorate] : $all_directorates;
        return view('modules.audit_execution.audit_apotti_search.index', compact('fiscal_years', 'directorates'));
    }

    public function list(Request $request)
    {
        $data['directorate_id'] = $request->directorate_id;
        $data['project_id'] = $request->project_id ? [$request->project_id] : null;
        $data['doner_id'] = $request->doner_id;
        $data['ministry_id'] = $request->ministry_id;
        $data['entity_id'] = $request->entity_id;
        $data['cost_center_id'] = $request->cost_center_id;
        $data['onucched_no'] = $request->onucched_no;
        $data['fiscal_year_id'] = $request->fiscal_year_id;
        $data['audit_year_start'] = $request->audit_year_start;
        $data['audit_year_end'] = $request->audit_year_end;
        $data['apotti_type'] = $request->apotti_type;
        $data['jorito_ortho_poriman'] = $request->total_jorito_ortho_poriman;
        $data['file_token_no'] = $request->file_token_no;
        $data['memo_status'] = $request->memo_status;
        $data['page'] = $request->page;
        $data['per_page'] = $request->per_page;

        if ($request->doner_id && !$request->project_id) {
            $doner_data['directorate_id'] = $request->directorate_id;
            $doner_data['doner_id'] = $request->doner_id;
            $doner_data['type'] = 'only_id';

            $project_list = $this->initRPUHttp()->post(config('cag_rpu_api.get-doner-wise-project'), $doner_data)->json();

            $data['project_id'] = !empty($project_list['data']) ? $project_list['data'] : null;

        }

//        dd($data);

        $response = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.apotti.search-list'), $data)->json();
//        dd($response);
        if (isSuccess($response)) {
            $response = $response['data'];
            $apotti_list = $response['apotti_list'];
            $total_jorito_ortho_poriman = $response['total_jorito_ortho_poriman'];
            return view('modules.audit_execution.audit_apotti_search.partials.load_apotti_list', compact('apotti_list', 'total_jorito_ortho_poriman'));
        } else {
            return response()->json(['status' => 'error', 'data' => $response]);
        }
    }

    public function view(Request $request)
    {
        $data['directorate_id'] = $request->directorate_id;
        $data['apotti_id'] = $request->apotti_id;
        $apottiResponseData = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.apotti.search-view'), $data)->json();
        //dd($apottiResponseData);
        $apotti = isSuccess($apottiResponseData) ? $apottiResponseData['data']['apotti'] : [];
        $attachments = isSuccess($apottiResponseData) ? $apottiResponseData['data']['attachments'] : [];
        return view('modules.audit_execution.audit_apotti_search.view', compact('apotti', 'attachments'));
    }

    public function edit(Request $request)
    {
        $all_directorates = $this->allAuditDirectorates();
        $self_directorate = current(array_filter($all_directorates, function ($item) {
            return $this->current_office_id() == $item['office_id'];
        }));
        $directorates = $self_directorate ? [$self_directorate] : $all_directorates;

        $data['office_id'] = $request->directorate_id;
        $all_projects = $this->initRPUHttp()->post(config('cag_rpu_api.get-all-project'), $data)->json();
        $all_projects = $all_projects ? $all_projects['data'] : [];

        $fiscal_years = $this->allFiscalYears();

        //apotii edit
        $search_data['apotti_item_id'] = $request->apotti_item_id;
        $search_data['directorate_id'] = $request->directorate_id;
        $apottiResponseData = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.apotti.search-edit'), $search_data)->json();
        $apotti = isSuccess($apottiResponseData) ? $apottiResponseData['data']['apotti'] : [];
        $apotti_item = isSuccess($apottiResponseData) ? $apottiResponseData['data']['apotti_item'] : [];
        $main_attachments = isSuccess($apottiResponseData) ? $apottiResponseData['data']['main_attachments'] : [];
        $promanok_attachments = isSuccess($apottiResponseData) ? $apottiResponseData['data']['promanok_attachments'] : [];
        $porisishto_attachments = isSuccess($apottiResponseData) ? $apottiResponseData['data']['porisishto_attachments'] : [];
        return view('modules.audit_execution.audit_apotti_search.edit',
            compact('directorates', 'apotti', 'apotti_item', 'main_attachments', 'promanok_attachments', 'porisishto_attachments', 'search_data', 'all_projects', 'fiscal_years')
        );
    }

    public function editSubmit(Request $request)
    {
        Validator::make($request->all(), [
            'apotti_item_id' => 'required',
            'directorate_id' => 'required',
            'fiscal_year_id' => 'required',
            'audit_year_start' => 'required',
            'audit_year_end' => 'required',
            'fiscal_year' => 'required',
            'audit_type' => 'required',
        ])->validate();

        $daata = [];
        $data['apotti_item_id'] = $request->apotti_item_id;
        $data['directorate_id'] = $request->directorate_id;
        $data['audit_type'] = $request->audit_type;
        $data['project_id'] = $request->project_id;
        $data['project_name_en'] = $request->project_name_en;
        $data['project_name_bn'] = $request->project_name_bn;
        $data['ministry_id'] = $request->ministry_id;
        $data['ministry_name_en'] = $request->ministry_name_en;
        $data['ministry_name_bn'] = $request->ministry_name_bn;
        $data['parent_office_id'] = $request->entity_id;
        $data['parent_office_name_en'] = $request->entity_name_en;
        $data['parent_office_name_bn'] = $request->entity_name_bn;
        $data['cost_center_id'] = $request->cost_center_id;
        $data['cost_center_name_en'] = $request->cost_center_name_en;
        $data['cost_center_name_bn'] = $request->cost_center_name_bn;
        $data['fiscal_year_id'] = $request->fiscal_year_id;
        $data['audit_year_start'] = $request->audit_year_start;
        $data['audit_year_end'] = $request->audit_year_end;
        $data['memo_type'] = $request->memo_type;
        $data['fiscal_year'] = $request->fiscal_year;

        return $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.apotti.store-edited-apotti'), $data)->json();
    }

    public function getDonerWiseProject(Request $request)
    {
        $data['directorate_id'] = $request->directorate_id;
        $data['ministry_id'] = $request->ministry_id;
        $data['doner_id'] = $request->doner_id;

        $data['type'] = 'only_id';

        $project_ids = $this->initRPUHttp()->post(config('cag_rpu_api.get-doner-wise-project'), $data)->json();
        $project_ids = isSuccess($project_ids) ? $project_ids['data'] : [];

        $project_data['directorate_id'] = $request->directorate_id;
        $project_data['ministry_id'] = $request->ministry_id;
        $project_data['project_ids'] = $project_ids;
        $project_data['type'] = 'by_project_ids';

        $project_list = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.apotti.get-ministry-wise-project-from-office-db'), $project_data)->json();
        $project_list = isSuccess($project_list) ? $project_list['data'] : [];


        return view('modules.audit_execution.audit_apotti_search.partials.project_select', compact('project_list'));
    }

    public function getMinistryWiseProjectAndDoner(Request $request)
    {
        $data['directorate_id'] = $request->directorate_id;
        $data['ministry_id'] = $request->ministry_id;
        $data['type'] = 'only_id';

        $project_ids = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.apotti.get-ministry-wise-project-from-office-db'), $data)->json();
        $project_ids = isSuccess($project_ids) ? $project_ids['data'] : [];

        $rpu_data['project_ids'] = $project_ids;

        $doner_list = $this->initRPUHttp()->post(config('cag_rpu_api.get-project-wise-doner'), $rpu_data)->json();

        $doner_list = isSuccess($doner_list) ? $doner_list['data'] : [];

        return view('modules.audit_execution.audit_apotti_search.partials.doner_select', compact('doner_list'));
    }

    public function getMinistryWiseProject(Request $request)
    {
        $data['directorate_id'] = $request->directorate_id;
        $data['ministry_id'] = $request->ministry_id;

        $project_list = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.apotti.get-ministry-wise-project-from-office-db'), $data)->json();
//        dd($project_list);
        $project_list = isSuccess($project_list) ? $project_list['data'] : [];


        return view('modules.audit_execution.audit_apotti_search.partials.project_select', compact('project_list'));
    }
}
