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
        Schema::create('contract_employees', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('address');
            $table->string('phone_number')->unique();
            $table->string('aadhar_number', 12)->unique();
            $table->string('company_name');
            $table->date('interview_date');
            $table->string('interview_status');
            $table->date('joining_date')->nullable();
            $table->string('joining_status')->nullable();
            $table->string('reference')->nullable();
            $table->tinyInteger('status')->default(1); // 1=Active, 0=Inactive
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->tinyInteger('is_deleted')->default(0);
            $table->timestamps();

            $table->index(['name', 'company_name', 'status', 'created_by']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contract_employees');
    }
};
