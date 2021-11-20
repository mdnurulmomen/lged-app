<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PMenuActionController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->page;
        return view('modules.settings.p_menu_action.p_menu_action_list',compact('type'));
    }


    public function loadTypeWiseMenuActionData(Request $request)
    {
        $data = Validator::make($request->all(), [
            'per_page' => 'required|integer',
            'page' => 'required|integer',
            'type' => 'required',
        ])->validate();
        $data['cdesk'] = $this->current_desk_json();
        $menuActionList = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.menu_action_list'), $data)->json();
        //dd($menuActionList);
        if (isSuccess($menuActionList)) {
            $menuActionList = $menuActionList['data'];
            $type =  $request->type;
            return view('modules.settings.p_menu_action.partials.load_module_menu_action',
                compact('type','menuActionList'));
        } else {
            return response()->json(['status' => 'error', 'data' => $menuActionList]);
        }
    }

    public function create(Request $request)
    {

        $data['all'] = 'all';
        $type = $request->type;
        $data['type'] = $type;
        $data['cdesk'] = $this->current_desk_json();
        $menuActionList = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.menu_action_list'), $data)->json();
        //dd($menuActionList);
        $menuActionList = isSuccess($menuActionList)?$menuActionList['data']:[];
        return view('modules.settings.p_menu_action.partials.load_create_form',
            compact('type','menuActionList'));
    }

    public function store(Request $request)
    {
        $data = Validator::make($request->all(), [
            'title_en' => 'required',
            'title_bn' => 'required',
            'link' => 'required',
        ])->validate();

        $data['class'] = $request->class;
        $data['controller'] = $request->controller;
        $data['method'] = $request->method_name;
        $data['icon'] = $request->icon;
        $data['display_order'] = $request->display_order;
        $data['parent_id'] = $request->parent_id;
        $data['is_other_module'] = $request->is_other_module;
        $data['type'] = $request->type;
        $data['cdesk'] = $this->current_desk_json();
        $responseData = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.menu_action_store'), $data)->json();
        if (isSuccess($responseData)) {
            return response()->json(responseFormat('success', 'Created Successfully'));
        } else {
            return response()->json(['status' => 'error', 'data' => $responseData]);
        }
    }

    public function edit(Request $request)
    {
        Validator::make($request->all(), [
            'menu_action_id' => 'required|integer',
        ])->validate();

        $data['menu_id'] = $request->menu_id;
        $menuActionInfo = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.menu_action_show'), $data)->json();
        $menuActionInfo = isSuccess($menuActionInfo)?$menuActionInfo['data']:[];

        $data['all'] = 'all';
        $type = $request->type;
        $data['type'] = $type;
        $data['cdesk'] = $this->current_desk_json();
        $menuActionList = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.menu_action_list'), $data)->json();
        $menuActionList = isSuccess($menuActionList)?$menuActionList['data']:[];

        return view('modules.settings.p_menu.p_menu_edit',compact('type',
            'menuActionInfo', 'menuActionList'));
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
