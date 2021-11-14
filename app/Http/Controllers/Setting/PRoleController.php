<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PRoleController extends Controller
{
    public function index()
    {
        return view('modules.settings.p_role.p_role_list');
    }

    public function getRoles(Request $request)
    {
        $data = Validator::make($request->all(), [
            'per_page' => 'required|integer',
            'page' => 'required|integer',
        ])->validate();
        $data['cdesk'] = json_encode($this->current_desk(), JSON_UNESCAPED_UNICODE);
        $allRole = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.role_list'), $data)->json();
        if (isSuccess($allRole)) {
            $allRole = $allRole['data'];
            return view('modules.settings.p_role.partials.load_role',compact('allRole'));
        } else {
            return response()->json(['status' => 'error', 'data' => $allRole]);
        }
    }

    public function create()
    {
        $masterDesignationList = $this->cagDoptorMasterDesignations();
        return view('modules.settings.p_role.p_role_create',compact('masterDesignationList'));
    }

    public function store(Request $request)
    {
        $data = Validator::make($request->all(), [
            'role_name_en' => 'required',
            'role_name_bn' => 'required',
            'description_en' => 'required',
            'description_bn' => 'required',
            'user_level' => 'required|integer',
            'master_designation_id' => 'required|integer',
        ])->validate();
        $data['cdesk'] = json_encode($this->current_desk(), JSON_UNESCAPED_UNICODE);
        $responseData = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.role_store'), $data)->json();
        if (isSuccess($responseData)) {
            return response()->json(responseFormat('success', 'Created Successfully'));
        } else {
            return response()->json(['status' => 'error', 'data' => $responseData]);
        }
    }

    public function edit(Request $request)
    {
        $data = Validator::make($request->all(), [
            'role_id' => 'required|integer'
        ])->validate();
        $data['cdesk'] = json_encode($this->current_desk(), JSON_UNESCAPED_UNICODE);
        $roleInfo = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.role_show'), $data)->json();
        //dd($roleInfo);
        $roleInfo = isSuccess($roleInfo)?$roleInfo['data']:[];
        $masterDesignationList = $this->cagDoptorMasterDesignations();
        return view('modules.settings.p_role.p_role_edit',compact('roleInfo',
            'masterDesignationList'));
    }

    public function update(Request $request)
    {
        $data = Validator::make($request->all(), [
            'role_id' => 'required|integer',
            'role_name_en' => 'required',
            'role_name_bn' => 'required',
            'description_en' => 'required',
            'description_bn' => 'required',
            'user_level' => 'required|integer',
            'master_designation_id' => 'required|integer',
        ])->validate();
        $data['cdesk'] = json_encode($this->current_desk(), JSON_UNESCAPED_UNICODE);
        $responseData = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.role_update'), $data)->json();
        if (isSuccess($responseData)) {
            return response()->json(responseFormat('success', 'Updated Successfully'));
        } else {
            return response()->json(['status' => 'error', 'data' => $responseData]);
        }
    }
}
