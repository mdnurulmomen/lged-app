<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index()
    {
        return view('modules.settings.permission.permission_index');
    }

    public function employeePermission()
    {
        $officer_lists = $this->cagDoptorOfficeUnitDesignationEmployees($this->current_office_id());
        if ($officer_lists) {
            return view('modules.settings.permission.individual_permission_index', compact('officer_lists'));
        } else {
            return response()->json(['status' => 'error', 'data' => $officer_lists]);
        }
    }

    public function loadMenuModuleLists(Request $request)
    {
        $module_menus = $this->initHttpWithToken()->post(config('amms_bee_routes.role-and-permissions.get-module-menu-lists'), [
            'cdesk' => $this->current_desk_json(),
        ])->json();
        if (is_array($module_menus) && isset($module_menus['status']) && $module_menus['status'] == 'success') {
            $module_menus = $module_menus['data'];
            return view('modules.settings.permission.partials.load_menu_module_lists', compact('module_menus'));
        } else {
            return response()->json(['status' => 'error', 'data' => $module_menus]);
        }
    }

    public function loadAllRoles(Request $request)
    {
        $data['cdesk'] = $this->current_desk_json();
        $roles = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.role_list'), $data)->json();
        if (isSuccess($roles)) {
            $roles = $roles['data'];
            return view('modules.settings.permission.partials.load_all_roles_list', compact('roles'));
        } else {
            return response()->json(['status' => 'error', 'data' => $roles]);
        }

    }

    public function assignMenuModuleToRole(Request $request): \Illuminate\Http\JsonResponse
    {
        $data['menu_actions'] = $request->menu_actions;
        $data['role_id'] = $request->role_id;
        $data['cdesk'] = $this->current_desk_json();
        $assign = $this->initHttpWithToken()->post(config('amms_bee_routes.role-and-permissions.assign-menus-to-role'), $data)->json();
        if (isSuccess($assign)) {
            return response()->json(['data' => $assign, 'status' => 'success']);
        } else {
            return response()->json(['data' => $assign, 'status' => 'error']);
        }
    }

    public function assignMenuModuleToEmployee(Request $request): \Illuminate\Http\JsonResponse
    {
        $data['menu_actions'] = $request->menu_actions;
        $data['designation_id'] = $request->designation_id;
        $data['master_designation_id'] = $request->master_designation_id;
        $data['cdesk'] = $this->current_desk_json();
        $assign = $this->initHttpWithToken()->post(config('amms_bee_routes.role-and-permissions.assign-menus-to-employee'), $data)->json();
        if (isSuccess($assign)) {
            return response()->json(['data' => $assign['data'], 'status' => 'success']);
        } else {
            return response()->json(['data' => $assign['data'], 'status' => 'error']);
        }
    }
}
