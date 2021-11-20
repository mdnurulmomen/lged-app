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
        $data = Validator::make($request->all(), [
            'type' => 'required|string',
        ])->validate();

        $data['all'] = 'all';
        $data['cdesk'] = $this->current_desk_json();
        $menuActionList = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.menu_action_list'), $data)->json();
        //dd($menuActionList);
        $menuActionList = isSuccess($menuActionList)?$menuActionList['data']:[];
        $type = $request->type;
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
            'type' => 'required',
            'menu_action_id' => 'required|integer',
        ])->validate();

        $menuActionInfoData['menu_action_id'] = $request->menu_action_id;
        $menuActionInfo = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.menu_action_show'), $menuActionInfoData)->json();
        $menuActionInfo = isSuccess($menuActionInfo)?$menuActionInfo['data']:[];

        $menuActionListData['all'] = 'all';
        $menuActionListData['type'] = $request->type == 'action'?'menu':$request->type;
        $menuActionListData['cdesk'] = $this->current_desk_json();
        $menuActionList = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.menu_action_list'), $menuActionListData)->json();
        $menuActionList = isSuccess($menuActionList)?$menuActionList['data']:[];
        $type = $request->type;

        return view('modules.settings.p_menu_action.partials.load_edit_form',compact('type',
            'menuActionInfo', 'menuActionList'));
    }

    public function update(Request $request)
    {
        $data = Validator::make($request->all(), [
            'menu_action_id' => 'required|integer',
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
        $responseData = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.menu_action_update'), $data)->json();
        if (isSuccess($responseData)) {
            return response()->json(responseFormat('success', 'Updated Successfully'));
        } else {
            return response()->json(['status' => 'error', 'data' => $responseData]);
        }
    }
}
