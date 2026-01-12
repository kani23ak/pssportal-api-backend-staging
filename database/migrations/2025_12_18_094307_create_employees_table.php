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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            // Basic Information
            $table->string('full_name');
            $table->string('aadhaar_no')->unique();
            $table->string('pan_no')->unique();
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->enum('marital_status', ['single', 'married'])->nullable();
            $table->string('spouse_name')->nullable();
            $table->string('phone_no');
            $table->string('email')->unique()->nullable();
            $table->string('qualification')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->text('local_address')->nullable();
            $table->text('permanent_address')->nullable();
            $table->string('photo')->nullable();

            // Bank Information
            $table->string('bank_name')->nullable();
            $table->string('bank_account_no')->nullable();
            $table->string('ifsc_code')->nullable();
            $table->string('bank_branch')->nullable();

            // Salary Information
            $table->decimal('salary_amount', 10, 2)->nullable();
            $table->string('salary_basis')->nullable(); // monthly / daily
            $table->string('payment_type')->nullable(); // cash / bank
            $table->date('effective_date')->nullable();

            // Skills (JSON)
            $table->json('skills')->nullable();

            $table->tinyInteger('status')->default(1); // 1=Active, 0=Inactive
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->tinyInteger('is_deleted')->default(0);
            $table->timestamps();

            $table->index(['full_name']);
            $table->index(['phone_no']);
            $table->index(['email']);
            $table->index(['aadhaar_no']);
            $table->index(['pan_no']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
