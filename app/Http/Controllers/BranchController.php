<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\PssCompany;
use Illuminate\Support\Facades\Validator;

class BranchController extends Controller
{
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
        'branch_name' => 'required|string',
        'company_id'  => 'required|exists:pss_company,id',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => 'Validation error',
            'errors'  => $validator->errors()
        ], 422);
    }

    $branch = Branch::create([
        'branch_name' => $request->branch_name,
        'address'     => $request->address,
        'city'        => $request->city,
        'state'       => $request->state,
        'country'     => $request->country,
        'pincode'     => $request->pincode,
        'status'      => $request->status,
        'company_id'  => $request->company_id,
        'created_by'  => $request->created_by,
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Branch created successfully',
        'data'    => $branch
    ], 201);
    }

    public function index() {

        $companies = Branch::where('is_deleted', '0')
            ->get();

        $psscompanies = PssCompany::where('status', '1')->where('is_deleted', '0')
        ->select('name', 'id')
        ->get();

        return response()->json([
            'success' => true,
            'data' => $companies,
            'psscompany' => $psscompanies
        ]);
    }

    public function edit_form(Request $request, $id)
    {        
        $role = Branch::findOrFail($id);

        return response()->json([
            'status' => true,
            'data' => $role
        ]);
    }

    public function update(Request $request, $id) {

       $validator = Validator::make($request->all(), [
        'branch_name' => 'required|string',
        'company_id'  => 'required|exists:pss_company,id',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => 'Validation error',
            'errors'  => $validator->errors(),
        ], 422);
    }

    $branch = Branch::findOrFail($id);

    $branch->update([
        'branch_name' => $request->branch_name,
        'address'     => $request->address,
        'city'        => $request->city,
        'state'       => $request->state,
        'country'     => $request->country,
        'pincode'     => $request->pincode,
        'status'      => $request->status,
        'company_id'  => $request->company_id,
        'updated_by'  => $request->updated_by,
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Branch updated successfully',
        'data'    => $branch,
    ]);
    }

    public function delete(Request $request)
    {
        $role = Branch::find($request->record_id);

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
            'message' => 'Branch deleted successfully'
        ]);
    }
}
