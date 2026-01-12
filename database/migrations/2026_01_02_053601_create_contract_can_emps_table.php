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
        Schema::create('contract_can_emps', function (Blueprint $table) {
           $table->id();
            $table->foreignId('company_id')
                ->constrained('companies')
                ->cascadeOnDelete();
            $table->string('name');
            $table->text('address');
            $table->string('phone_number');
            $table->string('aadhar_number', 12)->unique();
            $table->date('joining_date')->nullable();
             $table->string('employee_id')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('father_name')->nullable();
            $table->string('gender')->nullable();
            $table->string('acc_no')->nullable();
            $table->string('ifsc_code')->nullable();
            $table->string('uan_number')->nullable();
            $table->string('esic')->nullable();
            $table->tinyInteger('status')->default(1); // 1=Active, 0=Inactive
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->tinyInteger('is_deleted')->default(0);
            $table->timestamps();

            $table->index(['name', 'company_id', 'status', 'created_by']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contract_can_emps');
    }
};
