<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * v12: Add 'answer' column to semantic_keywords table
 * Stores real FAQ answers for PAA questions, used by FAQPage schema
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('semantic_keywords', function (Blueprint $table) {
            if (!Schema::hasColumn('semantic_keywords', 'answer')) {
                $table->text('answer')->nullable()->after('keyword');
            }
        });
    }

    public function down(): void
    {
        Schema::table('semantic_keywords', function (Blueprint $table) {
            if (Schema::hasColumn('semantic_keywords', 'answer')) {
                $table->dropColumn('answer');
            }
        });
    }
};
