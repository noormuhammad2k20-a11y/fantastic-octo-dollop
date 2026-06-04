<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\Seo\SemanticExtractorService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class SeoExtractSemanticsCommand extends Command
{
    protected $signature = 'seo:extract-semantics
        {--limit=   : Max tools}
        {--tool=    : Single tool slug}
        {--dry-run  : Preview only}
        {--force    : Re-extract even if data exists}
        {--batch=25 : Chunk size for processing}';

    protected $description = 'Extract semantic keywords (autocomplete + AI) for tools';

    public function handle(SemanticExtractorService $extractor): int
    {
        // SAFETY: Verify GEMINI_API_KEY is set before starting
        if (empty(config('services.gemini.api_key'))) {
            $this->error('❌ GEMINI_API_KEY not set in .env — aborting');
            return Command::FAILURE;
        }

        $limit     = $this->option('limit') ? (int) $this->option('limit') : null;
        $batchSize = (int) $this->option('batch');
        ini_set('memory_limit', '256M');

        $query = DB::table('tool_health_checks as t')
            ->select('t.tool_slug')
            ->where('t.status', 'ok');

        if (!$this->option('force')) {
            // FIXED v10: Only skip tools that have AI (Gemini) keywords.
            // Previously ALL 1417 tools were skipped because every tool has
            // autocomplete (google_suggest) keywords. The old code checked for
            // ANY keyword, so 100% of tools were in the "already done" list.
            $slugsWithAiKeywords = DB::table('semantic_keywords')
                ->where('source', 'gemini')
                ->where('keyword_type', '!=', 'autocomplete')
                ->distinct()
                ->pluck('tool_slug');

            if ($slugsWithAiKeywords->isNotEmpty()) {
                $query->whereNotIn('t.tool_slug', $slugsWithAiKeywords);
            }
            // If no tools have AI keywords yet, process all (first run)
        }

        if ($slug = $this->option('tool')) {
            $query->where('t.tool_slug', $slug);
        }

        if ($limit) $query->limit($limit);

        $total = $query->count();

        if ($total === 0) {
            $this->info("No tools need semantic extraction.");
            return Command::SUCCESS;
        }

        if ($this->option('dry-run')) {
            $this->info("DRY RUN: Would extract semantics for {$total} tools");
            return Command::SUCCESS;
        }

        $this->info("Extracting semantics for {$total} tools (batch size: {$batchSize})...");
        $bar = $this->output->createProgressBar($total);
        $bar->start();

        $success = 0; $failed = 0;

        $query->orderBy('t.id')->chunk($batchSize, function($tools) use (
            $extractor, $bar, &$success, &$failed
        ) {
            foreach ($tools as $tool) {
                try {
                    $keywords = $extractor->extractForTool($tool->tool_slug);

                    if ($keywords->isEmpty()) {
                        $failed++;
                    } else {
                        foreach ($keywords as $kw) {
                            DB::table('semantic_keywords')->updateOrInsert(
                                [
                                    'tool_slug'    => $tool->tool_slug,
                                    'keyword'      => mb_strtolower(trim($kw['keyword'])),
                                    'keyword_type' => $kw['type'],
                                ],
                                [
                                    'search_intent'    => $kw['intent'] ?? 'informational',
                                    'source'           => $kw['source'],
                                    'confidence_score' => $kw['confidence'] ?? 0.80,
                                    'answer'           => $kw['answer'] ?? null,  // v12: PAA answers
                                    'is_active'        => 1,
                                    'language'         => 'en',
                                    'extracted_at'     => now(),
                                    'created_at'       => now(),
                                    'updated_at'       => now(),
                                ]
                            );
                        }

                        $success++;
                        Log::channel('seo')->info("Semantics extracted: {$tool->tool_slug} ({$keywords->count()} terms)");
                    }

                } catch (\Exception $e) {
                    $failed++;
                    Log::channel('seo')->error("Semantics failed: {$tool->tool_slug} — {$e->getMessage()}");
                }

                $bar->advance();
                usleep(2500000); // 2.5 second delay between calls to avoid hitting OpenAI/Google rate limits
            }
            gc_collect_cycles();
        });

        $bar->finish();
        $this->newLine();
        $this->info("✅ Success: {$success} | Failed: {$failed}");

        if ($failed > 0) {
            $this->warn("⚠ {$failed} tools failed — check storage/logs/seo.log for details.");
        }

        return Command::SUCCESS;
    }
}
