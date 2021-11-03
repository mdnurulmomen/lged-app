<?php

namespace App\Http\Controllers\AuditExecution;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuditExecutionMemoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $schedule_id = $request->schedule_id;
        $audit_plan_id = $request->audit_plan_id;
        $cost_center_id = $request->cost_center_id;
        $cost_center_name_bn = $request->cost_center_name_bn;
        $audit_year_start = $request->audit_year_start;
        $audit_year_end = $request->audit_year_end;
        return view('modules.audit_execution.audit_execution_memo.index',
            compact('schedule_id','audit_plan_id','cost_center_id',
            'cost_center_name_bn','audit_year_start','audit_year_end'));
    }

    public function list(Request $request)
    {
        $data = Validator::make($request->all(), [
            'audit_plan_id' => 'required|integer',
            'cost_center_id' => 'required|integer',
            'per_page' => 'required|integer',
            'page' => 'required|integer',
        ])->validate();
        $data['cdesk'] = json_encode($this->current_desk(), JSON_UNESCAPED_UNICODE);
        $memo_list = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.memo.list'), $data)->json();
        if (isSuccess($memo_list)) {
            $memo_list = $memo_list['data'];
            return view('modules.audit_execution.audit_execution_memo.partials.load_memo_list',
                compact('memo_list'));
        } else {
            return response()->json(['status' => 'error', 'data' => $memo_list]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $schedule_id = $request->schedule_id;
        $cost_center_name_bn = $request->cost_center_name_bn;
        $audit_year_start = $request->audit_year_start;
        $audit_year_end = $request->audit_year_end;
        return view('modules.audit_execution.audit_execution_memo.create',
            compact('schedule_id','cost_center_name_bn',
                'audit_year_start','audit_year_end'));
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
            'schedule_id' => 'required',
            'memo_title_bn' => 'required',
            'memo_description_bn' => 'required',
            'jorito_ortho_poriman' => 'required',
            'onishponno_jorito_ortho_poriman' => 'required',
            'audit_year_start' => 'required',
            'audit_year_end' => 'required',
//            'memo_irregularity_type' => 'required',
//            'memo_irregularity_sub_type' => 'required',
//            'memo_type' => 'required',
//            'memo_status' => 'required',
        ])->validate();

        $data = [
            ['name' => 'team_member_schedule_id', 'contents' => $request->schedule_id],
            ['name' => 'memo_title_bn', 'contents' => $request->memo_title_bn],
            ['name' => 'memo_description_bn', 'contents' => $request->memo_description_bn],
            ['name' => 'response_of_rpu', 'contents' => $request->response_of_rpu],
            ['name' => 'audit_conclusion', 'contents' => $request->audit_conclusion],
            ['name' => 'audit_recommendation', 'contents' => $request->audit_recommendation],
            ['name' => 'jorito_ortho_poriman', 'contents' => $request->jorito_ortho_poriman],
            ['name' => 'onishponno_jorito_ortho_poriman', 'contents' => $request->onishponno_jorito_ortho_poriman],
            ['name' => 'audit_year_start', 'contents' => $request->audit_year_start],
            ['name' => 'audit_year_end', 'contents' => $request->audit_year_end],
            ['name' => 'memo_irregularity_type', 'contents' => $request->memo_irregularity_type],
            ['name' => 'memo_irregularity_sub_type', 'contents' => $request->memo_irregularity_sub_type],
            ['name' => 'memo_type', 'contents' => $request->memo_type],
            ['name' => 'memo_status', 'contents' => $request->memo_status],
            ['name' => 'cdesk', 'contents' => json_encode($this->current_desk(), JSON_UNESCAPED_UNICODE)],
        ];

        $memo_attachment_file = $request->memo_attachment;
        if ($request->hasfile('memo_attachment')) {
            $data[] = [
                'name'     => 'memo',
                'contents' => file_get_contents($memo_attachment_file->getRealPath()),
                'filename' => $memo_attachment_file->getClientOriginalName(),
            ];
        }

        $appendix_file = $request->porisishto;
        if ($request->hasfile('porisishto')) {
            $data[] = [
                'name'     => 'porisishto',
                'contents' => file_get_contents($appendix_file->getRealPath()),
                'filename' => $appendix_file->getClientOriginalName(),
            ];
        }

        $authentic_file= $request->pramanok;
        if ($request->hasfile('pramanok')) {
            $data[] = [
                'name'     => 'pramanok',
                'contents' => file_get_contents($authentic_file->getRealPath()),
                'filename' => $authentic_file->getClientOriginalName(),
            ];
        }
        //dd($data);

        $response = $this->fileUPloadWithData(
            'POST',
            config('amms_bee_routes.audit_conduct_query.memo.store'),
            $data
        );

        return json_decode($response->getBody(), true);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $data = Validator::make($request->all(), [
            'memo_id' => 'required|integer',
        ])->validate();
        $data['cdesk'] = json_encode($this->current_desk(), JSON_UNESCAPED_UNICODE);
        $memoInfo = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.memo.edit'), $data)->json();
        //dd($memoInfo);
        if (isSuccess($memoInfo)) {
            $memoInfo = $memoInfo['data'];
            return view('modules.audit_execution.audit_execution_memo.show',
                compact('memoInfo'));
        } else {
            return response()->json(['status' => 'error', 'data' => $memoInfo]);
        }
    }

    public function showDetails(Request $request)
    {
        $data = Validator::make($request->all(), [
            'memo_id' => 'required|integer',
        ])->validate();
        $data['cdesk'] = json_encode($this->current_desk(), JSON_UNESCAPED_UNICODE);
        $memo_info = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.memo.edit'), $data)->json();
//        dd($memo_info);
        if (isSuccess($memo_info)) {
            $memo_info = $memo_info['data'];
            return view('modules.audit_execution.audit_execution_memo.show_details',
                compact('memo_info'));
        } else {
            return response()->json(['status' => 'error', 'data' => $memo_info]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse
     */
    public function edit(Request $request)
    {
        $data = Validator::make($request->all(), [
            'memo_id' => 'required|integer',
        ])->validate();
        $data['cdesk'] = json_encode($this->current_desk(), JSON_UNESCAPED_UNICODE);
        $memo = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.memo.edit'), $data)->json();
        if (isSuccess($memo)) {
            $memo = $memo['data'];
            return view('modules.audit_execution.audit_execution_memo.edit',
                compact('memo'));
        } else {
            return response()->json(['status' => 'error', 'data' => $memo]);
        }
    }

    public function sentToRpu(Request $request)
    {
        $data = Validator::make($request->all(), [
            'memos' => 'required',
        ])->validate();
        $data['cdesk'] = json_encode($this->current_desk(), JSON_UNESCAPED_UNICODE);
        //dd($data);
        $memoSendToRpu = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.memo.send_to_rpu'), $data)->json();
        if (isSuccess($memoSendToRpu)) {
            return response()->json(['status' => 'success', 'data' => 'Successfully! Memo has been saved']);
        } else {
            return response()->json(['status' => 'error', 'data' => $memoSendToRpu]);
        }
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
            'memo_id' => 'required',
            'memo_title_bn' => 'required',
            'memo_description_bn' => 'required',
            'jorito_ortho_poriman' => 'required',
            'onishponno_jorito_ortho_poriman' => 'required',
            'audit_year_start' => 'required',
            'audit_year_end' => 'required',
//            'memo_irregularity_type' => 'required',
//            'memo_irregularity_sub_type' => 'required',
//            'memo_type' => 'required',
//            'memo_status' => 'required',
        ])->validate();

        $data = [
            ['name' => 'memo_id', 'contents' => $request->memo_id],
            ['name' => 'memo_title_bn', 'contents' => $request->memo_title_bn],
            ['name' => 'memo_description_bn', 'contents' => $request->memo_description_bn],
            ['name' => 'response_of_rpu', 'contents' => $request->response_of_rpu],
            ['name' => 'audit_conclusion', 'contents' => $request->audit_conclusion],
            ['name' => 'audit_recommendation', 'contents' => $request->audit_recommendation],
            ['name' => 'jorito_ortho_poriman', 'contents' => $request->jorito_ortho_poriman],
            ['name' => 'onishponno_jorito_ortho_poriman', 'contents' => $request->onishponno_jorito_ortho_poriman],
            ['name' => 'audit_year_start', 'contents' => $request->audit_year_start],
            ['name' => 'audit_year_end', 'contents' => $request->audit_year_end],
            ['name' => 'memo_irregularity_type', 'contents' => $request->memo_irregularity_type],
            ['name' => 'memo_irregularity_sub_type', 'contents' => $request->memo_irregularity_sub_type],
            ['name' => 'memo_type', 'contents' => $request->memo_type],
            ['name' => 'memo_status', 'contents' => $request->memo_status],
            ['name' => 'cdesk', 'contents' => json_encode($this->current_desk(), JSON_UNESCAPED_UNICODE)],
        ];

        $appendix_file = $request->porisishto;
        if ($request->hasfile('porisishto')) {
            $data[] = [
                'name'     => 'porisishto',
                'contents' => file_get_contents($appendix_file->getRealPath()),
                'filename' => $appendix_file->getClientOriginalName(),
            ];
        }

        $authentic_file= $request->pramanok;
        if ($request->hasfile('pramanok')) {
            $data[] = [
                'name'     => 'pramanok',
                'contents' => file_get_contents($authentic_file->getRealPath()),
                'filename' => $authentic_file->getClientOriginalName(),
            ];
        }
        //dd($data);

        $response = $this->fileUPloadWithData(
            'POST',
            config('amms_bee_routes.audit_conduct_query.memo.update'),
            $data
        );

        return json_decode($response->getBody(), true);
    }

    public function authorityMemoList()
    {
        $all_directorates = $this->allAuditDirectorates();

        $fiscal_years = $this->allFiscalYears();

        $self_directorate = current(array_filter($all_directorates, function ($item) {
            return $this->current_office_id() == $item['office_id'];
        }));

        $directorates = $self_directorate ? [$self_directorate] : $all_directorates;

        if (!empty($directorates)) {
            return view('modules.audit_execution.audit_execution_memo.authority_memo_list', compact('directorates', 'fiscal_years'));
        } else {
            return response()->json(['status' => 'error', 'data' => $directorates]);
        }

    }

    public function loadAuthorityMemoList(Request $request){
//        dd($request->all());

        $data['cdesk'] = json_encode_unicode($this->current_desk());
        $data['office_id'] = $request->directorate_id;
        $data['team_id'] = $request->team_id;
        $data['fiscal_year_id'] = $request->fiscal_year_id;
        $data['cost_center_id'] = $request->cost_center_id;
        $data['memo_irregularity_type'] = $request->memo_irregularity_type;
        $data['memo_irregularity_sub_type'] = $request->memo_irregularity_sub_type;
        $data['memo_type'] = $request->memo_type;
        $data['memo_status'] = $request->memo_status;
        $data['jorito_ortho_poriman'] = $request->jorito_ortho_poriman;
        $data['audit_year_start'] = $request->audit_year_start;
        $data['audit_year_end'] = $request->audit_year_end;

        $memo_list = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.memo.authority_memo_list'), $data)->json();
//        dd($memo_list);
        if (isSuccess($memo_list)) {
            $memo_list = $memo_list['data'];
            $team_id = $request->team_id;
            $cost_center_id = $request->cost_center_id;
            return view('modules.audit_execution.audit_execution_memo.partials.load_authority_memo_list', compact('memo_list', 'team_id','cost_center_id'));
        } else {
            return response()->json(['status' => 'error', 'data' => $memo_list]);
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
        //
    }


    public function memoPDFDownload(Request $request)
    {
        $data = Validator::make($request->all(), [
            'memo_id' => 'required|integer',
        ])->validate();
        $data['cdesk'] = json_encode($this->current_desk(), JSON_UNESCAPED_UNICODE);
        $responseData = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.memo.edit'), $data)->json();
        //dd($responseData);
        $memoInfo = isSuccess($responseData)?$responseData['data']:[];
        $pdf = \PDF::loadView('modules.audit_execution.audit_execution_memo.partials.memo_book',compact('memoInfo'));
        return $pdf->stream('document.pdf');
    }

    public function auditMemoRecommendation(Request $request){
        $data = Validator::make($request->all(), [
            'memo_id' => 'required',
        ])->validate();

        $data['cdesk'] = json_encode($this->current_desk(), JSON_UNESCAPED_UNICODE);

        $recommendation_list = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.memo.audit_memo_recommendation_list'), $data)->json();
//        dd($recommendation_list);
        if (isSuccess($recommendation_list)) {
            $memo_id = $request->memo_id;
            $recommendation_list = $recommendation_list['data'];
            return view('modules.audit_execution.audit_execution_memo.memo_recommendation.memo_recommendation_list', compact('recommendation_list','memo_id'));
        } else {
            return response()->json(['status' => 'error', 'data' => $recommendation_list]);
        }
    }

    public function auditMemoRecommendationStore(Request $request){
        $data = Validator::make($request->all(), [
            'memo_id' => 'required',
            'audit_recommendation' => 'required',
        ])->validate();

        $data['cdesk'] = json_encode($this->current_desk(), JSON_UNESCAPED_UNICODE);
//        dd($data);
        $auditMemoRecommendation = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.memo.audit_memo_recommendation_store'), $data)->json();
        if (isSuccess($auditMemoRecommendation)) {
            return response()->json(['status' => 'success', 'data' => 'Saved Successfully']);
        } else {
            return response()->json(['status' => 'error', 'data' => $auditMemoRecommendation]);
        }
    }

    public function auditMemoLog(Request $request){
        $data = Validator::make($request->all(), [
            'memo_id' => 'required',
        ])->validate();

        $data['cdesk'] = json_encode($this->current_desk(), JSON_UNESCAPED_UNICODE);

        $log_list = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.memo.audit_memo_log_list'), $data)->json();
//        dd($log_list);
        if (isSuccess($log_list)) {
            $memo_id = $request->memo_id;
            $log_list = $log_list['data'];
            return view('modules.audit_execution.audit_execution_memo.memo_log.memo_log_list', compact('log_list','memo_id'));
        } else {
            return response()->json(['status' => 'error', 'data' => $log_list]);
        }
    }

    public function auditMemoShow(Request $request){
        $memo_log_info = json_decode($request->log_info,true);
        return view('modules.audit_execution.audit_execution_memo.memo_log.show_memo_log', compact('memo_log_info'));
    }
}
