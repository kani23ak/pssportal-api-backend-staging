<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContractCanEmp;
use App\Models\JobForm;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function list(Request $request)
    {
        $start_date = $request->start_date;
        $end_date   = $request->end_date;

        $contract_emps = ContractCanEmp::select(
            'company_id',
            DB::raw('COUNT(id) as total_employees')
        )
            ->with('company:id,company_name')
            ->where('is_deleted', 0)
            ->when($start_date && $end_date, function ($q) use ($start_date, $end_date) {
                $q->whereBetween('created_at', [
                    Carbon::parse($start_date)->startOfDay(),
                    Carbon::parse($end_date)->endOfDay()
                ]);
            })
            ->groupBy('company_id')
            ->get();

        // ✅ Assign mapped data
        $contract_emps = $contract_emps->map(function ($item) {
            return [
                'company_id'       => $item->company_id,
                'company_name'     => optional($item->company)->company_name,
                'total_employees'  => $item->total_employees,
            ];
        });

        //jobform submission
        $jobformsubmission = JobForm::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('COUNT(id) as count')
        )
            ->when($start_date && $end_date, function ($q) use ($start_date, $end_date) {
                $q->whereBetween('created_at', [
                    Carbon::parse($start_date)->startOfDay(),
                    Carbon::parse($end_date)->endOfDay()
                ]);
            })
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy('date', 'DESC')
            ->get();

        // Add S.No
        $jobformsubmission = $jobformsubmission->values()->map(function ($item, $index) {
            return [
                'date'  => Carbon::parse($item->date)->format('d-m-Y'),
                'count' => $item->count,
            ];
        });

        return response()->json([
            'success' => true,
            'message' => 'Dashboard data fetched successfully',
            'contract_emps' => $contract_emps,
            'jobformsubmission' => $jobformsubmission
        ]);
    }
}
