<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PMenuModuleController extends Controller
{
    public function index()
    {
        return view('modules.settings.p_module.p_module_list');
    }

    public function getModules(Request $request)
    {
        $data = Validator::make($request->all(), [
            'per_page' => 'required|integer',
            'page' => 'required|integer',
        ])->validate();
        $data['cdesk'] = $this->current_desk_json();
        $allModule = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.module_list'), $data)->json();
        if (isSuccess($allModule)) {
            $allModule = $allModule['data'];
            return view('modules.settings.p_module.partials.load_module',compact('allModule'));
        } else {
            return response()->json(['status' => 'error', 'data' => $allModule]);
        }
    }

    public function create()
    {
        $data['all'] = 'all';
        $data['cdesk'] = $this->current_desk_json();
        $moduleList = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.module_list'), $data)->json();
        $moduleList = isSuccess($moduleList)?$moduleList['data']:[];
        return view('modules.settings.p_module.p_module_create',compact('moduleList'));
    }

    public function store(Request $request)
    {
        $data = Validator::make($request->all(), [
            'module_name_en' => 'required',
            'module_name_bn' => 'required',
            'is_other_module' => 'required',
            'display_order' => 'required',
            'parent_module_id' => 'nullable',
            'module_link' => 'nullable',
            'module_class' => 'nullable',
            'module_icon' => 'nullable',
            'module_controller' => 'nullable',
            'module_method' => 'nullable',
        ])->validate();
        $data['cdesk'] = $this->current_desk_json();
        $responseData = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.module_store'), $data)->json();
        if (isSuccess($responseData)) {
            return response()->json(responseFormat('success', 'Created Successfully'));
        } else {
            return response()->json(['status' => 'error', 'data' => $responseData]);
        }
    }

    public function edit(Request $request)
    {
        Validator::make($request->all(), [
            'menu_module_id' => 'required|integer',
        ])->validate();

        $data['menu_module_id'] = $request->menu_module_id;
        $moduleInfo = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.module_show'), $data)->json();
        $moduleInfo = isSuccess($moduleInfo)?$moduleInfo['data']:[];

        $data['all'] = 'all';
        $data['cdesk'] = $this->current_desk_json();
        $moduleList = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.module_list'), $data)->json();
        $moduleList = isSuccess($moduleList)?$moduleList['data']:[];

        return view('modules.settings.p_module.p_module_edit',compact('moduleList',
            'moduleInfo'));
    }

    public function update(Request $request)
    {
        $data = Validator::make($request->all(), [
            'menu_module_id' => 'required|integer',
            'module_name_en' => 'required',
            'module_name_bn' => 'required',
            'is_other_module' => 'required',
            'parent_module_id' => 'nullable',
            'module_link' => 'nullable',
            'module_class' => 'nullable',
            'module_icon' => 'nullable',
            'display_order' => 'nullable',
            'module_controller' => 'nullable',
            'module_method' => 'nullable',
        ])->validate();
        $data['cdesk'] = $this->current_desk_json();
        $responseData = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.module_update'), $data)->json();
        if (isSuccess($responseData)) {
            return response()->json(responseFormat('success', 'Updated Successfully'));
        } else {
            return response()->json(['status' => 'error', 'data' => $responseData]);
        }
    }

}
