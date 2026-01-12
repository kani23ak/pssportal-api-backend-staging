<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PssCompany;

class PssCompanyController extends Controller
{
    public function store(Request $request) {
        $pss_company = PssCompany::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Pss Company created successfully'
        ]);
    }

    public function index() {
        $pss_company = PssCompany::where('is_deleted', '0')->get();

        return response()->json([
            'success' => true,
            'data' => $pss_company
        ]);
    }

    public function edit_form($id) {
        $pss_company = PssCompany::findorFail($id);

        return response()->json([
            'status' => true,
            'data' => $pss_company
        ]);
    }

    public function update(Request $request, $id) {
        $pss_company = PssCompany::findOrFail($id);

        $pss_company->name = $request->name;
        $pss_company->address = $request->address;
        $pss_company->status = $request->status;
        $pss_company->updated_by = $request->updated_by;
        
        $pss_company->save();
        return response()->json([
            'status'=>true,
            'message'=> 'Pss Company updated successfully',
            'data' => $pss_company
        ]);
    }

    public function delete(Request $request) {
        $pss_company = PssCompany::find($request->record_id);

        if(!$pss_company) return response()->json([
            'status'=>false,
            'message'=>'Record not found'
        ], 404);

        $pss_company->is_deleted = '1';
        $pss_company->save();

        return response()->json([
            'status' => true,
            'message' => 'Pss Company deleted successfully'
        ]);
    }
}
