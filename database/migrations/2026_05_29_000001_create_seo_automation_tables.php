<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * SEO Automation Tables — Phase 1 Foundation
 *
 * Creates 6 new tables for the semantic SEO automation system.
 * These are ADDITIVE ONLY — no existing tables are modified.
 *
 * Foreign key strategy: Uses tool_slug (VARCHAR) instead of numeric IDs
 * because tools are stored in config files, not a database table.
 *
 * Multilingual readiness: All tables include language + locale_data columns.
 */
return new class extends Migration
{
    public function up(): void
    {
        // ─── 1. Topical Clusters ─────────────────────────────────────
        Schema::create('topical_clusters', function (Blueprint $table) {
            $table->id();
            $table->string('cluster_name', 255);
            $table->unsignedBigInteger('parent_cluster_id')->nullable();
            $table->string('category_slug', 255)->nullable();
            $table->text('description')->nullable();
            $table->string('pillar_tool_slug', 255)->nullable();
            $table->tinyInteger('silo_depth')->default(1);
            $table->string('language', 5)->default('en');
            $table->json('locale_data')->nullable();
            $table->timestamps();

            $table->index('category_slug', 'idx_tc_category');
            $table->index('parent_cluster_id', 'idx_tc_parent');
            $table->index('language', 'idx_tc_language');
        });

        // ─── 2. Tool ↔ Cluster Map (Pivot) ───────────────────────────
        Schema::create('tool_cluster_map', function (Blueprint $table) {
            $table->id();
            $table->string('tool_slug', 255);
            $table->unsignedBigInteger('cluster_id');
            $table->decimal('relevance_score', 5, 2)->default(0.00);
            $table->boolean('is_primary')->default(false);
            $table->timestamps();

            $table->unique(['tool_slug', 'cluster_id'], 'unique_tool_cluster');
            $table->index('tool_slug', 'idx_tcm_tool');
            $table->index('cluster_id', 'idx_tcm_cluster');

            $table->foreign('cluster_id')
                  ->references('id')
                  ->on('topical_clusters')
                  ->onDelete('cascade');
        });

        // ─── 3. Semantic Keywords ────────────────────────────────────
        Schema::create('semantic_keywords', function (Blueprint $table) {
            $table->id();
            $table->string('tool_slug', 255);
            $table->string('keyword', 500);
            $table->enum('keyword_type', [
                'primary', 'lsi', 'semantic', 'autocomplete',
                'paa', 'entity', 'trending',
            ]);
            $table->enum('search_intent', [
                'informational', 'transactional', 'navigational', 'commercial',
            ]);
            $table->string('source', 100)->nullable();
            $table->decimal('confidence_score', 5, 2)->nullable();
            $table->boolean('is_active')->default(true);
            $table->string('language', 5)->default('en');
            $table->json('locale_data')->nullable();
            $table->timestamp('extracted_at')->nullable();
            $table->timestamps();

            $table->index('tool_slug', 'idx_sk_tool');
            $table->index('keyword_type', 'idx_sk_type');
            $table->index('search_intent', 'idx_sk_intent');
            $table->index('language', 'idx_sk_language');
        });

        // ─── 4. Internal Links ───────────────────────────────────────
        Schema::create('internal_links', function (Blueprint $table) {
            $table->id();
            $table->string('source_tool_slug', 255);
            $table->string('target_tool_slug', 255);
            $table->string('anchor_text_primary', 255);
            $table->json('anchor_text_variations')->nullable();
            $table->decimal('relevance_score', 5, 2)->default(0.00);
            $table->enum('placement_zone', [
                'content', 'sidebar', 'footer', 'related_section',
            ])->default('related_section');
            $table->boolean('is_active')->default(true);
            $table->boolean('auto_generated')->default(true);
            $table->boolean('human_reviewed')->default(false);
            $table->timestamp('last_refreshed_at')->nullable();
            $table->timestamps();

            $table->unique(['source_tool_slug', 'target_tool_slug'], 'unique_link');
            $table->index('source_tool_slug', 'idx_il_source');
            $table->index('target_tool_slug', 'idx_il_target');
            $table->index('relevance_score', 'idx_il_score');
        });

        // ─── 5. Content Drafts ───────────────────────────────────────
        Schema::create('content_drafts', function (Blueprint $table) {
            $table->id();
            $table->string('tool_slug', 255);
            $table->enum('draft_type', [
                'full_article', 'faq_section', 'intro_paragraph', 'schema_faq',
            ]);
            $table->enum('status', [
                'pending_review', 'approved', 'rejected', 'published',
            ])->default('pending_review');
            $table->json('outline_json')->nullable();
            $table->longText('draft_content')->nullable();
            $table->string('ai_model_used', 100)->nullable();
            $table->string('generation_prompt_hash', 64)->nullable();
            $table->unsignedInteger('word_count')->nullable();
            $table->unsignedInteger('seo_score')->nullable();
            $table->unsignedInteger('reviewed_by')->nullable();
            $table->timestamp('reviewed_at')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->string('language', 5)->default('en');
            $table->json('locale_data')->nullable();
            $table->timestamps();

            $table->index('tool_slug', 'idx_cd_tool');
            $table->index('status', 'idx_cd_status');
            $table->index('draft_type', 'idx_cd_type');
            $table->index('language', 'idx_cd_language');
        });

        // ─── 6. SEO Audit Log ────────────────────────────────────────
        Schema::create('seo_audit_log', function (Blueprint $table) {
            $table->id();
            $table->string('audit_type', 100);
            $table->string('entity_type', 50)->nullable();
            $table->string('entity_slug', 255)->nullable();
            $table->json('findings')->nullable();
            $table->enum('severity', [
                'critical', 'high', 'medium', 'low', 'info',
            ]);
            $table->boolean('is_resolved')->default(false);
            $table->timestamp('resolved_at')->nullable();
            $table->timestamps();

            $table->index('severity', 'idx_sal_severity');
            $table->index('is_resolved', 'idx_sal_resolved');
            $table->index('audit_type', 'idx_sal_type');
            $table->index('entity_slug', 'idx_sal_entity');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('seo_audit_log');
        Schema::dropIfExists('content_drafts');
        Schema::dropIfExists('internal_links');
        Schema::dropIfExists('semantic_keywords');
        Schema::dropIfExists('tool_cluster_map');
        Schema::dropIfExists('topical_clusters');
    }
};
