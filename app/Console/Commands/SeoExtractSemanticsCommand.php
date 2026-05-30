<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\Seo\SemanticExtractionService;
use App\Models\ToolAnalytics;
use Illuminate\Support\Facades\Log;

class SeoExtractSemanticsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    // HOTFIX-1.0: Removed hardcoded limit=10 default. 0 = process all tools.
    protected $signature = 'seo:extract-semantics 
                            {--limit=0 : Number of tools to process (0 = all)}
                            {--tool= : Process a specific tool slug}
                            {--popular : Process the most popular tools first}
                            {--dry-run : Show what would be processed without making changes}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Extract semantic keywords and clusters for tools via Python microservice';

    /**
     * Execute the console command.
     */
    public function handle(SemanticExtractionService $extractor): int
    {
        $this->info("Starting SEO Semantic Extraction Process...");

        $tools = $this->getToolsToProcess();

        if (empty($tools)) {
            $this->error("No tools found to process.");
            return Command::FAILURE;
        }

        $totalTools = count($tools);
        $this->info("Found {$totalTools} tools to process.");

        // HOTFIX-1.0: Dry-run mode
        if ($this->option('dry-run')) {
            $this->info("DRY RUN MODE — No changes will be made");
            foreach ($tools as $slug => $config) {
                $this->line("  Would process: [{$slug}]");
            }
            return Command::SUCCESS;
        }
        
        $bar = $this->output->createProgressBar($totalTools);
        $bar->start();

        $successCount = 0;
        $failCount = 0;

        foreach ($tools as $slug => $config) {
            try {
                // 1. Call Python API
                $payload = $extractor->extractFromService($slug, $config);

                if ($payload) {
                    // 2. Persist to MySQL
                    $persisted = $extractor->persistExtraction($slug, $payload);
                    if ($persisted) {
                        $successCount++;
                    } else {
                        $failCount++;
                    }
                } else {
                    $failCount++;
                }
            } catch (\Exception $e) {
                $failCount++;
                Log::error("Command error extracting semantics for {$slug}: " . $e->getMessage());
            }

            $bar->advance();
            
            // Basic delay between tools to prevent overwhelming the local service
            // (The Python service handles Google rate limiting internally)
            usleep(500000); // 500ms
        }

        $bar->finish();
        $this->newLine(2);

        $this->info("Extraction Complete!");
        $this->line("<fg=green>Successfully processed:</> {$successCount} tools");
        if ($failCount > 0) {
            $this->line("<fg=red>Failed to process:</> {$failCount} tools");
        }

        return $failCount === 0 ? Command::SUCCESS : Command::FAILURE;
    }

    /**
     * Determine which tools to process based on arguments/options.
     */
    private function getToolsToProcess(): array
    {
        // Load all available tools
        $allTools = array_merge(config('tools.tools', []), config('pro_calculators', []));

        // Option 1: Specific tool
        if ($specific = $this->option('tool')) {
            if (isset($allTools[$specific])) {
                return [$specific => $allTools[$specific]];
            }
            $this->error("Tool slug '{$specific}' not found in config.");
            return [];
        }

        // Option 2: Popular tools
        $limit = (int) $this->option('limit');
        if ($this->option('popular')) {
            // Get top tools from DB analytics
            $topSlugs = ToolAnalytics::orderByDesc('view_count')
                ->limit($limit)
                ->pluck('tool_slug')
                ->toArray();

            $selected = [];
            foreach ($topSlugs as $slug) {
                if (isset($allTools[$slug])) {
                    $selected[$slug] = $allTools[$slug];
                }
            }
            return $selected;
        }

        // HOTFIX-1.0: limit=0 means ALL tools (no artificial cap)
        if ($limit > 0) {
            return array_slice($allTools, 0, $limit, true);
        }

        return $allTools;
    }
}
