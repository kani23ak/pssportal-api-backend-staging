<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\PssCompany;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class DepartmentController extends Controller
{
    public function list(Request $request)
    {
        $departments = Department::select(
            'id',
            'department_name',
            'status',
            'is_deleted'
        )
            ->where('is_deleted', '0')
            ->get();

        $psscompaies = PssCompany::where('status', '1')->where('is_deleted', '0')
        ->select('name', 'id')
        ->get();

        return response()->json([
            'status' => true,
            'message' => 'Department list fetched successfully',
            'data' => $departments,
            'psscompany' => $psscompaies,
        ]);
    }

    public function insert(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'department_name' => [
        //         'required',
        //         Rule::unique('departments')->where(function ($query) {
        //             return $query->where('is_deleted', '0');
        //         })
        //     ],
        // ]);

        $validator = Validator::make($request->all(), [
        'department_name' => [
        'required',
        Rule::unique('departments')->where(function ($query) {
            return $query->where('is_deleted', '0');
        })], 'company_id' => 'required|exists:pss_company,id',
    ]);


        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ]);
        }

        // $role = new Department;
        // $role->department_name = $request->department_name;
        // $role->status = $request->status;
        // // $role->created_date = now();
        // $role->created_by = $request->created_by;
        // $role->is_deleted = '0';
        // $role->save();

        $role = new Department;
        $role->department_name = $request->department_name;
        $role->company_id = $request->company_id; 
        $role->status = $request->status;
        $role->created_by = $request->created_by;
        $role->is_deleted = '0';
        $role->save();

        return response()->json([
            'status' => true,
            'message' => 'Department created successfully',
            'data' => $role
        ], 201);
    }

    public function edit_form(Request $request, $id)
    {
        $role = Department::findOrFail($id);

        return response()->json([
            'status' => true,
            'data' => $role
        ]);
    }

    public function update(Request $request, $id)
    {
        // Validate (ignore unique check on the current record)
        // $validator = Validator::make($request->all(), [
        //     'department_name' => [
        //         'required',
        //         Rule::unique('departments', 'department_name')
        //             ->where(function ($query) {
        //                 $query->where('is_deleted', 0);
        //             })
        //             ->ignore($id),
        //     ],
        // ]);

        $validator = Validator::make($request->all(), [
        'department_name' => [
        'required',
        Rule::unique('departments', 'department_name')
            ->where(function ($query) {
                $query->where('is_deleted', 0);
            })
            ->ignore($id),
        ],
        'company_id' => 'required|exists:pss_company,id',
    ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        // Find Role
        $role = Department::findOrFail($id);
        $role->department_name = $request->department_name;
        $role->company_id = $request->company_id; 
        $role->status = $request->status;
        $role->updated_by = $request->updated_by;
        $role->save();

        return response()->json([
            'status' => true,
            'message' => 'Department updated successfully',
            'data' => $role
        ]);
    }

    public function delete(Request $request)
    {
        $role = Department::find($request->record_id);

        if (!$role) {
            return response()->json([
                'status' => false,
                'message' => 'Record not found'
            ], 404);
        }

        $role->is_deleted = '1';
        $role->save();

        return response()->json([
            'status' => true,
            'message' => 'Role deleted successfully'
        ]);
    }
}
