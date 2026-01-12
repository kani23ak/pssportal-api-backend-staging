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
        Schema::create('employee_experiences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained()->cascadeOnDelete();
            $table->string('job_title');
            $table->string('company_industry')->nullable();
            $table->string('company_name');
            $table->decimal('previous_salary', 10, 2)->nullable();
            // Period of work
            $table->date('from_date')->nullable();
            $table->date('to_date')->nullable();

            // Responsibilities (tags / multiple values)
            $table->json('responsibilities')->nullable();
            $table->json('verification_documents')->nullable();

            $table->timestamps();

            $table->index(['employee_id']);
            $table->index(['company_name']);
            $table->index(['job_title']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_experiences');
    }
};
