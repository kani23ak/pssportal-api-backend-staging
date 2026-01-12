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
        Schema::create('job_forms', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email_id')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('aadhar_number')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->string('gender')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('education')->nullable();
            $table->string('major')->nullable();
            $table->string('city')->nullable();
            $table->string('district')->nullable();
            $table->string('reference')->nullable();
            $table->string('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_forms');
    }
};
