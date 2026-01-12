<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;
use App\Models\ModulePermission;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;

class RolePermissionController extends Controller
{
    public function list(Request $request)
    {
        // dd(Hash::make('PSS@8687'));
        $privilegeFor = $request->get('privilege_for', 'role');

        // $role_filter = $request->role;
        $permissionsQuery = Permission::where('is_deleted', '0');




        // Apply role filter only if provided
        if (!empty($privilegeFor)) {
            $permissionsQuery->where('privilege_for', $privilegeFor);
        }


        // Conditional relation loading
        if ($privilegeFor === 'role') {
            $permissionsQuery->with('role');
        } else {
            $permissionsQuery->with('employee.role');;
        }

        $permissions = $permissionsQuery->orderBy('id', 'DESC')
            ->get();

        $roles = Role::select('id', 'role_name')->where('status', '1')->where('is_deleted', '0')
            ->where('id', '!=', 1)
            ->get();

        $pssemployees = Employee::where('status', '1')->where('is_deleted', 0)
            ->where('id', '!=', 1)
            // ->where('job_form_referal', 1)
            ->select('full_name', 'id')
            ->get();
        return response()->json([
            'status' => true,
            'message' => 'Permission list fetched successfully',
            'data' => $permissions,
            'roles' => $roles,
            'pssemployees' => $pssemployees
        ]);
    }

    public function insert(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'role_name'  => 'required|exists:roles,id',
        //     'moduleList' => 'required|array|min:1'
        // ]);

        // if ($validator->fails()) {
        //     return response()->json([
        //         'status' => false,
        //         'message' => 'Validation error',
        //         'errors' => $validator->errors()
        //     ], 422);
        // }

        \DB::beginTransaction();

        try {
            $permission = Permission::create([
                'privilege_for' => $request->privilege_for,
                'role_id'      => $request->role_name,
                'created_by'   => $request->created_by,
                'created_date' => now(),
                'status'       => $request->status ?? '1',
                'is_deleted'   => '0'
            ]);

            foreach ($request->moduleList as $moduleData) {
                ModulePermission::create([
                    'permission_id' => $permission->id,
                    'module'        => $moduleData['module'],
                    'is_create'     => $moduleData['permission']['create'] ?? 0,
                    'is_view'       => $moduleData['permission']['view'] ?? 0,
                    'is_edit'       => $moduleData['permission']['edit'] ?? 0,
                    'is_delete'     => $moduleData['permission']['delete'] ?? 0,
                    'is_import'       => $moduleData['permission']['import'] ?? 0,
                    'is_filter'       => $moduleData['permission']['filter'] ?? 0,
                ]);
            }

            \DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Permissions assigned successfully'
            ], 201);
        } catch (\Exception $e) {
            \DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
    public function edit($id, Request $request)
    {
        // Fetch active roles
        $roles = Role::where('status', '1')
            ->where('is_deleted', '0')
            ->select('id', 'role_name')
            ->get();

        // Fetch permission with modules
        $permission = Permission::with('modules')->find($id);

        if (!$permission) {
            return response()->json([
                'status' => false,
                'message' => 'Permission record not found'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Permission data fetched successfully',
            'data' => [
                'roles' => $roles,
                'permission' => $permission
            ]
        ], 200);
    }


    public function update($id, Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'role_name'  => 'required|exists:roles,id',
        //     'moduleList' => 'required|array|min:1'
        // ]);

        // if ($validator->fails()) {
        //     return response()->json([
        //         'status' => false,
        //         'errors' => $validator->errors()
        //     ], 422);
        // }

        \DB::beginTransaction();

        try {
            $permission = Permission::find($id);
            if (!$permission) {
                return response()->json([
                    'status' => false,
                    'message' => 'Permission not found'
                ], 404);
            }

            $permission->update(['role_id' => $request->role_name]);

            ModulePermission::where('permission_id', $id)->delete();

            foreach ($request->moduleList as $module) {
                ModulePermission::create([
                    'permission_id' => $id,
                    'module'        => $module['module'],
                    'is_create'     => $module['permission']['create'] ?? 0,
                    'is_edit'       => $module['permission']['edit'] ?? 0,
                    'is_delete'     => $module['permission']['delete'] ?? 0,
                    'is_import'       => $module['permission']['import'] ?? 0,
                    'is_view'       => $module['permission']['view'] ?? 0,
                    'is_filter'       => $module['permission']['filter'] ?? 0
                ]);
            }

            \DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Permissions updated successfully'
            ]);
        } catch (\Exception $e) {
            \DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function delete(Request $request)
    {
        $permission = Permission::find($request->record_id);

        if (!$permission) {
            return response()->json([
                'status' => false,
                'message' => 'Record not found'
            ], 404);
        }

        $permission->update([
            'is_deleted' => '1',
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Permission deleted successfully'
        ]);
    }
}
