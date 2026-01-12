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
        Schema::table('employees', function (Blueprint $table) {
            $table->string('aadhaar_no')->nullable()->change();
            $table->string('pan_no')->nullable()->change();
            $table->string('phone_no')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
             $table->string('aadhaar_no')->nullable(false)->change();
            $table->string('pan_no')->nullable(false)->change();
            $table->string('phone_no')->nullable(false)->change();
        });
    }
};
