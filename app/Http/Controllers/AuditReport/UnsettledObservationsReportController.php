<?php

namespace App\Http\Controllers\AuditReport;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;
use Mpdf\Mpdf;

class UnsettledObservationsReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $fiscal_years = $this->allFiscalYears();
        $all_directorates = $this->allAuditDirectorates();
        $self_directorate = current(array_filter($all_directorates, function ($item) {
            return $this->current_office_id() == $item['office_id'];
        }));
        $directorates = $self_directorate ? [$self_directorate] : $all_directorates;
        return view('modules.audit_report.unsettled_observations_report.index', compact('fiscal_years','directorates'));
    }

    public function list(Request $request){
        $data['directorate_id'] = $request->directorate_id;
        $data['ministry_id'] = $request->ministry_id;
        $data['entity_id'] = $request->entity_id;
        $data['cost_center_id'] = $request->cost_center_id;
        $data['fiscal_year_id'] = $request->fiscal_year_id;
        $data['memo_type'] = $request->memo_type;
        $data['jorito_ortho_poriman'] = $request->jorito_ortho_poriman;
        $columns = $request->columns?:[];
        $data['page'] = $request->page;
        $data['per_page'] = $request->per_page;

        $apotti_list = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_report.unsettled_observations.list'), $data)->json();
        //dd($apotti_list);
        if (isSuccess($apotti_list)) {
            $apotti_list = $apotti_list['data'];
            return view('modules.audit_report.unsettled_observations_report.partials.load_apotti_item_list',
                compact('apotti_list','columns'));
        } else {
            return response()->json(['status' => 'error', 'data' => $apotti_list]);
        }
    }

    public function download(Request $request)
    {
        ini_set("pcre.backtrack_limit", "999999999999");
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 0);

        $data['directorate_id'] = $request->directorate_id;
        $data['ministry_id'] = $request->ministry_id;
        $data['entity_id'] = $request->entity_id;
        $data['cost_center_id'] = $request->cost_center_id;
        $data['fiscal_year_id'] = $request->fiscal_year_id;
        $data['memo_type'] = $request->memo_type;
        $data['jorito_ortho_poriman'] = $request->jorito_ortho_poriman;

        $columns                = $request->columns?               : [];
        $directorate_name       = $request->directorate_name;
        $ministry_name          = $request->ministry_name;
        $entity_name            = $request->entity_name;
        $unit_group_office_name = $request->unit_group_office_name;

        $response = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_report.unsettled_observations.download'), $data)->json();
        //dd($response);
        if (isSuccess($response)) {
            $response = $response['data'];
            $apotti_list = $response['apotti_list'];
            $total_jorito_ortho_poriman = $response['total_jorito_ortho_poriman'];
            $pdf = \PDF::loadView(
                'modules.audit_report.unsettled_observations_report.partials.book_apotti_item',
                [
                    'directorate_name' => $directorate_name,
                    'ministry_name' => $ministry_name,
                    'entity_name' => $entity_name,
                    'unit_group_office_name' => $unit_group_office_name,
                    'apotti_list' => $apotti_list,
                    'total_jorito_ortho_poriman' => $total_jorito_ortho_poriman,
                    'columns' => $columns
                ],
                [],
                ['orientation' => 'L', 'format' => 'A4']
            );
            $fileName = 'unsettled_observations_report_' . date('D_M_j_Y') . '.pdf';
            return $pdf->stream($fileName);
        } else {
            return response()->json(['status' => 'error', 'data' => $response]);
        }
    }

}