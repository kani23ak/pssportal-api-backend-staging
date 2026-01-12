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
        Schema::table('attendance_details', function (Blueprint $table) {
            
            // 1️⃣ Drop existing foreign key
            $table->dropForeign(['employee_id']);

            // 2️⃣ Add new foreign key
            $table->foreign('employee_id')
                  ->references('id')
                  ->on('contract_can_emps')   // 👈 change table name here
                  ->cascadeOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('attendance_details', function (Blueprint $table) {
             // rollback: drop new FK
            $table->dropForeign(['employee_id']);

            // restore old FK
            $table->foreign('employee_id')
                  ->references('id')
                  ->on('contract_employees')
                  ->cascadeOnDelete();
        });
    }
};
