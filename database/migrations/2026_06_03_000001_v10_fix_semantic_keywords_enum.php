<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

/**
 * v10 Fix: Expand semantic_keywords ENUM to include all 21 keyword types.
 *
 * Problems fixed:
 * 1. 'comparison' and 'semantic' were missing from ENUM → INSERTs failed silently
 * 2. 'informational' and 'transactional' were stored as keyword_type values
 *    but they are search_intent values → conceptual bug, wastes rows
 * 3. ENUM now includes all 13 user-requested types + 8 power types
 */
return new class extends Migration {
    public function up(): void
    {
        // Step 1: Remove bad rows where search_intent values were saved as keyword_type
        // These are conceptual errors — 'informational' and 'transactional' are
        // search_intent values, not keyword types. They'll be re-extracted correctly.
        DB::statement("DELETE FROM semantic_keywords
            WHERE keyword_type IN ('informational','transactional')");

        // Step 2: Add temp column to preserve existing data during ENUM change
        Schema::table('semantic_keywords', function (Blueprint $t) {
            $t->string('ktype_tmp', 50)->nullable()->after('keyword_type');
        });

        // Step 3: Copy existing keyword_type values to temp column
        DB::statement("UPDATE semantic_keywords SET ktype_tmp = keyword_type");

        // Step 4: Drop old ENUM column
        Schema::table('semantic_keywords', function (Blueprint $t) {
            $t->dropColumn('keyword_type');
        });

        // Step 5: Rename temp to keyword_type
        Schema::table('semantic_keywords', function (Blueprint $t) {
            $t->renameColumn('ktype_tmp', 'keyword_type');
        });

        // Step 6: Set correct ENUM with all 21 values
        // 13 user-requested: primary, secondary, autocomplete, lsi, paa, entity,
        //   semantic, long_tail, question, related, comparison, transactional, informational
        // 8 additional power types: short_tail, modifier, contextual, tfidf, cluster,
        //   supporting, trending, search_intent
        DB::statement("ALTER TABLE semantic_keywords
            MODIFY COLUMN keyword_type ENUM(
                'primary',
                'secondary',
                'autocomplete',
                'lsi',
                'paa',
                'entity',
                'semantic',
                'long_tail',
                'question',
                'related',
                'comparison',
                'transactional',
                'informational',
                'short_tail',
                'modifier',
                'contextual',
                'tfidf',
                'cluster',
                'supporting',
                'trending',
                'search_intent'
            ) NOT NULL DEFAULT 'lsi'");
    }

    public function down(): void
    {
        // Revert to v8 ENUM (17 values)
        DB::statement("ALTER TABLE semantic_keywords
            MODIFY COLUMN keyword_type ENUM(
                'primary','secondary','long_tail','short_tail','lsi',
                'search_intent','entity','paa','question','cluster',
                'related','supporting','modifier','contextual','tfidf',
                'autocomplete','trending'
            ) NOT NULL DEFAULT 'lsi'");
    }
};
