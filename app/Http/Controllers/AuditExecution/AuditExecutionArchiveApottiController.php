<?php

namespace App\Http\Controllers\AuditExecution;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Svg\Tag\Rect;

class AuditExecutionArchiveApottiController extends Controller
{
    public function archivePage()
    {
        $this->userPermittedMenusByModule(request()->path());
        return view('modules.audit_execution.audit_execution_archive_apotti.archive');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $all_directorates = $this->allAuditDirectorates();
        $self_directorate = current(array_filter($all_directorates, function ($item) {
            return $this->current_office_id() == $item['office_id'];
        }));
        $directorates = $self_directorate ? [$self_directorate] : $all_directorates;

        $categoryResponseData = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.archive_apotti.get_oniyomer_category_list'), [])->json();
        $categories = isSuccess($categoryResponseData) ? $categoryResponseData['data'] : [];
        return view('modules.audit_execution.audit_execution_archive_apotti.index',compact('directorates', 'categories'));
    }

    public function create()
    {
        $all_directorates = $this->allAuditDirectorates();
        $self_directorate = current(array_filter($all_directorates, function ($item) {
            return $this->current_office_id() == $item['office_id'];
        }));
        $directorates = $self_directorate ? [$self_directorate] : $all_directorates;
        $categoryResponseData = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.archive_apotti.get_oniyomer_category_list'), [])->json();
        $categories = isSuccess($categoryResponseData) ? $categoryResponseData['data'] : [];
        return view(
            'modules.audit_execution.audit_execution_archive_apotti.create',
            compact('directorates', 'categories')
        );
    }

    public function list(Request $request)
    {
        $data['directorate_id'] = $request->directorate_id;
        $data['ministry_id'] = $request->ministry_id;
        $data['entity_id'] = $request->entity_id;
        $data['unit_group_office_id'] = $request->unit_group_office_id;
        $data['cost_center_id'] = $request->cost_center_id;
        $data['apotti_oniyomer_category_id'] = $request->apotti_oniyomer_category_id;
        $data['apotti_oniyomer_category_child_id'] = $request->apotti_oniyomer_category_child_id;
        $data['onucched_no'] = $request->onucched_no;
        $data['audit_year_start'] = $request->audit_year_start;
        $data['audit_year_end'] = $request->audit_year_end;
        $data['nirikkha_dhoron'] = $request->nirikkha_dhoron;
        $data['apottir_dhoron'] = $request->apottir_dhoron;
        $data['jorito_ortho_poriman'] = $request->jorito_ortho_poriman;

        $apotti_list = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.archive_apotti.list'), $data)->json();
        if (isSuccess($apotti_list)) {
            $apotti_list = $apotti_list['data'];
            return view('modules.audit_execution.audit_execution_archive_apotti.partials.load_apotti_list', compact('apotti_list'));
        } else {
            return response()->json(['status' => 'error', 'data' => $apotti_list]);
        }
    }

    public function loadDirectorateWiseMinistry(Request $request)
    {
        $data = Validator::make($request->all(), ['directorate_id' => 'integer|required'])->validate();
        $all_ministries = $this->initRPUHttp()->post(config('cag_rpu_api.get-directorate-wise-ministry-list'), $data)->json();
        //dd($all_ministries);
        if (isSuccess($all_ministries)) {
            $all_ministries = $all_ministries['data'];
            return view('modules.audit_execution.audit_execution_archive_apotti.partials.load_directorate_wise_ministries', compact('all_ministries'));
        } else {
            return response()->json(['status' => 'error', 'data' => $all_ministries]);
        }
    }

    public function loadMinistryWiseEntity(Request $request)
    {
        $data['office_ministry_id'] = $request->ministry_id;
        $officeResponseData = $this->initRPUHttp()->post(config('cag_rpu_api.office-ministry-wise-entity'), $data)->json();
        //dd($officeResponseData);
        $offices = isSuccess($officeResponseData) ? $officeResponseData['data'] : [];
        return view(
            'modules.audit_execution.audit_execution_archive_apotti.partials.load_ministry_wise_entity',
            compact('offices')
        );
    }

    public function loadEntityWiseUnitGroupOffice(Request $request)
    {
        $data['parent_office_id'] = $request->entity_id;
        $officeResponseData = $this->initRPUHttp()->post(config('cag_rpu_api.get-entity-wise-unit-group-office'), $data)->json();
        //dd($officeResponseData);
        $offices = isSuccess($officeResponseData) ? $officeResponseData['data'] : [];
        return view(
            'modules.audit_execution.audit_execution_archive_apotti.partials.load_entity_wise_unit_group_office',
            compact('offices')
        );
    }

    public function loadEntityOrUnitGroupWiseCostCenter(Request $request)
    {
        $data['parent_office_id'] = $request->parent_office_id;
        $officeResponseData = $this->initRPUHttp()->post(config('cag_rpu_api.get-entity-or-unit-group-wise-cost-center'), $data)->json();
        //dd($officeResponseData);
        $offices = isSuccess($officeResponseData) ? $officeResponseData['data'] : [];
        return view(
            'modules.audit_execution.audit_execution_archive_apotti.partials.load_entity_or_unit_group_wise_cost_center',
            compact('offices')
        );
    }


    public function loadOniyomerCategoryList(Request $request)
    {
        $responseData = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.archive_apotti.get_oniyomer_category_list'), [])->json();
        $categories = isSuccess($responseData) ? $responseData['data'] : [];
        return view(
            'modules.audit_execution.audit_execution_archive_apotti.partials.load_oniyomer_category',
            compact('categories')
        );
    }

    public function loadOniyomerSubCategoryList(Request $request)
    {
        $data['directorate_id'] = $request->directorate_id;
        $data['apotti_oniyomer_category_id'] = $request->apotti_oniyomer_category_id;
        $responseData = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.archive_apotti.get_parent_wise_oniyomer_category_list'), $data)->json();
        $categories = isSuccess($responseData) ? $responseData['data'] : [];
        return view(
            'modules.audit_execution.audit_execution_archive_apotti.partials.load_oniyomer_sub_category',
            compact('categories')
        );
    }


    public function loadApottiList(Request $request)
    {
        $data = Validator::make($request->all(), [
            'fiscal_year_id' => 'required|integer',
            'audit_plan_id' => 'required|integer',
            'entity_id' => 'required|integer',
        ])->validate();

        //        dd($data);

        $data['cdesk'] = $this->current_desk_json();
        $apotti_list = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.apotti.list'), $data)->json();
        //        dd($apotti_list);
        if (isSuccess($apotti_list)) {
            $apotti_list = $apotti_list['data'];
            return view(
                'modules.audit_execution.audit_execution_apotti.apotti_list',
                compact('apotti_list')
            );
        } else {
            return response()->json(['status' => 'error', 'data' => $apotti_list]);
        }
    }


    public function editApotti(Request $request)
    {
        $data = Validator::make($request->all(), [
            'apotti_id' => 'required',
        ])->validate();

        $data['cdesk'] = $this->current_desk_json();


        $apotti_info = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.apotti.get_apotti_info'), $data)->json();
        //        dd($apotti_info);
        if (isSuccess($apotti_info)) {
            $apotti_info = $apotti_info['data'];
            return view(
                'modules.audit_execution.audit_execution_apotti.apotti_edit',
                compact('apotti_info')
            );
        } else {
            return response()->json(['status' => 'error', 'data' => $apotti_info]);
        }
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
                'id' => 'nullable',
                'directorate_id' => 'required',
                'ministry_id' => 'required',
                'entity_id' => 'required',
                'apotti_oniyomer_category_id' => 'required',
                'apotti_oniyomer_category_child_id' => 'required',
                'onucched_no' => 'required',
                'audit_year_start' => 'required',
                'audit_year_end' => 'required',
                'nirikkha_dhoron' => 'required',
                'apottir_dhoron' => 'required',
                'jorito_ortho_poriman' => 'required',
                'file_no' => 'required',
                'apotti_title' => 'required',
            ],
            [
                'directorate_id.required' => 'Directorate field is required.',
                'ministry_id.required' => 'Ministry field is required.',
                'entity_id.required' => 'Entity field is required.',
                'apotti_oniyomer_category_id.required' => 'Category field is required.',
                'apotti_oniyomer_category_child_id.required' => 'Sub Category field is required.',
                'onucched_no.required' => 'Onucched no field is required.',
                'audit_year_start.required' => 'Audit start year field is required.',
                'audit_year_end.required' => 'Audit end year field is required.',
                'nirikkha_dhoron.required' => 'Nirikkha dhoron field is required.',
                'apottir_dhoron.required' => 'Apottir dhoron field is required.',
                'jorito_ortho_poriman.required' => 'Jorito Ortho Poriman dhoron field is required.',
                'file_no.required' => 'File no field is required.',
                'apotti_title.required' => 'Title field is required.',
            ]
        )->validate();

        $data = [
            ['name' => 'id', 'contents' => $request->id],
            ['name' => 'directorate_id', 'contents' => $request->directorate_id],
            ['name' => 'ministry_id', 'contents' => $request->ministry_id],
            ['name' => 'ministry_name', 'contents' => $request->ministry_name],
            ['name' => 'entity_id', 'contents' => $request->entity_id],
            ['name' => 'entity_name', 'contents' => $request->entity_name],
            ['name' => 'unit_group_office_id', 'contents' => $request->unit_group_office_id],
            ['name' => 'parent_office_name_bn', 'contents' => $request->parent_office_name_bn],
            ['name' => 'cost_center_id', 'contents' => $request->cost_center_id],
            ['name' => 'cost_center_name_bn', 'contents' => $request->cost_center_name_bn],
            ['name' => 'apotti_oniyomer_category_id', 'contents' => $request->apotti_oniyomer_category_id],
            ['name' => 'apotti_oniyomer_category_child_id', 'contents' => $request->apotti_oniyomer_category_child_id],
            ['name' => 'onucched_no', 'contents' => bnToen($request->onucched_no)],
            ['name' => 'audit_year_start', 'contents' => bnToen($request->audit_year_start)],
            ['name' => 'audit_year_end', 'contents' => bnToen($request->audit_year_end)],
            ['name' => 'nirikkha_dhoron', 'contents' => $request->nirikkha_dhoron],
            ['name' => 'apottir_dhoron', 'contents' => $request->apottir_dhoron],
            ['name' => 'jorito_ortho_poriman', 'contents' => bnToen($request->jorito_ortho_poriman)],
            ['name' => 'file_no', 'contents' => bnToen($request->file_no)],
            ['name' => 'apotti_title', 'contents' => $request->apotti_title],
            ['name' => 'cdesk', 'contents' => $this->current_desk_json()],
        ];


        //cover_page
        if ($request->hasfile('cover_page')) {
            foreach ($request->file('cover_page') as $file) {
                $data[] = [
                    'name' => 'cover_page[]',
                    'contents' => file_get_contents($file->getRealPath()),
                    'filename' => $file->getClientOriginalName(),
                ];
            }
        }

        //top_page
        if ($request->hasfile('top_page')) {
            foreach ($request->file('top_page') as $file) {
                $data[] = [
                    'name' => 'top_page[]',
                    'contents' => file_get_contents($file->getRealPath()),
                    'filename' => $file->getClientOriginalName(),
                ];
            }
        }

        //main_apottis
        if ($request->hasfile('main_apottis')) {
            foreach ($request->file('main_apottis') as $file) {
                $data[] = [
                    'name' => 'main_apottis[]',
                    'contents' => file_get_contents($file->getRealPath()),
                    'filename' => $file->getClientOriginalName(),
                ];
            }
        }


        //porisishtos
        if ($request->hasfile('porisishtos')) {
            foreach ($request->file('porisishtos') as $file) {
                $data[] = [
                    'name' => 'porisishtos[]',
                    'contents' => file_get_contents($file->getRealPath()),
                    'filename' => $file->getClientOriginalName(),
                ];
            }
        }


        //promanoks
        if ($request->hasfile('promanoks')) {
            foreach ($request->file('promanoks') as $file) {
                $data[] = [
                    'name' => 'promanoks[]',
                    'contents' => file_get_contents($file->getRealPath()),
                    'filename' => $file->getClientOriginalName(),
                ];
            }
        }

        //others
        if ($request->hasfile('others')) {
            foreach ($request->file('others') as $file) {
                $data[] = [
                    'name' => 'others[]',
                    'contents' => file_get_contents($file->getRealPath()),
                    'filename' => $file->getClientOriginalName(),
                ];
            }
        }


        $response = $this->fileUPloadWithData(
            config('amms_bee_routes.audit_conduct_query.archive_apotti.store'),
            $data
        );

        return json_decode($response->getBody(), true);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        Validator::make(
            $request->all(),
            [
                'directorate_id' => 'required',
                'ministry_id' => 'required',
                'entity_id' => 'required',
                'apotti_oniyomer_category_id' => 'required',
                'apotti_oniyomer_category_child_id' => 'required',
                'onucched_no' => 'required',
                'audit_year_start' => 'required',
                'audit_year_end' => 'required',
                'nirikkha_dhoron' => 'required',
                'apottir_dhoron' => 'required',
                'jorito_ortho_poriman' => 'required',
                'file_no' => 'required',
                'apotti_title' => 'required',
            ],
            [
                'directorate_id.required' => 'Directorate field is required.',
                'ministry_id.required' => 'Ministry field is required.',
                'entity_id.required' => 'Entity field is required.',
                'apotti_oniyomer_category_id.required' => 'Category field is required.',
                'apotti_oniyomer_category_child_id.required' => 'Sub Category field is required.',
                'onucched_no.required' => 'Onucched no field is required.',
                'audit_year_start.required' => 'Audit start year field is required.',
                'audit_year_end.required' => 'Audit end year field is required.',
                'nirikkha_dhoron.required' => 'Nirikkha dhoron field is required.',
                'apottir_dhoron.required' => 'Apottir dhoron field is required.',
                'jorito_ortho_poriman.required' => 'Jorito Ortho Poriman dhoron field is required.',
                'file_no.required' => 'File no field is required.',
                'apotti_title.required' => 'Title field is required.',
            ]
        )->validate();

        $data = [
            ['name' => 'directorate_id', 'contents' => $request->directorate_id],
            ['name' => 'ministry_id', 'contents' => $request->ministry_id],
            ['name' => 'entity_id', 'contents' => $request->entity_id],
            ['name' => 'entity_name', 'contents' => $request->entity_name],
            ['name' => 'unit_group_office_id', 'contents' => $request->unit_group_office_id],
            ['name' => 'parent_office_name_bn', 'contents' => $request->parent_office_name_bn],
            ['name' => 'cost_center_id', 'contents' => $request->cost_center_id],
            ['name' => 'apotti_oniyomer_category_id', 'contents' => $request->apotti_oniyomer_category_id],
            ['name' => 'apotti_oniyomer_category_child_id', 'contents' => $request->apotti_oniyomer_category_child_id],
            ['name' => 'onucched_no', 'contents' => $request->onucched_no],
            ['name' => 'audit_year_start', 'contents' => $request->audit_year_start],
            ['name' => 'audit_year_end', 'contents' => $request->audit_year_end],
            ['name' => 'nirikkha_dhoron', 'contents' => $request->nirikkha_dhoron],
            ['name' => 'apottir_dhoron', 'contents' => $request->apottir_dhoron],
            ['name' => 'jorito_ortho_poriman', 'contents' => $request->jorito_ortho_poriman],
            ['name' => 'file_no', 'contents' => $request->file_no],
            ['name' => 'apotti_title', 'contents' => $request->apotti_title],
            ['name' => 'cdesk', 'contents' => $this->current_desk_json()],
        ];


        //cover_page
        if ($request->hasfile('cover_page')) {
            foreach ($request->file('cover_page') as $file) {
                $data[] = [
                    'name' => 'cover_page[]',
                    'contents' => file_get_contents($file->getRealPath()),
                    'filename' => $file->getClientOriginalName(),
                ];
            }
        }

        //top_page
        if ($request->hasfile('top_page')) {
            foreach ($request->file('top_page') as $file) {
                $data[] = [
                    'name' => 'top_page[]',
                    'contents' => file_get_contents($file->getRealPath()),
                    'filename' => $file->getClientOriginalName(),
                ];
            }
        }

        //main_apottis
        if ($request->hasfile('main_apottis')) {
            foreach ($request->file('main_apottis') as $file) {
                $data[] = [
                    'name' => 'main_apottis[]',
                    'contents' => file_get_contents($file->getRealPath()),
                    'filename' => $file->getClientOriginalName(),
                ];
            }
        }


        //porisishtos
        if ($request->hasfile('porisishtos')) {
            foreach ($request->file('porisishtos') as $file) {
                $data[] = [
                    'name' => 'porisishtos[]',
                    'contents' => file_get_contents($file->getRealPath()),
                    'filename' => $file->getClientOriginalName(),
                ];
            }
        }


        //promanoks
        if ($request->hasfile('promanoks')) {
            foreach ($request->file('promanoks') as $file) {
                $data[] = [
                    'name' => 'promanoks[]',
                    'contents' => file_get_contents($file->getRealPath()),
                    'filename' => $file->getClientOriginalName(),
                ];
            }
        }

        //others
        if ($request->hasfile('others')) {
            foreach ($request->file('others') as $file) {
                $data[] = [
                    'name' => 'others[]',
                    'contents' => file_get_contents($file->getRealPath()),
                    'filename' => $file->getClientOriginalName(),
                ];
            }
        }


        $response = $this->fileUPloadWithData(
            config('amms_bee_routes.audit_conduct_query.archive_apotti.update'),
            $data
        );

        dd($response);

        return json_decode($response->getBody(), true);
    }


    public function edit(Request $request)
    {
        $all_directorates = $this->allAuditDirectorates();
        $self_directorate = current(array_filter($all_directorates, function ($item) {
            return $this->current_office_id() == $item['office_id'];
        }));
        $directorates = $self_directorate ? [$self_directorate] : $all_directorates;
        $categoryResponseData = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.archive_apotti.get_oniyomer_category_list'), [])->json();
        $categories = isSuccess($categoryResponseData) ? $categoryResponseData['data'] : [];

        //apotii edit
        $apotti_data['apotti_id'] = $request->apotti_id;
        $apottiResponseData = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.archive_apotti.edit'), $apotti_data)->json();
        $apotti = isSuccess($apottiResponseData) ? $apottiResponseData['data']['apotti'] : [];
        $main_attachments = isSuccess($apottiResponseData) ? $apottiResponseData['data']['main_attachments'] : [];
        $promanok_attachments = isSuccess($apottiResponseData) ? $apottiResponseData['data']['promanok_attachments'] : [];
        $porisishto_attachments = isSuccess($apottiResponseData) ? $apottiResponseData['data']['porisishto_attachments'] : [];

        return view('modules.audit_execution.audit_execution_archive_apotti.edit',
            compact('directorates', 'categories', 'apotti','main_attachments','promanok_attachments','porisishto_attachments')
        );
    }

    public function view(Request $request)
    {
        //apotii edit
        $apotti_data['apotti_id'] = $request->apotti_id;
        $apottiResponseData = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.archive_apotti.edit'), $apotti_data)->json();
        $apotti = isSuccess($apottiResponseData) ? $apottiResponseData['data'] : [];
        //dd($apotti);
        return view('modules.audit_execution.audit_execution_archive_apotti.view', compact('apotti'));
    }

    public function migrateArchiveApottiToAmms(Request $request)
    {
        $data = [
            'apotti_id' => $request->apotti_id,
            'cdesk' => $this->current_desk_json(),
        ];
        $response = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.archive_apotti.migrate'), $data)->json();
        return $response;
    }
}
