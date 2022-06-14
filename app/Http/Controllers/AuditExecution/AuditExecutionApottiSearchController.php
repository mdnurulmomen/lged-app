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
        $directorates = $self_directorate ? [$self_directorate] : $all_directorates;
        return view('modules.audit_execution.audit_apotti_search.index',compact('fiscal_years','directorates'));
    }

    public function list(Request $request){
        $data['directorate_id'] = $request->directorate_id;
        $data['ministry_id'] = $request->ministry_id;
        $data['entity_id'] = $request->entity_id;
        $data['onucched_no'] = $request->onucched_no;
        $data['fiscal_year_id'] = $request->fiscal_year_id;
        $data['apotti_type'] = $request->apotti_type;
        $data['total_jorito_ortho_poriman'] = $request->total_jorito_ortho_poriman;
        $data['page'] = $request->page;
        $data['per_page'] = $request->per_page;

        $apotti_list = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.apotti.search-list'), $data)->json();
        //dd($apotti_list);
        if (isSuccess($apotti_list)) {
            $apotti_list = $apotti_list['data'];
            return view('modules.audit_execution.audit_apotti_search.partials.load_apotti_list', compact('apotti_list'));
        } else {
            return response()->json(['status' => 'error', 'data' => $apotti_list]);
        }
    }

    public function view(Request $request)
    {
        $data['directorate_id'] = $request->directorate_id;
        $data['apotti_id'] = $request->apotti_id;
        $apottiResponseData = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.apotti.search-view'), $data)->json();
        //dd($apottiResponseData);
        $apotti = isSuccess($apottiResponseData) ? $apottiResponseData['data'] : [];
        return view('modules.audit_execution.audit_apotti_search.view', compact('apotti'));
    }
}
