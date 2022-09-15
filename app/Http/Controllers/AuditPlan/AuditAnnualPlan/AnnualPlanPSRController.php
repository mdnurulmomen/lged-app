<?php

namespace App\Http\Controllers\AuditPlan\AuditAnnualPlan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AnnualPlanPSRController extends Controller
{
    public function index(Request $request)
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
        $annual_plan_id = $request->annual_plan_id;
        $fiscal_year_id = $request->fiscal_year_id;
        $activity_id = $request->activity_id;
        $psr_data = $this->getAuditTemplate('performance', 'PSR');
        $content = $psr_data['content'];

        $data['annual_plan_id'] = $annual_plan_id;
        $data['fiscal_year_id'] = $fiscal_year_id;
        $data['op_audit_calendar_event_id'] = $activity_id;
        $data['cdesk'] = $this->current_desk_json();
        $annual_plan = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_annual_plan_revised.get_annual_plan_info'), $data)->json();
        $annual_plan = isSuccess($annual_plan) ? $annual_plan['data'] : [];
        return view('modules.audit_plan.annual.annual_plan_revised.psr.create',compact('content', 'annual_plan_id', 'fiscal_year_id', 'activity_id','annual_plan'));
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
            $fileName = $current_office_id . '_PSR_Plan_' . $psr_plan_id . '.pdf';

            Storage::put('public/psrs/' . $fileName, $pdf->output());

            return view('modules.audit_plan.annual.annual_plan_revised.psr.partials.preview_psr_plan',
                compact('fileName','scope_editable','psr_plan_id'));
        } else {
            return ['status' => 'error', 'data' => 'Error'];
        }
    }


    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function edit(Request $request)
    {
        $data = Validator::make($request->all(), [
            'psr_plan_id' => 'required|integer',
        ])->validate();

        $psr_plan_id = $request->psr_plan_id;
        $data['psr_plan_id'] = $psr_plan_id;
        $data['cdesk'] = $this->current_desk_json();
        $ap_plan = $this->initHttpWithToken()->post(config('amms_bee_routes.psr_plan.view'), $data)->json();
        //dd($ap_plan);
        if (isSuccess($ap_plan)) {
            $ap_plan = $ap_plan['data'];
            $psr_plan_id= $ap_plan['id'];
            $activity_id= $ap_plan['activity_id'];
            $fiscal_year_id= $ap_plan['fiscal_year_id'];
            $annual_plan_id= $ap_plan['annual_plan_id'];
            $content = json_decode(gzuncompress(getDecryptedData($ap_plan['plan_description'])),true);
            //dd($content);
            return view('modules.audit_plan.annual.annual_plan_revised.psr.edit', compact('psr_plan_id','activity_id','fiscal_year_id','annual_plan_id','content'));
        } else {
            return ['status' => 'error', 'data' => $ap_plan['data']];
        }
    }
}
