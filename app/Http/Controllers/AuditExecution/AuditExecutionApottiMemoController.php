<?php

namespace App\Http\Controllers\AuditExecution;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuditExecutionApottiMemoController extends Controller
{
    public function apottiMemoPage()
    {
        $this->userPermittedMenusByModule(request()->path());
        return view('modules.audit_execution.audit_execution_apotti_memo.page');
    }

    public function index()
    {
        $all_directorates = $this->allAuditDirectorates();
        $fiscal_years = $this->allFiscalYears();
        $self_directorate = current(array_filter($all_directorates, function ($item) {
            return $this->current_office_id() == $item['office_id'];
        }));
        $directorates = $self_directorate ? [$self_directorate] : $all_directorates;

        if (!empty($directorates)) {
            return view('modules.audit_execution.audit_execution_apotti_memo.index',compact('directorates', 'fiscal_years')
            );
        } else {
            return response()->json(['status' => 'error', 'data' => $directorates]);
        }
    }

    public function loadMemoList(Request $request)
    {
        if (session::has('dashboard_filter_data')) {
            Session::forget('dashboard_filter_data');
        }

        $data['cdesk'] = $this->current_desk_json();
        $data['office_id'] = $request->directorate_id;
        $data['fiscal_year_id'] = $request->fiscal_year_id;
        $data['entity_id'] = $request->entity_id;
        $data['activity_id'] = $request->activity_id;
        $data['cost_center_id'] = $request->cost_center_id;
        $data['jorito_ortho_poriman'] = $request->jorito_ortho_poriman;
        $data['has_convert_to_apotti'] = $request->has_convert_to_apotti;
        $data['page'] = $request->page;
        $data['per_page'] = $request->per_page;

        $get_memo_list = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.apotti.apotti-memo-list'), $data)->json();
        //dd($get_memo_list);
        //dd($memo_list['data']['total_memo']);
        if (isSuccess($get_memo_list)) {
            $memos = $get_memo_list['data']['memo_list'];
            // dd($memos);
            $memo_list = $get_memo_list['data']['memo_list']['data'];
            $total_memo = $get_memo_list['data']['total_memo'];
            return view('modules.audit_execution.audit_execution_apotti_memo.partials.load_memo_list', compact('memo_list', 'total_memo', 'memos'));
        } else {
            return response()->json(['status' => 'error', 'data' => $get_memo_list]);
        }
    }

    public function edit(Request $request){
        $data = Validator::make($request->all(), [
            'memo_id' => 'required|integer',
        ])->validate();
        $data['cdesk'] = $this->current_desk_json();
        $memo = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.memo.info'), $data)->json();

        if (isSuccess($memo)) {
            $memoInfo = $memo['data'];
            return view('modules.audit_execution.audit_execution_apotti_memo.edit',compact('memoInfo'));
        } else {
            return response()->json(['status' => 'error', 'data' => $memo]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function convertMemoToApotti(Request $request)
    {
        Validator::make(
            $request->all(),
            [
                'memo_id' => 'required',
                'memo_title_bn' => 'required',
                'memo_description_bn' => 'required',
                'jorito_ortho_poriman' => 'required',
                'audit_conclusion' => 'required',
                'audit_recommendation' => 'required',
            ],
            [
                'memo_id.required' => 'Memo id is required',
                'memo_title_bn.required' => 'Memo title is required',
                'memo_description_bn.required' => 'Memo description is required',
                'jorito_ortho_poriman.required' => 'Jorito ortho is required',
                'audit_conclusion.required' => 'Audit conclusion is required',
                'audit_recommendation.required' => 'Audit recommendation is required',
            ]
        )->validate();

        $data = [
            ['name' => 'memo_id', 'contents' => $request->memo_id],
            ['name' => 'memo_title_bn', 'contents' => $request->memo_title_bn],
            ['name' => 'memo_description_bn', 'contents' => $request->memo_description_bn],
            ['name' => 'irregularity_cause', 'contents' => $request->irregularity_cause],
            ['name' => 'response_of_rpu', 'contents' => $request->response_of_rpu],
            ['name' => 'jorito_ortho_poriman', 'contents' => $request->jorito_ortho_poriman],
            ['name' => 'memo_irregularity_type', 'contents' => $request->memo_irregularity_type],
            ['name' => 'memo_irregularity_sub_type', 'contents' => $request->memo_irregularity_sub_type],
            ['name' => 'rpu_acceptor_officer_name_bn', 'contents' => $request->rpu_acceptor_officer_name_bn],
            ['name' => 'rpu_acceptor_designation_name_bn', 'contents' => $request->rpu_acceptor_designation_name_bn],
            ['name' => 'audit_conclusion', 'contents' => $request->audit_conclusion],
            ['name' => 'audit_recommendation', 'contents' => $request->audit_recommendation],
            ['name' => 'cdesk', 'contents' => $this->current_desk_json()],
        ];

        if (isset($request->porisisto_details)){
            foreach ($request->porisisto_details as $porisisto) {
                $data[] = [
                    'name' => 'porisisto_details[]',
                    'contents' => $porisisto,
                ];
            }
        }

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
            config('amms_bee_routes.audit_conduct_query.apotti.convert-memo-to-apotti'),
            $data,
            'POST',
        );

        return json_decode($response->getBody(), true);
    }
}
