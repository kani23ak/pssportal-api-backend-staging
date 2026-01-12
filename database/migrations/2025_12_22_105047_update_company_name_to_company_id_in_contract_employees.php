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
        Schema::table('contract_employees', function (Blueprint $table) {
            // Add foreign key
            $table->foreignId('company_id')
                ->after('aadhar_number')
                ->constrained('companies')
                ->cascadeOnDelete();

            $table->dropColumn('company_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contract_employees', function (Blueprint $table) {
            $table->dropForeign(['company_id']);
            $table->string('company_name');
        });
    }
};
