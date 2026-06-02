<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    public function up(): void
    {
        // Step 0: Convert old 'semantic' type to 'lsi' (semantic is not in new ENUM)
        DB::table('semantic_keywords')
            ->where('keyword_type', 'semantic')
            ->update(['keyword_type' => 'lsi']);

        // Step 1: Add temp column
        Schema::table('semantic_keywords', function (Blueprint $table) {
            $table->string('kw_type_tmp', 50)->after('keyword_type')->nullable();
        });

        // Step 2: Copy existing values
        DB::statement('UPDATE semantic_keywords SET kw_type_tmp = keyword_type');

        // Step 3: Drop old ENUM
        Schema::table('semantic_keywords', function (Blueprint $table) {
            $table->dropColumn('keyword_type');
        });

        // Step 4: Rename temp column
        Schema::table('semantic_keywords', function (Blueprint $table) {
            $table->renameColumn('kw_type_tmp', 'keyword_type');
        });

        // Step 5: Apply new ENUM with all 17 values (15 types + autocomplete + trending)
        DB::statement("
            ALTER TABLE semantic_keywords
            MODIFY COLUMN keyword_type ENUM(
                'primary',
                'secondary',
                'long_tail',
                'short_tail',
                'lsi',
                'search_intent',
                'entity',
                'paa',
                'question',
                'cluster',
                'related',
                'supporting',
                'modifier',
                'contextual',
                'tfidf',
                'autocomplete',
                'trending'
            ) NOT NULL DEFAULT 'lsi'
        ");

        // Step 6: Add missing indexes
        Schema::table('semantic_keywords', function (Blueprint $table) {
            // Only add if not exists
            try {
                $table->index(['tool_slug', 'keyword_type', 'is_active'], 'idx_sk_tool_type_active');
            } catch (\Exception $e) { /* index may already exist */ }
        });
    }

    public function down(): void
    {
        DB::statement("
            ALTER TABLE semantic_keywords
            MODIFY COLUMN keyword_type
            ENUM('primary','lsi','semantic','autocomplete','paa','entity','trending')
            NOT NULL DEFAULT 'lsi'
        ");
    }
};
