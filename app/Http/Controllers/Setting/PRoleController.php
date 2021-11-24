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
        $data['cdesk'] = $this->current_desk_json();
        $allRole = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.role_list'), $data)->json();
        if (isSuccess($allRole)) {
            $allRole = $allRole['data'];
            return view('modules.settings.p_role.partials.load_role', compact('allRole'));
        } else {
            return response()->json(['status' => 'error', 'data' => $allRole]);
        }
    }

    public function create()
    {
        return view('modules.settings.p_role.p_role_create');
    }

    public function store(Request $request)
    {
        $data = Validator::make($request->all(), [
            'role_name_en' => 'required',
            'role_name_bn' => 'required',
            'description_en' => 'required',
            'description_bn' => 'required',
            'user_level' => 'required|integer',
        ])->validate();
        $data['cdesk'] = $this->current_desk_json();
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
            'role_id' => 'required|integer',
        ])->validate();
        $data['cdesk'] = $this->current_desk_json();
        $roleInfo = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.role_show'), $data)->json();
        //dd($roleInfo);
        $roleInfo = isSuccess($roleInfo) ? $roleInfo['data'] : [];
        return view('modules.settings.p_role.p_role_edit', compact('roleInfo'));
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
        ])->validate();
        $data['cdesk'] = $this->current_desk_json();
        $responseData = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.role_update'), $data)->json();
        if (isSuccess($responseData)) {
            return response()->json(responseFormat('success', 'Updated Successfully'));
        } else {
            return response()->json(['status' => 'error', 'data' => $responseData]);
        }
    }

    public function loadMasterDesignationRoleMap(Request $request)
    {
        $roleId = $request->role_id;
        $roleNameEn = $request->role_name_en;
        $masterDesignationList = $this->cagDoptorMasterDesignations();
        return view('modules.settings.p_role.partials.load_role_designation_map',
            compact('roleId', 'roleNameEn', 'masterDesignationList'));
    }

    public function assignedMasterDesignationRoleMap(Request $request): \Illuminate\Http\JsonResponse
    {
        $data['role'] = $request->role;
        $data['cdesk'] = $this->current_desk_json();
        $assign = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.assigned_master_designation_to_role'), $data)->json();
        if (isSuccess($assign)) {
            return response()->json(['data' => explodeAndMakeArray($assign['data'], ','), 'status' => 'success']);
        } else {
            return response()->json(['data' => $assign, 'status' => 'error']);
        }
    }

    public function storeMasterDesignationRoleMap(Request $request)
    {
        Validator::make($request->all(), [
            'role_id' => 'required',
            'master_designation' => 'required',
        ])->validate();
        $roleId = $request->role_id;
        $masterDesignations = implode(',', $request->master_designation);
        $data = [
            'role_id' => $roleId,
            'master_designations' => $masterDesignations,
        ];

        $data['cdesk'] = $this->current_desk_json();
        $responseData = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.assign_master_designation_to_role'), $data)->json();
        if (isSuccess($responseData)) {
            return response()->json(responseFormat('success', 'Updated Successfully'));
        } else {
            return response()->json(['status' => 'error', 'data' => $responseData]);
        }
    }
}
