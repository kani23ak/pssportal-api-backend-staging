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
        Schema::create('lead_management', function (Blueprint $table) {
            $table->id();
            $table->string('lead_id')->nullable();
            $table->string('created_time')->nullable();
            $table->string('ad_id')->nullable();
            $table->string('ad_name')->nullable();
            $table->string('adset_id')->nullable();
            $table->string('adset_name')->nullable();
            $table->string('campaign_id')->nullable();
            $table->string('campaign_name')->nullable();
            $table->string('form_id')->nullable();
            $table->string('form_name')->nullable();
            $table->string('is_organic')->nullable();
            $table->string('platform')->nullable();
            $table->string('full_name')->nullable();
            $table->string('gender')->nullable();
            $table->string('phone')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->string('post_code')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('lead_status')->nullable();
            $table->enum('status', ['1', '0'])->default('1');
            $table->enum('is_deleted', ['0', '1'])->default('0');
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lead_management');
    }
};
