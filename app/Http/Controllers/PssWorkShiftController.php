<?php

namespace App\Http\Controllers;

use App\Models\PssWorkShift;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Validated;

class PssWorkShiftController extends Controller
{
    /**
     * List all shifts
     */
    public function index()
    {
        $shifts = PssWorkShift::where('is_deleted', 0)
            ->orderBy('id', 'DESC')
            ->get();

        return response()->json([
            'success' => true,
            'data'    => $shifts
        ]);
    }

    /**
     * Store new shift
     */
    public function store(Request $request)
    {
       
        $shift = PssWorkShift::create([
            'shift_name' => $request->shift_name,
            'start_time' => $request->start_time,
            'end_time'   => $request->end_time,
            'created_by' => $request->created_by,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Work shift created successfully',
            'data'    => $shift
        ], 201);
    }

    /**
     * Show single shift
     */
    public function show($id)
    {
        $shift = PssWorkShift::where('id', $id)
            ->where('is_deleted', 0)
            ->first();

        if (!$shift) {
            return response()->json([
                'success' => false,
                'message' => 'Work shift not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data'    => $shift
        ]);
    }

    /**
     * Update shift
     */
    public function update(Request $request, $id)
    {
        $shift = PssWorkShift::where('id', $id)
            ->where('is_deleted', 0)
            ->first();

        if (!$shift) {
            return response()->json([
                'success' => false,
                'message' => 'Work shift not found'
            ], 404);
        }

        $shift->update([
            'shift_name' => $request->shift_name,
            'start_time' => $request->start_time,
            'end_time'   => $request->end_time,
            'updated_by' => $request->updated_by,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Work shift updated successfully',
            'data'    => $shift
        ]);
    }

    /**
     * Soft delete shift
     */
    public function destroy($id)
    {
        $shift = PssWorkShift::where('id', $id)
            ->where('is_deleted', 0)
            ->first();

        if (!$shift) {
            return response()->json([
                'success' => false,
                'message' => 'Work shift not found'
            ], 404);
        }

        $shift->update([
            'is_deleted' => 1,
            'updated_by' => auth()->id(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Work shift deleted successfully'
        ]);
    }

    public function activeshift(Request $request)
    {
        $shifts = PssWorkShift::where('is_deleted', 0)
            ->orderBy('id', 'DESC')
            ->get();

        return response()->json([
            'success' => true,
            'data'    => $shifts
        ]);
    }
}

