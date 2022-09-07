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
        return view('modules.audit_execution.audit_apotti_search.index',compact('fiscal_years','directorates'));
    }

    public function list(Request $request){
        $data['directorate_id'] = $request->directorate_id;
        $data['project_id'] = $request->project_id ?  [$request->project_id] : null;
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

        if($request->doner_id && !$request->project_id){
            $doner_data['directorate_id'] = $request->directorate_id;
            $doner_data['doner_id'] = $request->doner_id;
            $doner_data['type'] = 'only_id';

            $project_list = $this->initRPUHttp()->post(config('cag_rpu_api.get-doner-wise-project'),$doner_data)->json();

            $data['project_id'] = !empty($project_list['data']) ? $project_list['data']  : null;

        }

//        dd($data);

        $response = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.apotti.search-list'), $data)->json();
//        dd($response);
        if (isSuccess($response)) {
            $response = $response['data'];
            $apotti_list = $response['apotti_list'];
            $total_jorito_ortho_poriman = $response['total_jorito_ortho_poriman'];
            return view('modules.audit_execution.audit_apotti_search.partials.load_apotti_list', compact('apotti_list','total_jorito_ortho_poriman'));
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
        return view('modules.audit_execution.audit_apotti_search.view', compact('apotti','attachments'));
    }

    public function getDonerWiseProject(Request  $request){
        $data['directorate_id'] = $request->directorate_id;
        $data['ministry_id'] = $request->ministry_id;
        $data['doner_id'] = $request->doner_id;

        $data['type'] = 'only_id';

        $project_ids = $this->initRPUHttp()->post(config('cag_rpu_api.get-doner-wise-project'),$data)->json();
        $project_ids = isSuccess($project_ids) ? $project_ids['data'] : [];

        $project_data['directorate_id'] = $request->directorate_id;
        $project_data['ministry_id'] = $request->ministry_id;
        $project_data['project_ids'] =  $project_ids;
        $project_data['type'] =  'by_project_ids';

        $project_list = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.apotti.get-ministry-wise-project-from-office-db'), $project_data)->json();
        $project_list = isSuccess($project_list) ? $project_list['data'] : [];


        return view('modules.audit_execution.audit_apotti_search.partials.project_select', compact('project_list'));
    }

    public function getMinistryWiseProjectAndDoner(Request $request){
        $data['directorate_id'] = $request->directorate_id;
        $data['ministry_id'] = $request->ministry_id;
        $data['type'] = 'only_id';

        $project_ids = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.apotti.get-ministry-wise-project-from-office-db'), $data)->json();
        $project_ids = isSuccess($project_ids) ? $project_ids['data'] : [];

        $rpu_data['project_ids'] = $project_ids;

        $doner_list = $this->initRPUHttp()->post(config('cag_rpu_api.get-project-wise-doner'),$rpu_data)->json();

        $doner_list = isSuccess($doner_list) ? $doner_list['data'] : [];

        return view('modules.audit_execution.audit_apotti_search.partials.doner_select', compact('doner_list'));
    }

    public function getMinistryWiseProject(Request $request){
        $data['directorate_id'] = $request->directorate_id;
        $data['ministry_id'] = $request->ministry_id;

        $project_list = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.apotti.get-ministry-wise-project-from-office-db'), $data)->json();
//        dd($project_list);
        $project_list = isSuccess($project_list) ? $project_list['data'] : [];



        return view('modules.audit_execution.audit_apotti_search.partials.project_select', compact('project_list'));
    }
}
