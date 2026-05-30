<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ContentDraft;
use App\Services\SEO\ToolContextExtractor;
use App\Services\SEO\OpenAIContentGenerator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class SeoGenerateContentCommand extends Command
{
    // Keeping 'seo:generate-content' name to avoid breaking existing crons
    protected $signature = 'seo:generate-content
        {--limit=    : Max tools to process (for testing)}
        {--tool=     : Process single tool by slug}
        {--category= : Process only tools in this category}
        {--dry-run   : Preview without generating}
        {--force     : Re-generate even if draft exists}
        {--batch=50  : Chunk size}';

    protected $description = 'Generate unique SEO content for tools using OpenAI';

    public function handle(
        ToolContextExtractor $contextExtractor,
        OpenAIContentGenerator $generator
    ): int {
        // Safety check
        if (empty(config('services.openai.api_key'))) {
            $this->error('❌ OPENAI_API_KEY not set in .env — aborting');
            return Command::FAILURE;
        }

        $batchSize = (int) $this->option('batch');
        $limit     = $this->option('limit') ? (int) $this->option('limit') : null;
        ini_set('memory_limit', config('seo.content_generation.memory_limit', '512M'));
        set_time_limit(0);

        // Build query — target tools WITHOUT approved/published content (unless --force)
        $query = DB::table('tool_health_checks as t')
            ->select('t.tool_slug');
            
        // Assuming there is a tool_name column or we extract from config
        // In this schema, we just need the slug.

        if (!$this->option('force')) {
            $query->leftJoin('content_drafts as cd', function($join) {
                $join->on('cd.tool_slug', '=', 't.tool_slug')
                     ->whereIn('cd.status', ['approved', 'published']);
            })
            ->whereNull('cd.id');  // No approved content yet
        }

        $query->where('t.status', 'ok');

        // Single tool mode
        if ($slug = $this->option('tool')) {
            $query->where('t.tool_slug', $slug);
        }

        // Category filter (simple LIKE based on slug if we don't have category in DB)
        // Alternatively, we could filter after fetching, but doing it in SQL is faster.
        if ($cat = $this->option('category')) {
            $query->where('t.tool_slug', 'LIKE', "%{$cat}%");
        }

        if ($limit) {
            $query->limit($limit);
        }

        $total = $query->count();

        if ($total === 0) {
            $this->info("No tools found that need content generation.");
            return Command::SUCCESS;
        }

        if ($this->option('dry-run')) {
            $this->info("DRY RUN: Would process {$total} tools");
            $query->chunk($batchSize, function($tools) {
                foreach ($tools as $tool) {
                    $this->line("  → {$tool->tool_slug}");
                }
            });
            return Command::SUCCESS;
        }

        $this->info("Processing {$total} tools in batches of {$batchSize}");
        $bar = $this->output->createProgressBar($total);
        $bar->start();

        $processed = 0; $failed = 0;

        $query->orderBy('t.id')->chunk($batchSize, function($tools) use (
            $bar, $contextExtractor, $generator, &$processed, &$failed
        ) {
            foreach ($tools as $tool) {
                try {
                    // Extract tool-specific context from slug
                    $context = $contextExtractor->extract($tool->tool_slug);

                    // Generate unique content using context
                    $content = $generator->generateForTool($context);

                    // Save (updateOrCreate prevents duplicates)
                    ContentDraft::updateOrCreate(
                        ['tool_slug' => $tool->tool_slug],
                        [
                            'draft_type'             => 'full_article',
                            'status'                 => 'pending_review',
                            'draft_content'          => $content['html'],
                            'outline_json'           => $content['outline'],
                            'ai_model_used'          => $content['model'],
                            'generation_prompt_hash' => md5($content['prompt_used']),
                            'word_count'             => $content['word_count'],
                            'seo_score'              => $content['seo_score'] ?? null,
                            'language'               => 'en',
                        ]
                    );

                    Log::channel('seo')->info("Content generated: {$tool->tool_slug}");
                    $processed++;

                } catch (\Exception $e) {
                    Log::channel('seo')->error("Failed: {$tool->tool_slug} — {$e->getMessage()}");
                    $failed++;
                }

                $bar->advance();
            }
            gc_collect_cycles();
        });

        $bar->finish();
        $this->newLine();
        $this->info("✅ Done. Processed: {$processed} | Failed: {$failed}");
        return Command::SUCCESS;
    }
}
