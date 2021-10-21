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
        return view('modules.audit_execution.audit_execution_memo.partials.load_memo_list',
            compact('schedule_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $schedule_id = $request->schedule_id;
        return view('modules.audit_execution.audit_execution_memo.create',
            compact('schedule_id'));
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
            /*'appendix_file' => 'required|max:10420',*/
        ])->validate();

        $data = [
            ['name' => 'schedule_id', 'contents' => $request->schedule_id],
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

        $appendix_file = $request->appendix_file;
        if ($request->hasfile('appendix_file')) {
            $data[] = [
                'name'     => 'file',
                'contents' => file_get_contents($appendix_file->getRealPath()),
                'filename' => $appendix_file->getClientOriginalName(),
            ];
        }

        $authentic_file= $request->authentic_file;
        if ($request->hasfile('authentic_file')) {
            $data[] = [
                'name'     => 'file',
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
}