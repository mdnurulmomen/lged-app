<?php

namespace App\Http\Controllers\AuditExecution;

use App\Http\Controllers\Controller;
use App\Services\FireNotificationServices;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
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
        // dd($request->all());
        $schedule_id = $request->schedule_id;
        $team_id = $request->team_id;
        $audit_plan_id = $request->audit_plan_id;
        $cost_center_id = $request->cost_center_id;
        $cost_center_name_bn = $request->cost_center_name_bn;
        $cost_center_name_en = $request->cost_center_name_en;
        $audit_year_start = $request->audit_year_start;
        $audit_year_end = $request->audit_year_end;
        $team_leader_name = $request->team_leader_name;
        $team_leader_designation_name = $request->team_leader_designation_name;
        $scope_sub_team_leader = $request->scope_sub_team_leader;
        $sub_team_leader_name = $request->sub_team_leader_name;
        $sub_team_leader_designation_name = $request->sub_team_leader_designation_name;
        $project_id = $request->project_id;
        $project_name_bn = $request->project_name_bn;
        $project_name_en = $request->project_name_en;

        return view(
            'modules.audit_execution.audit_execution_memo.index',
            compact(
                'schedule_id',
                'team_id',
                'audit_plan_id',
                'cost_center_id',
                'cost_center_name_bn',
                'cost_center_name_en',
                'audit_year_start',
                'audit_year_end',
                'team_leader_name',
                'team_leader_designation_name',
                'scope_sub_team_leader',
                'sub_team_leader_name',
                'sub_team_leader_designation_name',
                'project_id',
                'project_name_bn',
                'project_name_en',
            )
        );
    }

    public function list(Request $request)
    {
        $data = Validator::make($request->all(), [
            'audit_plan_id' => 'nullable',
            'cost_center_id' => 'required|integer',
            'per_page' => 'required|integer',
            'page' => 'required|integer',
        ])->validate();
        $data['cdesk'] = $this->current_desk_json();
        $memo_list = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.memo.list'), $data)->json();
        // dd($memo_list);
        if (isSuccess($memo_list)) {
            $memo_list = $memo_list['data'];
            // dd($memo_list);
            return view(
                'modules.audit_execution.audit_execution_memo.partials.load_memo_list',
                compact('memo_list')
            );
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
        // dd($request->all());
        $data = Validator::make($request->all(), [
            'audit_plan_id' => 'nullable',
            'team_id' => 'required|integer',
        ])->validate();

        $schedule_id = $request->schedule_id;
        $team_id = $request->team_id;
        $audit_plan_id = $request->audit_plan_id;
        $cost_center_id = $request->cost_center_id;
        $cost_center_name_bn = $request->cost_center_name_bn;
        $cost_center_name_en = $request->cost_center_name_en;
        $audit_year_start = $request->audit_year_start;
        $audit_year_end = $request->audit_year_end;
        $project_id = $request->project_id;
        $project_name_en = $request->project_name_en;
        $project_name_bn = $request->project_name_bn;
        // $team_members = $this->getPlanAndTeamWiseTeamMembers(0,$audit_plan_id,$team_id);
        // $get_team = $this->getTeam($team_id);
        //dd(json_decode($get_team['team_members'],true));

        return view(
            'modules.audit_execution.audit_execution_memo.create',
            compact(
                'schedule_id',
                'team_id',
                'audit_plan_id',
                'cost_center_id',
                'cost_center_name_bn',
                'cost_center_name_en',
                'audit_year_start',
                'audit_year_end',   
                'project_id',   
                'project_name_en',   
                'project_name_bn',   
            //     'team_members',
            //     'get_team',
            )
        );
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
                'issue_no' => 'required',
                'issue_title' => 'required',
                'audit_observation' => 'required',
                'criteria' => 'required',
                'cause' => 'required',
                'impact' => 'required',
                'risk_level' => 'required',
            ],
            [
                'issue_no.required' => 'Issue No is required',
                'issue_title.required' => 'Issue Title is required',
                'audit_observation.required' => 'Audit Observation is required',
                'criteria.required' => 'Criteria is required',
                'cause.required' => 'Cause is required',
                'impact.required' => 'Impact is required',
                'risk_level.required' => 'Risk Level is required',
            ]
        )->validate();

        $data = [
            ['name' => 'onucched_no', 'contents' => $request->issue_no],
            ['name' => 'memo_title_bn', 'contents' => $request->issue_title],
            ['name' => 'audit_observation', 'contents' => $request->audit_observation],
            ['name' => 'criteria', 'contents' => $request->criteria],
            ['name' => 'cause', 'contents' => json_encode($request->cause)],

            ['name' => 'cost_center_id', 'contents' => $request->cost_center_id],
            ['name' => 'cost_center_name_bn', 'contents' => $request->cost_center_name_bn],
            ['name' => 'cost_center_name_en', 'contents' => $request->cost_center_name_en],

            ['name' => 'project_id', 'contents' => $request->project_id],
            ['name' => 'project_name_en', 'contents' => $request->project_name_en],
            ['name' => 'project_name_bn', 'contents' => $request->project_name_bn],

            ['name' => 'audit_plan_id', 'contents' => $request->audit_plan_id],
            ['name' => 'audit_year_start', 'contents' => $request->audit_year_start],
            ['name' => 'audit_year_end', 'contents' => $request->audit_year_end],
            ['name' => 'impact', 'contents' => $request->impact],
            ['name' => 'risk_level', 'contents' => $request->risk_level],

            ['name' => 'cdesk', 'contents' => $this->current_desk_json()],
        ];
        
        /*['name' => 'porisisto_details', 'contents' => $request->porisisto_details],*/

        // foreach ($request->porisisto_details as $porisisto) {
        //     $data[] = [
        //         'name' => 'porisisto_details[]',
        //         'contents' => $porisisto,
        //     ];
        // }


        //for porisishtos
        /*if ($request->hasfile('porisishtos')) {
            foreach ($request->file('porisishtos') as $file) {
                $data[] = [
                    'name' => 'porisishtos[]',
                    'contents' => file_get_contents($file->getRealPath()),
                    'filename' => $file->getClientOriginalName(),
                ];
            }
        }*/


        //for pramanoks
        // if ($request->hasfile('pramanoks')) {
        //     foreach ($request->file('pramanoks') as $file) {
        //         $data[] = [
        //             'name' => 'pramanoks[]',
        //             'contents' => file_get_contents($file->getRealPath()),
        //             'filename' => $file->getClientOriginalName(),
        //         ];
        //     }
        // }


        //for findings
        if ($request->hasfile('findings')) {
            foreach ($request->file('findings') as $file){
                $data[] = [
                    'name'     => 'findings[]',
                    'contents' => file_get_contents($file->getRealPath()),
                    'filename' => $file->getClientOriginalName(),
                ];
            }
        }
        
        // dd($data);
        
        $response = $this->fileUPloadWithData(
            config('amms_bee_routes.audit_conduct_query.memo.store'),
            $data
        );
        // dd(json_decode($response->getBody(), true));
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

        $directorate_id = $request->directorate_id ?: $this->current_office_id();
        $memoInfo = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.memo.info'), $data)->json();

        if (isSuccess($memoInfo)) {
            $memoInfoDetails = $memoInfo['data'];
            // dd($memoInfoDetails['memo']);
            return view(
                'modules.audit_execution.audit_execution_memo.show',
                compact(
                    'memoInfoDetails',
                    'directorate_id'
                )
            );
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

        if ($request->directorate_id) {
            $data['directorate_id'] = $request->directorate_id;
        }
        $data['cdesk'] = $this->current_desk_json();
        $attachments = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.memo.attachment_list'), $data)->json();
        //dd($attachments);
        if (isSuccess($attachments)) {
            $attachments = $attachments['data'];
            $memoTitleBn = $request->memo_title_bn;
            return view(
                'modules.audit_execution.audit_execution_memo.partials.load_memo_attachment',
                compact('attachments', 'memoTitleBn')
            );
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
            return view(
                'modules.audit_execution.audit_execution_memo.show_details',
                compact('memo_info')
            );
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
        // dd($memo);
        
        $schedule_id = $request->schedule_id;
        $memo_id = $request->memo_id;
        $team_id = $request->team_id;
        $audit_plan_id = $request->audit_plan_id;
        $cost_center_id = $request->cost_center_id;
        $cost_center_name_bn = $request->cost_center_name_bn;
        $cost_center_name_en = $request->cost_center_name_en;
        $audit_year_start = $request->audit_year_start;
        $audit_year_end = $request->audit_year_end;
        $team_members = $this->getPlanAndTeamWiseTeamMembers(0,$audit_plan_id,$team_id);
        $get_team = $this->getTeam($request->team_id);

        if (isSuccess($memo)) {
            $memoInfo = $memo['data'];
            $issue_no = $memoInfo['findings']['onucched_no'];
            $issue_title = $memoInfo['findings']['memo_title_bn'];
            $audit_observation = $memoInfo['findings']['audit_observation'];
            $criteria = $memoInfo['findings']['criteria'];
            $impact = $memoInfo['findings']['impact'];
            $causes = json_decode($memoInfo['findings']['cause']);
            $risk_level = $memoInfo['findings']['risk_level'];
            $recommendation = $memoInfo['findings']['recommendation'];
            $m_response = $memoInfo['findings']['m_response'];
            $comment = $memoInfo['findings']['comment'];
            $action_taken = $memoInfo['findings']['action_taken'];
            $responsible_person = $memoInfo['findings']['responsible_person'];
            $date_to_be_implemented = $memoInfo['findings']['date_to_be_implemented'];
            $attachment_list = $memoInfo['findings']['ac_memo_attachments'];
            // dd($attachment_list);
            return view(
                'modules.audit_execution.audit_execution_memo.edit',
                compact(
                    'memoInfo',
                    'schedule_id',
                    'memo_id',
                    'team_id',
                    'audit_plan_id',
                    'cost_center_id',
                    'cost_center_name_bn',
                    'cost_center_name_en',
                    'audit_year_start',
                    'audit_year_end',
                    'team_members',
                    'get_team',
                    'issue_no',
                    'issue_title',
                    'audit_observation',
                    'criteria',
                    'causes',
                    'impact',
                    'risk_level',
                    'recommendation',
                    'm_response',
                    'comment',
                    'action_taken',
                    'responsible_person', 
                    'date_to_be_implemented', 
                    'attachment_list'
                )
            );
        } else {
            return response()->json(['status' => 'error', 'data' => $memo]);
        }
    }

    public function sentToRpu(Request $request)
    {
        $data = Validator::make(
            $request->all(),
            [
                'memo_id' => 'required',
                'memo_sharok_no' => 'required',
                'memo_cc' => 'nullable',
                'issued_by' => 'required',
                'memo_send_date' => 'required',
                'rpu_acceptor_designation_name_bn' => 'nullable',
            ],
            [
                'memo_id.required' => 'Memo is required',
                'memo_sharok_no.required' => 'Memorandum no is required',
                'memo_cc.required' => 'Memo cc is required',
                'issued_by.required' => 'Issued by is required',
                'memo_send_date.required' => 'Memo send date is required',
                'rpu_acceptor_designation_name_bn.required' => 'RP acceptor designation is required',
            ]
        )->validate();
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
            (new FireNotificationServices())->sendMailToRpu($mail_data); //for sent email
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
        // dd($request->all());
        Validator::make(
            $request->all(),
            [
                'memo_id' => 'required',
                'recommendation' => 'required',
                'm_response' => 'required',
                'auditor_comment' => 'required',
                'action_taken' => 'required',
                'date_to_be_implemented' => 'required',
            ],
            [
                'memo_id.required' => 'Memo id is required',
                'recommendation.required' => 'Recommendation is required',
                'm_response.required' => 'Management response is required',
                'auditor_comment.required' => 'Auditor comment is required',
                'action_taken.required' => 'Taken action is required',
                'date_to_be_implemented.required' => 'Date is required',
            ]
        )->validate();

        $data = [
            ['name' => 'memo_id', 'contents' => $request->memo_id],
            ['name' => 'recommendation', 'contents' => $request->recommendation],
            ['name' => 'm_response', 'contents' => $request->m_response],
            ['name' => 'auditor_comment', 'contents' => $request->auditor_comment],
            ['name' => 'action_taken', 'contents' => $request->action_taken],
            ['name' => 'responsible_person', 'contents' => $request->responsible_person],
            ['name' => 'date_to_be_implemented', 'contents' => $request->date_to_be_implemented],
            ['name' => 'memo_type', 'contents' => 0],
            ['name' => 'memo_status', 'contents' => 0],
            ['name' => 'cdesk', 'contents' => $this->current_desk_json()],
        ];
        // dd($data);

        //for findings
        // if ($request->hasfile('findings')) {
        //     foreach ($request->file('findings') as $file){
        //         $data[] = [
        //             'name'     => 'findings[]',
        //             'contents' => file_get_contents($file->getRealPath()),
        //             'filename' => $file->getClientOriginalName(),
        //         ];
        //     }
        // }


        //for porisishtos
        /*if ($request->hasfile('porisishtos')) {
            foreach ($request->file('porisishtos') as $file) {
                $data[] = [
                    'name' => 'porisishtos[]',
                    'contents' => file_get_contents($file->getRealPath()),
                    'filename' => $file->getClientOriginalName(),
                ];
            }
        }*/


        //for pramanoks
        // if ($request->hasfile('pramanoks')) {
        //     foreach ($request->file('pramanoks') as $file) {
        //         $data[] = [
        //             'name' => 'pramanoks[]',
        //             'contents' => file_get_contents($file->getRealPath()),
        //             'filename' => $file->getClientOriginalName(),
        //         ];
        //     }
        // }


        $response = $this->fileUPloadWithData(
            config('amms_bee_routes.audit_conduct_query.memo.update'),
            $data,
            'POST',
        );
        // dd(json_decode($response->getBody(), true));

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
            return view('modules.audit_execution.audit_execution_memo.authority_memo_list',compact('directorates', 'fiscal_years')
            );
        } else {
            return response()->json(['status' => 'error', 'data' => $directorates]);
        }
    }

    public function loadAuthorityMemoList(Request $request)
    {
        if (session::has('dashboard_filter_data')) {
            Session::forget('dashboard_filter_data');
        }

        $data['cdesk'] = $this->current_desk_json();
        $data['office_id'] = $request->directorate_id;
        $data['team_id'] = $request->team_id;
        $data['fiscal_year_id'] = $request->fiscal_year_id;
        $data['audit_plan_id'] = $request->audit_plan_id;
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
        $data['finder_officer_id'] = $request->finder_officer_id;
        $memo_code = $request->memo_code ?   explode('-',$request->memo_code) : '';
        $data['memo_code'] = $memo_code ?  $memo_code[1] : '';
        $data['page'] = $request->page;
        $data['per_page'] = $request->per_page;

        if ($request->start_date && $request->end_date) {
            $start_date = str_replace('/', '-', $request->start_date);
            $data['start_date'] = Carbon::parse($start_date)->format('Y-m-d');
            $end_date = str_replace('/', '-', $request->end_date);
            $data['end_date'] = Carbon::parse($end_date)->format('Y-m-d');
        }


        $get_memo_list = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.memo.authority_memo_list'), $data)->json();
//        dd($get_memo_list);
        //dd($memo_list['data']['total_memo']);
        if (isSuccess($get_memo_list)) {
            $memos = $get_memo_list['data']['memo_list'];
            // dd($memos);
            $memo_list = $get_memo_list['data']['memo_list']['data'];
            $total_memo = $get_memo_list['data']['total_memo'];
            $team_id = $request->team_id;
            $cost_center_id = $request->cost_center_id;
            return view('modules.audit_execution.audit_execution_memo.partials.load_authority_memo_list', compact('memo_list', 'team_id', 'cost_center_id', 'total_memo', 'memos'));
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
        $memoInfoDetails = isSuccess($responseData) ? $responseData['data'] : [];
        // dd($memoInfoDetails);

        $renderFile = $request->scope == 'findings'?'memo_book':'porisitho_book';
        //dd($memoInfo['ac_memo_porisishtos']);
        $pdf = \PDF::loadView(
            'modules.audit_execution.audit_execution_memo.partials.'.$renderFile,
            compact('memoInfoDetails')
        );
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
            'office_id' => 'required',
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
        return view(
            'modules.audit_execution.audit_execution_memo.send_memo_form',
            compact('memoInfo')
        );
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

    public function getAuditMemoFinderSelect(Request $request){
        $audit_plan_id = $request->audit_plan_id;
        $team_id = $request->team_id;
        $office_id = $request->office_id;

        $team_members = $this->getPlanAndTeamWiseTeamMembers($office_id,$audit_plan_id,$team_id);

//        dd($team_members);

        return view(
            'modules.audit_execution.audit_execution_memo.memo_finder_select',
            compact('team_members')
        );
    }
}
