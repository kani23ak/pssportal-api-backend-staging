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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->text('address');
            $table->string('gst_number')->unique();
            $table->string('website_url')->unique();
            $table->string('phone_number');
            $table->string('support_email')->unique();
            $table->string('billing_email')->unique();
            $table->tinyInteger('status')->default(1); // 1=Active
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->tinyInteger('is_deleted')->default(0);
            $table->timestamps();

            $table->index(['company_name', 'created_by', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
