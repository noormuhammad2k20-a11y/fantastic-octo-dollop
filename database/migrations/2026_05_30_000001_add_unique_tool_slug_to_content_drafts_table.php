<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * HOTFIX-1.0: Add UNIQUE constraint to content_drafts.tool_slug
 * to prevent duplicate drafts per tool.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('content_drafts', function (Blueprint $table) {
            // HOTFIX-1.0: Prevent duplicate drafts per tool
            $table->unique('tool_slug', 'unique_content_draft_tool_slug');
        });
    }

    public function down(): void
    {
        Schema::table('content_drafts', function (Blueprint $table) {
            $table->dropUnique('unique_content_draft_tool_slug');
        });
    }
};
