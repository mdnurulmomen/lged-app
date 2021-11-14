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
        $data['cdesk'] = json_encode($this->current_desk(), JSON_UNESCAPED_UNICODE);
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
        $data['cdesk'] = json_encode($this->current_desk(), JSON_UNESCAPED_UNICODE);
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
        ])->validate();
        $data['parent_module_id'] = $request->parent_module_id;
        $data['module_link'] = $request->module_link;
        $data['module_class'] = $request->module_class;
        $data['module_icon'] = $request->module_icon;
        $data['display_order'] = $request->display_order;
        $data['cdesk'] = json_encode($this->current_desk(), JSON_UNESCAPED_UNICODE);
        $responseData = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.module_store'), $data)->json();
        if (isSuccess($responseData)) {
            return response()->json(responseFormat('success', 'Created Successfully'));
        } else {
            return response()->json(['status' => 'error', 'data' => $responseData]);
        }
    }
}
