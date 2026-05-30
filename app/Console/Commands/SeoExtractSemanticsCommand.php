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
        {--force    : Re-extract even if data exists}';

    public function handle(SemanticExtractorService $extractor): int
    {
        $limit   = $this->option('limit') ? (int) $this->option('limit') : null;
        ini_set('memory_limit', '256M');

        $query = DB::table('tool_health_checks as t')
            ->select('t.tool_slug')
            ->where('t.status', 'ok');

        if (!$this->option('force')) {
            // Skip tools that already have semantic keywords
            $query->whereNotIn('t.tool_slug',
                DB::table('semantic_keywords')->distinct()->pluck('tool_slug')
            );
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

        $this->info("Extracting semantics for {$total} tools...");
        $bar = $this->output->createProgressBar($total);
        $bar->start();

        $success = 0; $failed = 0;

        $query->orderBy('t.id')->chunk(25, function($tools) use (
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
                                    'keyword'      => mb_strtolower($kw['keyword']),
                                    'keyword_type' => $kw['type'],
                                ],
                                [
                                    'search_intent'    => $kw['intent'] ?? 'informational',
                                    'source'           => $kw['source'],
                                    'confidence_score' => $kw['confidence'] ?? 0.80,
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
        return Command::SUCCESS;
    }
}
