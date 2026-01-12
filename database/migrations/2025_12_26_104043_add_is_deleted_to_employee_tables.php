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
        Schema::table('employee_document_groups', function (Blueprint $table) {
            if (!Schema::hasColumn('employee_document_groups', 'is_deleted')) {
                $table->tinyInteger('is_deleted')->default(0)->after('id');
            }
        });

        Schema::table('employee_educations', function (Blueprint $table) {
            if (!Schema::hasColumn('employee_educations', 'is_deleted')) {
                $table->tinyInteger('is_deleted')->default(0)->after('id');
            }
        });

        Schema::table('employee_experiences', function (Blueprint $table) {
            if (!Schema::hasColumn('employee_experiences', 'is_deleted')) {
                $table->tinyInteger('is_deleted')->default(0)->after('id');
            }
        });

        Schema::table('employee_verifications', function (Blueprint $table) {
            if (!Schema::hasColumn('employee_verifications', 'is_deleted')) {
                $table->tinyInteger('is_deleted')->default(0)->after('id');
            }
        });

         Schema::table('contact_details', function (Blueprint $table) {
            if (!Schema::hasColumn('contact_details', 'is_deleted')) {
                $table->tinyInteger('is_deleted')->default(0)->after('id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employee_document_groups', function (Blueprint $table) {
            if (Schema::hasColumn('employee_document_groups', 'is_deleted')) {
                $table->dropColumn('is_deleted');
            }
        });

        Schema::table('employee_educations', function (Blueprint $table) {
            if (Schema::hasColumn('employee_educations', 'is_deleted')) {
                $table->dropColumn('is_deleted');
            }
        });

        Schema::table('employee_experiences', function (Blueprint $table) {
            if (Schema::hasColumn('employee_experiences', 'is_deleted')) {
                $table->dropColumn('is_deleted');
            }
        });

        Schema::table('employee_verifications', function (Blueprint $table) {
            if (Schema::hasColumn('employee_verifications', 'is_deleted')) {
                $table->dropColumn('is_deleted');
            }
        });

         Schema::table('contact_details', function (Blueprint $table) {
            if (Schema::hasColumn('contact_details', 'is_deleted')) {
                $table->dropColumn('is_deleted');
            }
        });

        
    }
};
