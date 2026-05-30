<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\Seo\ContentGenerationService;
use App\Models\ContentDraft;
use Illuminate\Support\Facades\Cache;

class SeoGenerateContentCommand extends Command
{
    // HOTFIX-1.0: Removed hardcoded limit=5 default. 0 = process all tools.
    protected $signature = 'seo:generate-content 
                            {--limit=0 : Number of tools to generate content for (0 = all)}
                            {--tool= : Process a specific tool slug}
                            {--force : Overwrite existing drafts}
                            {--dry-run : Show what would be processed without making changes}
                            {--category= : Process only tools in this category slug}';

    protected $description = 'Generate SEO content drafts using LLM based on extracted semantics';

    public function handle(ContentGenerationService $generator): int
    {
        // HOTFIX-1.0: Set memory/time limits for 1400+ tools
        ini_set('memory_limit', config('seo.content_generation.memory_limit', '512M'));
        set_time_limit((int) config('seo.content_generation.time_limit', 3600));

        $this->info("Starting Content Draft Generation...");
        
        $tools = $this->getToolsToProcess();
        
        if (empty($tools)) {
            $this->error("No tools found to process.");
            return Command::FAILURE;
        }

        $totalTools = count($tools);

        // HOTFIX-1.0: Dry-run mode — show what would run without doing it
        if ($this->option('dry-run')) {
            $this->info("DRY RUN MODE — No changes will be made");
            $this->info("Tools that would be processed: {$totalTools}");
            $this->newLine();
            foreach ($tools as $slug => $config) {
                $name = $config['name'] ?? $slug;
                $this->line("  Would process: [{$slug}] {$name}");
            }
            return Command::SUCCESS;
        }

        $bar = $this->output->createProgressBar($totalTools);
        $bar->start();

        $successCount = 0;
        $failCount = 0;
        $skippedCount = 0;

        // HOTFIX-1.0: Cache progress so admin panel can show real-time status
        Cache::put('seo:generation_progress', [
            'started_at'    => now()->toIso8601String(),
            'total'         => $totalTools,
            'processed'     => 0,
            'failed'        => 0,
            'current_tool'  => null,
        ], now()->addHours(12));

        $batchSize = (int) config('seo.content_generation.batch_size', 50);
        $chunks = array_chunk($tools, $batchSize, true);

        foreach ($chunks as $chunk) {
            foreach ($chunk as $slug => $config) {
                // Update progress cache
                Cache::put('seo:generation_progress', array_merge(
                    Cache::get('seo:generation_progress', []),
                    ['current_tool' => $slug, 'processed' => $successCount + $skippedCount, 'failed' => $failCount]
                ), now()->addHours(12));

                // HOTFIX-1.0: Force flag updates existing, does not create duplicates
                if ($this->option('force')) {
                    // Force mode: proceed regardless of existing drafts
                } else {
                    // Check for existing drafts
                    $existing = ContentDraft::where('tool_slug', $slug)
                        ->whereIn('status', ['pending_review', 'published'])
                        ->exists();
                        
                    if ($existing) {
                        $skippedCount++;
                        $bar->advance();
                        continue;
                    }
                }

                try {
                    $draft = $generator->generateDraftForTool($slug, $config);
                    if ($draft) {
                        $successCount++;
                    } else {
                        $failCount++;
                    }
                } catch (\Exception $e) {
                    $failCount++;
                    $this->error(" Error on {$slug}: " . $e->getMessage());
                }

                $bar->advance();
            }

            // HOTFIX-1.0: Allow garbage collection between chunks
            gc_collect_cycles();
        }

        $bar->finish();
        $this->newLine(2);

        // HOTFIX-1.0: Store last run timestamp
        Cache::put('seo:last_content_generation_run', now()->toIso8601String(), now()->addDays(30));

        $this->info("Content Generation Complete!");
        $this->line("<fg=green>Generated:</> {$successCount}");
        $this->line("<fg=yellow>Skipped (Existing):</> {$skippedCount}");
        if ($failCount > 0) {
            $this->line("<fg=red>Failed:</> {$failCount}");
        }
        $this->line("<fg=cyan>Total tools found:</> {$totalTools}");

        return $failCount === 0 ? Command::SUCCESS : Command::FAILURE;
    }

    private function getToolsToProcess(): array
    {
        $allTools = array_merge(config('tools.tools', []), config('pro_calculators', []));
        
        // HOTFIX-1.0: Filter by specific tool slug
        if ($specific = $this->option('tool')) {
            return isset($allTools[$specific]) ? [$specific => $allTools[$specific]] : [];
        }

        // HOTFIX-1.0: Filter by category
        if ($category = $this->option('category')) {
            $allTools = array_filter($allTools, function ($config) use ($category) {
                return ($config['category'] ?? '') === $category;
            });
        }
        
        // HOTFIX-1.0: limit=0 means ALL tools (no artificial cap)
        $limit = (int) $this->option('limit');
        if ($limit > 0) {
            return array_slice($allTools, 0, $limit, true);
        }

        return $allTools;
    }
}

