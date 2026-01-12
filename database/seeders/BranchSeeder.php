<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Branch;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Branch::create([
            'branch_name' => 'Head Office',
            'address'     => '123 Main Road',
            'city'        => 'Chennai',
            'state'       => 'Tamil Nadu',
            'country'     => 'India',
            'pincode'     => '600001',
            'status'      => 1,
            'is_deleted'  => '0',
            'created_by'  => 1,
            'updated_by'  => 1,
        ]);
    }
}
