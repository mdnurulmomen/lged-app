<?php

namespace App\Http\Controllers\AuditExecution;

use App\Http\Controllers\Controller;
use App\Services\FireNotificationServices;
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
        $team_leader_name = $request->team_leader_name;
        $team_leader_designation_name = $request->team_leader_designation_name;
        $scope_sub_team_leader = $request->scope_sub_team_leader;
        $sub_team_leader_name = $request->sub_team_leader_name;
        $sub_team_leader_designation_name = $request->sub_team_leader_designation_name;
        return view('modules.audit_execution.audit_execution_memo.index',
            compact('schedule_id', 'audit_plan_id', 'cost_center_id', 'cost_center_name_bn',
                'audit_year_start', 'audit_year_end', 'team_leader_name', 'team_leader_designation_name',
                'scope_sub_team_leader', 'sub_team_leader_name', 'sub_team_leader_designation_name'));
    }

    public function list(Request $request)
    {
        $data = Validator::make($request->all(), [
            'audit_plan_id' => 'required|integer',
            'cost_center_id' => 'required|integer',
            'per_page' => 'required|integer',
            'page' => 'required|integer',
        ])->validate();
        $data['cdesk'] = $this->current_desk_json();
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
        $audit_plan_id = $request->audit_plan_id;
        $cost_center_id = $request->cost_center_id;
        $cost_center_name_bn = $request->cost_center_name_bn;
        $audit_year_start = $request->audit_year_start;
        $audit_year_end = $request->audit_year_end;
        $team_leader_name = $request->team_leader_name;
        $team_leader_designation_name = $request->team_leader_designation_name;
        $scope_sub_team_leader = $request->scope_sub_team_leader;
        $sub_team_leader_name = $request->sub_team_leader_name;
        $sub_team_leader_designation_name = $request->sub_team_leader_designation_name;

        return view('modules.audit_execution.audit_execution_memo.create',
            compact('schedule_id', 'audit_plan_id', 'cost_center_id', 'cost_center_name_bn',
                'audit_year_start', 'audit_year_end', 'team_leader_name', 'team_leader_designation_name',
                'scope_sub_team_leader', 'sub_team_leader_name', 'sub_team_leader_designation_name'));
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
            'schedule_id' => 'required',
            'memo_title_bn' => 'required',
            'memo_description_bn' => 'required',
            'jorito_ortho_poriman' => 'required',
            'audit_year_start' => 'required',
            'audit_year_end' => 'required',
        ])->validate();

        $data = [
            ['name' => 'team_member_schedule_id', 'contents' => $request->schedule_id],
            ['name' => 'memo_title_bn', 'contents' => $request->memo_title_bn],
            ['name' => 'memo_description_bn', 'contents' => $request->memo_description_bn],
            ['name' => 'irregularity_cause', 'contents' => $request->irregularity_cause],
            ['name' => 'response_of_rpu', 'contents' => $request->response_of_rpu],
            ['name' => 'jorito_ortho_poriman', 'contents' => $request->jorito_ortho_poriman],
            ['name' => 'audit_year_start', 'contents' => $request->audit_year_start],
            ['name' => 'audit_year_end', 'contents' => $request->audit_year_end],
            ['name' => 'memo_irregularity_type', 'contents' => $request->memo_irregularity_type],
            ['name' => 'memo_irregularity_sub_type', 'contents' => $request->memo_irregularity_sub_type],
            ['name' => 'memo_type', 'contents' => 0],
            ['name' => 'memo_status', 'contents' => 0],
            ['name' => 'team_leader_name', 'contents' => $request->team_leader_name],
            ['name' => 'team_leader_designation', 'contents' => $request->team_leader_designation],
            ['name' => 'sub_team_leader_name', 'contents' => $request->sub_team_leader_name],
            ['name' => 'sub_team_leader_designation', 'contents' => $request->sub_team_leader_designation],
            ['name' => 'issued_by', 'contents' => $request->issued_by],
            ['name' => 'rpu_acceptor_officer_name_bn', 'contents' => $request->rpu_acceptor_officer_name_bn],
            ['name' => 'rpu_acceptor_designation_name_bn', 'contents' => $request->rpu_acceptor_designation_name_bn],
            ['name' => 'cdesk', 'contents' => $this->current_desk_json()],
        ];

        //for porisishtos
        if ($request->hasfile('porisishtos')) {
            foreach ($request->file('porisishtos') as $file) {
                $data[] = [
                    'name' => 'porisishtos[]',
                    'contents' => file_get_contents($file->getRealPath()),
                    'filename' => $file->getClientOriginalName(),
                ];
            }
        }


        //for pramanoks
        if ($request->hasfile('pramanoks')) {
            foreach ($request->file('pramanoks') as $file) {
                $data[] = [
                    'name' => 'pramanoks[]',
                    'contents' => file_get_contents($file->getRealPath()),
                    'filename' => $file->getClientOriginalName(),
                ];
            }
        }


        //for memos
        /*if ($request->hasfile('memos')) {
            foreach ($request->file('memos') as $file){
                $data[] = [
                    'name'     => 'memos[]',
                    'contents' => file_get_contents($file->getRealPath()),
                    'filename' => $file->getClientOriginalName(),
                ];
            }
        }*/


        $response = $this->fileUPloadWithData(
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
        $data['cdesk'] = $this->current_desk_json();
        if ($request->directorate_id) {
            $data['directorate_id'] = $request->directorate_id;
        }
        $memoInfo = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.memo.edit'), $data)->json();
        $directorateName = $this->current_office()['office_name_bn'];
        if ($this->current_office_id() == 14) {
            $directorateAddress = 'অডিট কমপ্লেক্স (৩য় তলা) <br> সেগুনবাগিচা,ঢাকা-১০০০।';
            $directorateWebsite = 'www.worksaudit.org.bd';
        } elseif ($this->current_office_id() == 3) {
            $directorateAddress = 'অডিট কমপ্লেক্স (২য় তলা) <br> সেগুনবাগিচা,ঢাকা-১০০০।';
            $directorateWebsite = 'www.dgcivil-cagbd.org';
        } else {
            $directorateAddress = 'অডিট কমপ্লেক্স (৮ম তলা) <br> সেগুনবাগিচা,ঢাকা-১০০০।';
            $directorateWebsite = 'www.cad.org.bd';
        }

        //dd($memoInfo);

        if (isSuccess($memoInfo)) {
            $memoInfo = $memoInfo['data'];
            return view('modules.audit_execution.audit_execution_memo.show',
                compact('memoInfo', 'directorateAddress', 'directorateWebsite', 'directorateName'));
        } else {
            return response()->json(['status' => 'error', 'data' => $memoInfo]);
        }
    }

    public function showAttachment(Request $request)
    {
        $data = Validator::make($request->all(), [
            'memo_id' => 'required|integer',
            'memo_title_bn' => 'required',
        ])->validate();
        $data['cdesk'] = $this->current_desk_json();
        $attachments = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.memo.attachment_list'), $data)->json();
        //dd($attachments);
        if (isSuccess($attachments)) {
            $attachments = $attachments['data'];
            $memoTitleBn = $request->memo_title_bn;
            return view('modules.audit_execution.audit_execution_memo.partials.load_memo_attachment',
                compact('attachments', 'memoTitleBn'));
        } else {
            return response()->json(['status' => 'error', 'data' => $attachments]);
        }
    }

    public function showDetails(Request $request)
    {
        $data = Validator::make($request->all(), [
            'memo_id' => 'required|integer',
        ])->validate();
        $data['cdesk'] = $this->current_desk_json();
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
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse
     */
    public function edit(Request $request)
    {
        $data = Validator::make($request->all(), [
            'memo_id' => 'required|integer',
        ])->validate();
        $data['cdesk'] = $this->current_desk_json();
        $memo = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.memo.info'), $data)->json();

        $schedule_id = $request->schedule_id;
        $audit_plan_id = $request->audit_plan_id;
        $cost_center_id = $request->cost_center_id;
        $cost_center_name_bn = $request->cost_center_name_bn;
        $audit_year_start = $request->audit_year_start;
        $audit_year_end = $request->audit_year_end;
        $team_leader_name = $request->team_leader_name;
        $team_leader_designation_name = $request->team_leader_designation_name;
        $scope_sub_team_leader = $request->scope_sub_team_leader;
        $sub_team_leader_name = $request->sub_team_leader_name;
        $sub_team_leader_designation_name = $request->sub_team_leader_designation_name;

        if (isSuccess($memo)) {
            $memoInfo = $memo['data'];
            return view('modules.audit_execution.audit_execution_memo.edit',
                compact('memoInfo', 'schedule_id', 'audit_plan_id', 'cost_center_id', 'cost_center_name_bn',
                    'audit_year_start', 'audit_year_end', 'team_leader_name', 'team_leader_designation_name',
                    'scope_sub_team_leader', 'sub_team_leader_name', 'sub_team_leader_designation_name'));
        } else {
            return response()->json(['status' => 'error', 'data' => $memo]);
        }
    }

    public function sentToRpu(Request $request)
    {
        $data = Validator::make($request->all(), [
            'memo_id' => 'required',
            'memo_sharok_no' => 'required',
            'memo_cc' => 'nullable',
            'issued_by' => 'required',
            'memo_send_date' => 'required',
            'rpu_acceptor_designation_name_bn' => 'nullable',
        ])->validate();
        $data['cdesk'] = $this->current_desk_json();

        if ($this->current_office_id() == 14) {
            $data['directorate_address'] = 'অডিট কমপ্লেক্স (৩য় তলা) <br> সেগুনবাগিচা,ঢাকা-১০০০।';
            $data['directorate_website'] = 'www.worksaudit.org.bd';
        } elseif ($this->current_office_id() == 3) {
            $data['directorate_address'] = 'অডিট কমপ্লেক্স (২য় তলা) <br> সেগুনবাগিচা,ঢাকা-১০০০।';
            $data['directorate_website'] = 'www.dgcivil-cagbd.org';
        } else {
            $data['directorate_address'] = 'অডিট কমপ্লেক্স (৮ম তলা) <br> সেগুনবাগিচা,ঢাকা-১০০০।';
            $data['directorate_website'] = 'www.cad.org.bd';
        }

        $memoSendToRpu = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.memo.send_to_rpu'), $data)->json();

        if (isSuccess($memoSendToRpu)) {
            $mail_data = [
                'cost_center_ids' => $request->cost_center_id,
                'notifiable_type' => 'memo',
            ];
            $send_mail_to_rpu = (new FireNotificationServices())->sendMailToRpu($mail_data);

            return response()->json(['status' => 'success', 'data' => 'রেসপন্সিবল পার্টি বরাবর মেমো সফলভাবে পাঠানো হয়েছে']);
        } else {
            return response()->json(['status' => 'error', 'data' => $memoSendToRpu]);
        }
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
            'memo_id' => 'required',
            'memo_title_bn' => 'required',
            'memo_description_bn' => 'required',
            'jorito_ortho_poriman' => 'required',
            'audit_year_start' => 'required',
            'audit_year_end' => 'required',
        ])->validate();

        $data = [
            ['name' => 'memo_id', 'contents' => $request->memo_id],
            ['name' => 'memo_title_bn', 'contents' => $request->memo_title_bn],
            ['name' => 'memo_description_bn', 'contents' => $request->memo_description_bn],
            ['name' => 'irregularity_cause', 'contents' => $request->irregularity_cause],
            ['name' => 'response_of_rpu', 'contents' => $request->response_of_rpu],
            ['name' => 'jorito_ortho_poriman', 'contents' => $request->jorito_ortho_poriman],
            ['name' => 'audit_year_start', 'contents' => $request->audit_year_start],
            ['name' => 'audit_year_end', 'contents' => $request->audit_year_end],
            ['name' => 'memo_irregularity_type', 'contents' => $request->memo_irregularity_type],
            ['name' => 'memo_irregularity_sub_type', 'contents' => $request->memo_irregularity_sub_type],
            ['name' => 'memo_type', 'contents' => 0],
            ['name' => 'memo_status', 'contents' => 0],
            ['name' => 'cdesk', 'contents' => $this->current_desk_json()],
        ];

        //for porisishtos
        if ($request->hasfile('porisishtos')) {
            foreach ($request->file('porisishtos') as $file) {
                $data[] = [
                    'name' => 'porisishtos[]',
                    'contents' => file_get_contents($file->getRealPath()),
                    'filename' => $file->getClientOriginalName(),
                ];
            }
        }


        //for pramanoks
        if ($request->hasfile('pramanoks')) {
            foreach ($request->file('pramanoks') as $file) {
                $data[] = [
                    'name' => 'pramanoks[]',
                    'contents' => file_get_contents($file->getRealPath()),
                    'filename' => $file->getClientOriginalName(),
                ];
            }
        }


        $response = $this->fileUPloadWithData(
            config('amms_bee_routes.audit_conduct_query.memo.update'),
            $data,
            'POST',
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

    public function loadAuthorityMemoList(Request $request)
    {
//        dd($request->all());

        $data['cdesk'] = $this->current_desk_json();
        $data['office_id'] = $request->directorate_id;
        $data['team_id'] = $request->team_id;
        $data['fiscal_year_id'] = $request->fiscal_year_id;
        $data['entity_id'] = $request->entity_id;
        $data['activity_id'] = $request->activity_id;
        $data['cost_center_id'] = $request->cost_center_id;
        $data['memo_irregularity_type'] = $request->memo_irregularity_type;
        $data['memo_irregularity_sub_type'] = $request->memo_irregularity_sub_type;
        $data['memo_type'] = $request->memo_type;
        $data['memo_status'] = $request->memo_status;
        $data['jorito_ortho_poriman'] = $request->jorito_ortho_poriman;
        $data['audit_year_start'] = $request->audit_year_start;
        $data['audit_year_end'] = $request->audit_year_end;

        $get_memo_list = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.memo.authority_memo_list'), $data)->json();
//        dd($get_memo_list);
        //        dd($memo_list['data']['total_memo']);
        if (isSuccess($get_memo_list)) {
            $memo_list = $get_memo_list['data']['memo_list'];
            $total_memo = $get_memo_list['data']['total_memo'];
            $team_id = $request->team_id;
            $cost_center_id = $request->cost_center_id;
            return view('modules.audit_execution.audit_execution_memo.partials.load_authority_memo_list', compact('memo_list', 'team_id', 'cost_center_id', 'total_memo'));
        } else {
            return response()->json(['status' => 'error', 'data' => $get_memo_list]);
        }
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


    public function memoPDFDownload(Request $request)
    {
        $data = Validator::make($request->all(), [
            'memo_id' => 'required|integer',
        ])->validate();
        $data['cdesk'] = $this->current_desk_json();
        $responseData = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.memo.edit'), $data)->json();
        //dd($responseData);
        $memoInfo = isSuccess($responseData) ? $responseData['data'] : [];

        $directorateName = $this->current_office()['office_name_bn'];
        if ($this->current_office_id() == 14) {
            $directorateAddress = 'অডিট কমপ্লেক্স (৩য় তলা) <br> সেগুনবাগিচা,ঢাকা-১০০০।';
            $directorateWebsite = 'www.worksaudit.org.bd';
        } elseif ($this->current_office_id() == 3) {
            $directorateAddress = 'অডিট কমপ্লেক্স (২য় তলা) <br> সেগুনবাগিচা,ঢাকা-১০০০।';
            $directorateWebsite = 'www.dgcivil-cagbd.org';
        } else {
            $directorateAddress = 'অডিট কমপ্লেক্স (৮ম তলা) <br> সেগুনবাগিচা,ঢাকা-১০০০।';
            $directorateWebsite = 'www.cad.org.bd';
        }

        $pdf = \PDF::loadView('modules.audit_execution.audit_execution_memo.partials.memo_book',
            compact('memoInfo', 'directorateName', 'directorateAddress', 'directorateWebsite'));
        return $pdf->stream('document.pdf');
    }

    public function auditMemoRecommendation(Request $request)
    {
        $data = Validator::make($request->all(), [
            'memo_id' => 'required',
        ])->validate();

        $data['cdesk'] = $this->current_desk_json();

        $recommendation_list = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.memo.audit_memo_recommendation_list'), $data)->json();
//        dd($recommendation_list);
        if (isSuccess($recommendation_list)) {
            $memo_id = $request->memo_id;
            $recommendation_list = $recommendation_list['data'];
            return view('modules.audit_execution.audit_execution_memo.memo_recommendation.memo_recommendation_list', compact('recommendation_list', 'memo_id'));
        } else {
            return response()->json(['status' => 'error', 'data' => $recommendation_list]);
        }
    }

    public function auditMemoRecommendationStore(Request $request)
    {
        $data = Validator::make($request->all(), [
            'memo_id' => 'required',
            'audit_recommendation' => 'required',
        ])->validate();

        $data['cdesk'] = $this->current_desk_json();
//        dd($data);
        $auditMemoRecommendation = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.memo.audit_memo_recommendation_store'), $data)->json();
        if (isSuccess($auditMemoRecommendation)) {
            return response()->json(['status' => 'success', 'data' => 'Saved Successfully']);
        } else {
            return response()->json(['status' => 'error', 'data' => $auditMemoRecommendation]);
        }
    }

    public function auditMemoLog(Request $request)
    {
        $data = Validator::make($request->all(), [
            'memo_id' => 'required',
        ])->validate();

        $data['cdesk'] = $this->current_desk_json();

        $log_list = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.memo.audit_memo_log_list'), $data)->json();
//        dd($log_list);
        if (isSuccess($log_list)) {
            $memo_id = $request->memo_id;
            $log_list = $log_list['data'];
            return view('modules.audit_execution.audit_execution_memo.memo_log.memo_log_list', compact('log_list', 'memo_id'));
        } else {
            return response()->json(['status' => 'error', 'data' => $log_list]);
        }
    }

    public function auditMemoShow(Request $request)
    {
        $memo_log_info = json_decode($request->log_info, true);
        return view('modules.audit_execution.audit_execution_memo.memo_log.show_memo_log', compact('memo_log_info'));
    }

    public function sendMemoForm(Request $request)
    {
        $memo_id = $request->memo_id;
        $data = Validator::make($request->all(), [
            'memo_id' => 'required|integer',
        ])->validate();
        $data['cdesk'] = $this->current_desk_json();
        $memoInfo = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.memo.edit'), $data)->json();
        $memoInfo = isSuccess($memoInfo) ? $memoInfo['data'] : [];
        return view('modules.audit_execution.audit_execution_memo.send_memo_form',
            compact('memoInfo'));
    }

    public function deleteMemoAttachment(Request $request)
    {
        $data = Validator::make($request->all(), [
            'memo_attachment_id' => 'required',
        ])->validate();

        $data['memo_attachment_id'] = $request->memo_attachment_id;
        $data['cdesk'] = $this->current_desk_json();
        $responseData = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.memo.audit_memo_attachment_delete'), $data)->json();
        if (isSuccess($responseData)) {
            return response()->json(['status' => 'success', 'data' => 'Delete Successfully']);
        } else {
            return response()->json(['status' => 'error', 'data' => $responseData]);
        }
    }
}
