<?php

namespace App\Http\Controllers\AuditPlan\AuditAnnualPlan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AnnualPlanPSRController extends Controller
{
    public function loadPsrIndex(Request $request)
    {
        $office_id = $this->current_office_id();
        $all_directorates = $this->allAuditDirectorates();
        $self_directorate = current(array_filter($all_directorates, function ($item) {
            return $this->current_office_id() == $item['office_id'];
        }));
        $directorates = $self_directorate ? [$self_directorate] : $all_directorates;
        $fiscal_years = $this->allFiscalYears();
        return view('modules.audit_plan.annual.annual_plan_revised.psr.psr_annual_plan_lists', compact('office_id', 'directorates', 'fiscal_years'));
    }

    public function create(Request $request)
    {
        $data['cdesk'] = $this->current_desk_json();
        if ($this->current_office_id() == 14) {
            $directorate_address_footer = 'অডিট কমপ্লেক্স,৩য় তলা,সেগুনবাগিচা,ঢাকা-১০০০।';
            $directorate_address_top = 'অডিট কমপ্লেক্স (৩য় তলা) <br> সেগুনবাগিচা,ঢাকা-১০০০।';
            $directorate_website = 'www.worksaudit.org.bd';
        } elseif ($this->current_office_id() == 3) {
            $directorate_address_footer = 'অডিট কমপ্লেক্স,২য় তলা,সেগুনবাগিচা,ঢাকা-১০০০।';
            $directorate_address_top = 'অডিট কমপ্লেক্স (২য় তলা) <br> সেগুনবাগিচা,ঢাকা-১০০০।';
            $directorate_website = 'www.dgcivil-cagbd.org';
        } elseif ($this->current_office_id() == 2) {
            $directorate_address_footer = 'অডিট কমপ্লেক্স,৮ম তলা,সেগুনবাগিচা,ঢাকা-১০০০।';
            $directorate_address_top = 'অডিট কমপ্লেক্স (৮ম তলা) <br> সেগুনবাগিচা,ঢাকা-১০০০।';
            $directorate_website = 'www.cad.org.bd';
        } else {
            $directorate_address_footer = '';
            $directorate_address_top = '';
            $directorate_website = '';
        }

        $annual_plan_id = $request->annual_plan_id;
        $fiscal_year_id = $request->fiscal_year_id;
        $activity_id = $request->activity_id;
        $psr_data = $this->getAuditTemplate('performance', 'PSR');
        $content = $psr_data['content'];
        // dd($content);

        $cover_info = [
            'directorate_address_footer' => $directorate_address_footer,
            'directorate_address_top' => $directorate_address_top,
            'directorate_website' => $directorate_website
        ];

        return view('modules.audit_plan.annual.annual_plan_revised.psr.create_psr',
            compact('content', 'annual_plan_id', 'fiscal_year_id', 'activity_id', 'cover_info'));
    }

    // Save PSR
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = Validator::make($request->all(), [
            //  'psr_plan_id' => '1',
            'psr_plan_id' => 'nullable',
            'annual_plan_id' => 'required',
            'fiscal_year_id' => 'required',
            'activity_id' => 'required',
            'plan_description' => 'required',
        ])->validate();

        $data['cdesk'] = $this->current_desk_json();
        $data['plan_description'] = makeEncryptedData(gzcompress(json_encode($request->plan_description)));
        $data['status'] = 'draft';

        $response = $this->initHttpWithToken()->post(config('amms_bee_routes.psr_plan.store'), $data)->json();
        //dd($response);
        if (isSuccess($response)) {
            return response()->json(['status' => 'success', 'data' => $response['data']]);
        } else {
            return response()->json(['status' => 'error', 'data' => $response]);
        }
    }


    public function preview(Request $request)
    {
        ini_set("pcre.backtrack_limit", "999999999999");
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 0);

        $scope_editable = $request->scope_editable;
        $psr_plan_id = $request->psr_plan_id;
        $data['psr_plan_id'] = $psr_plan_id;
        $data['cdesk'] = $this->current_desk_json();
        $ap_plan = $this->initHttpWithToken()->post(config('amms_bee_routes.psr_plan.view'), $data)->json();

        if (isSuccess($ap_plan)) {
            $ap_plan = $ap_plan['data'];
            $plans = json_decode(json_decode(gzuncompress(getDecryptedData($ap_plan['plan_description'])), true), true);
            //dd($plans[1]['content']);
            $current_office_id = $this->current_office_id();
            $pdf = \PDF::loadView('modules.audit_plan.annual.annual_plan_revised.psr.partials.psr_plan_book', ['plans' => $plans], [], ['orientation' => 'P', 'format' => 'A4']);
            $fileName = $current_office_id . '_Plan' . $psr_plan_id . '.pdf';

            Storage::put('public/psrs/' . $fileName, $pdf->output());

            return view('modules.audit_plan.annual.annual_plan_revised.psr.partials.preview_psr_plan',
                compact('fileName'));
        } else {
            return ['status' => 'error', 'data' => 'Error'];
        }
    }

    public function PSRBook(Request $request)
    {
        ini_set("pcre.backtrack_limit", "999999999999");
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 0);

        $scope_editable = $request->scope_editable;
        $psr_plan_id = $request->psr_plan_id;
        $data['psr_plan_id'] = $psr_plan_id;
        $data['cdesk'] = $this->current_desk_json();
        // dd($data);
        $ap_plan = $this->initHttpWithToken()->post(config('amms_bee_routes.psr_plan.view'), $data)->json();


        if (isSuccess($ap_plan)) {
            $ap_plan = $ap_plan['data'];
            $plans = json_decode(json_decode(gzuncompress(getDecryptedData($ap_plan['plan_description'])), true), true);
            //dd($plans[1]['content']);
            $current_office_id = $this->current_office_id();
            $pdf = \PDF::loadView('modules.audit_plan.annual.annual_plan_revised.psr.partials.psr_plan_book', ['plans' => $plans], [], ['orientation' => 'P', 'format' => 'A4']);
            $fileName = $current_office_id . '_Plan' . $psr_plan_id . '.pdf';

            Storage::put('public/psrs/' . $fileName, $pdf->output());

            return view('modules.audit_plan.annual.annual_plan_revised.psr.partials.preview_psr_plan',
                compact('fileName', 'psr_plan_id'));
        } else {
            return ['status' => 'error', 'data' => 'Error'];
        }
    }

    public function update(Request $request)
    {
        // $data = Validator::make($request->all(), [
        //     'psr_plan_id' => 'required|integer',
        // ])->validate();

        $data['cdesk'] = $this->current_desk_json();
        $annual_plan_id = $request->annual_plan_id;
        $data['annual_plan_id'] = $annual_plan_id;

        $check_edit_psr = $this->initHttpWithToken()->post(config('amms_bee_routes.psr_plan.update'), $data)->json();
        // dd($check_edit_psr);
        $check_edit_psr = isSuccess($check_edit_psr) ? $check_edit_psr['data'] : [];

        // $audit_plan = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_entity_plan.ap_entity_plan_edit_draft'), $data)->json();

        if (isSuccess($check_edit_psr)) {

            $content = json_decode(gzuncompress(getDecryptedData($audit_plan['plan_description'])), true);
            //dd($content);

            $activity_id = $check_edit_psr['activity_id'];
            $annual_plan_id = $check_edit_psr['annual_plan_id'];
            $fiscal_year_id = $request->fiscal_year_id;
            return view('modules.audit_plan.audit_plan.plan_revised.edit_entity_audit_plan', compact('activity_id', 'annual_plan_id',
                'audit_plan', 'content', 'fiscal_year_id', 'parent_office_id', 'entity_list', 'project_id', 'check_edit_lock'));
        } else {
            return ['status' => 'error', 'data' => $check_edit_psr];
        }
    }
}
