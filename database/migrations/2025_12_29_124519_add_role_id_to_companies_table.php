<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // companies table
        Schema::table('companies', function (Blueprint $table) {
            if (!Schema::hasColumn('companies', 'role_id')) {
                $table->string('role_id')->default('admin');
            }
        });

        // contract_employees table
        Schema::table('contract_employees', function (Blueprint $table) {
            if (!Schema::hasColumn('contract_employees', 'role_id')) {
                $table->string('role_id')->default('admin');
            }
        });

        // attendances table
        Schema::table('attendances', function (Blueprint $table) {
            if (!Schema::hasColumn('attendances', 'role_id')) {
               $table->string('role_id')->default('admin');
            }
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // companies
        Schema::table('companies', function (Blueprint $table) {
            if (Schema::hasColumn('companies', 'role_id')) {
                $table->dropColumn('role_id');
            }
        });

        // contract_employees
        Schema::table('contract_employees', function (Blueprint $table) {
            if (Schema::hasColumn('contract_employees', 'role_id')) {
                $table->dropColumn('role_id');
            }
        });

        // attendances
        Schema::table('attendances', function (Blueprint $table) {
            if (Schema::hasColumn('attendances', 'role_id')) {
                $table->dropColumn('role_id');
            }
        });
    }
};
