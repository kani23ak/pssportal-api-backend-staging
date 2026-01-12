<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PssCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pss_company')->insert([
            [
                'name' => 'ABC Technologies',
                'address' => 'Bangalore, India',
                'status' => '1',
                'is_deleted' => '0',
                'created_by' => 'admin',
                'updated_by' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'XYZ Solutions',
                'address' => 'Chennai, India',
                'status' => '1',
                'is_deleted' => '0',
                'created_by' => 'admin',
                'updated_by' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Demo Company',
                'address' => 'Hyderabad, India',
                'status' => '0',
                'is_deleted' => '1',
                'created_by' => 'system',
                'updated_by' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
