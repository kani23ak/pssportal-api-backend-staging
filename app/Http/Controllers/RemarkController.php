<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Remark;

class RemarkController extends Controller
{
    public function index($parent_id)
    {
        $remarks = Remark::where('parent_id', $parent_id)->where('is_deleted', 0)
            ->orderBy('created_date', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $remarks
        ]);
    }

    public function store(Request $request)
    {

        $remark = Remark::create([
            'parent_id' => $request->parent_id,
            'notes' => $request->notes,
            'created_date' => now(),
            'is_deleted' => 0
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Remark added successfully',
            'data' => $remark
        ]);
    }

    public function show($id)
    {
        $remark = Remark::where('id', $id)
            ->where('is_deleted', 0)
            ->first();

        if (!$remark) {
            return response()->json([
                'success' => false,
                'message' => 'Remark not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $remark
        ]);
    }


    public function update(Request $request, $id)
    {
        $remark = Remark::find($id);

        if (!$remark) {
            return response()->json([
                'success' => false,
                'message' => 'Remark not found'
            ], 404);
        }

        $remark->update([
            'notes' => $request->notes
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Remark updated successfully'
        ]);
    }

    public function destroy($id)
    {
        $remark = Remark::find($id);

        if (!$remark) {
            return response()->json([
                'success' => false,
                'message' => 'Remark not found'
            ], 404);
        }

        $remark->update([
            'is_deleted' => 1
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Remark deleted successfully'
        ]);
    }
}
