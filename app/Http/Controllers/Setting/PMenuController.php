<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PMenuController extends Controller
{
    public function index()
    {
        return view('modules.settings.p_menu.p_menu_list');
    }

    public function getMenus(Request $request)
    {
        $data = Validator::make($request->all(), [
            'per_page' => 'required|integer',
            'page' => 'required|integer',
        ])->validate();
        $data['cdesk'] = $this->current_desk_json();
        $allMenu = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.menu_list'), $data)->json();
        if (isSuccess($allMenu)) {
            $allMenu = $allMenu['data'];
            return view('modules.settings.p_menu.partials.load_menu',compact('allMenu'));
        } else {
            return response()->json(['status' => 'error', 'data' => $allMenu]);
        }
    }

    public function create()
    {
        $data['all'] = 'all';
        $data['cdesk'] = $this->current_desk_json();

        $menuList = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.menu_list'), $data)->json();
        $menuList = isSuccess($menuList)?$menuList['data']:[];

        $moduleList = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.module_list'), $data)->json();
        $moduleList = isSuccess($moduleList)?$moduleList['data']:[];
        return view('modules.settings.p_menu.p_menu_create',compact('menuList',
            'moduleList'));
    }

    public function store(Request $request)
    {
        $data = Validator::make($request->all(), [
            'menu_name_en' => 'required',
            'menu_name_bn' => 'required',
        ])->validate();

        $data['menu_class'] = $request->menu_class;
        $data['menu_link'] = $request->menu_link;
        $data['menu_controller'] = $request->menu_controller;
        $data['menu_method'] = $request->menu_method;
        $data['menu_icon'] = $request->menu_icon;
        $data['module_menu_id'] = $request->module_menu_id;
        $data['parent_menu_id'] = $request->parent_menu_id;
        $data['display_order'] = $request->display_order;
        $data['cdesk'] = $this->current_desk_json();
        $responseData = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.menu_store'), $data)->json();
        if (isSuccess($responseData)) {
            return response()->json(responseFormat('success', 'Created Successfully'));
        } else {
            return response()->json(['status' => 'error', 'data' => $responseData]);
        }
    }

    public function edit(Request $request)
    {
        Validator::make($request->all(), [
            'menu_id' => 'required|integer',
        ])->validate();

        $data['menu_id'] = $request->menu_id;
        $menuInfo = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.menu_show'), $data)->json();
        $menuInfo = isSuccess($menuInfo)?$menuInfo['data']:[];

        $data['all'] = 'all';
        $data['cdesk'] = $this->current_desk_json();

        $menuList = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.menu_list'), $data)->json();
        $menuList = isSuccess($menuList)?$menuList['data']:[];

        $moduleList = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.module_list'), $data)->json();
        $moduleList = isSuccess($moduleList)?$moduleList['data']:[];

        return view('modules.settings.p_menu.p_menu_edit',compact('menuList',
            'moduleList','menuInfo'));
    }

    public function update(Request $request)
    {
        $data = Validator::make($request->all(), [
            'menu_id' => 'required|integer',
            'menu_name_en' => 'required',
            'menu_name_bn' => 'required',
        ])->validate();

        $data['menu_class'] = $request->menu_class;
        $data['menu_link'] = $request->menu_link;
        $data['menu_controller'] = $request->menu_controller;
        $data['menu_method'] = $request->menu_method;
        $data['menu_icon'] = $request->menu_icon;
        $data['module_menu_id'] = $request->module_menu_id;
        $data['parent_menu_id'] = $request->parent_menu_id;
        $data['display_order'] = $request->display_order;
        $data['cdesk'] = $this->current_desk_json();
        $responseData = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.menu_update'), $data)->json();
        if (isSuccess($responseData)) {
            return response()->json(responseFormat('success', 'Created Successfully'));
        } else {
            return response()->json(['status' => 'error', 'data' => $responseData]);
        }
    }
}
