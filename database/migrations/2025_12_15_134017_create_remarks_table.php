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
        Schema::create('remarks', function (Blueprint $table) {
            $table->id();

            // Foreign key to job_forms
            $table->foreignId('parent_id')
                ->constrained('job_forms')
                ->onDelete('cascade');

            // Remarks content
            $table->text('notes')->nullable();

            // Custom created date
            $table->timestamp('created_date')->nullable();

            // Soft delete flag
            $table->boolean('is_deleted')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('remarks');
    }
};
