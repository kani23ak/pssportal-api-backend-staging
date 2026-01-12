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
        Schema::create('employee_documents', function (Blueprint $table) {
            $table->id();
            // Parent document group
            $table->foreignId('document_group_id')
                ->constrained('employee_document_groups')
                ->cascadeOnDelete();

            // File data
            $table->string('file_path');      // Stored filename
            $table->string('original_name');  // Original uploaded filename
            $table->timestamps();

            $table->index(['document_group_id']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_documents');
    }
};
