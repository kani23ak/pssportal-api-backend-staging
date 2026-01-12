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
        Schema::table('pss_employee_attendances', function (Blueprint $table) {
            $table->unsignedBigInteger('shift_id')->nullable()->after('attendance_time');
            $table->dropColumn('shift');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pss_employee_attendances', function (Blueprint $table) {
            $table->enum('shift', ['day', 'night'])->after('attendance_time');
            $table->dropColumn('shift_id');
        });
    }
};
