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
        Schema::create('employee_verifications', function (Blueprint $table) {
            $table->id();
            // Parent reference
            $table->foreignId('employee_id')
                ->constrained('employees')
                ->cascadeOnDelete();
            $table->string('document_type');
            $table->boolean('is_verified')->default(false);
            $table->string('created_date');
            $table->timestamps();
            $table->index(['employee_id']);
            $table->index(['document_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_verifications');
    }
};
