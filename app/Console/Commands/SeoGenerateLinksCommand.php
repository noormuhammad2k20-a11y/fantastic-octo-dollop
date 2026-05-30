<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\Seo\InternalLinkingService;

class SeoGenerateLinksCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seo:generate-links 
                            {--limit=8 : Max outgoing links per tool}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the semantic internal link graph based on topical clusters';

    /**
     * Execute the console command.
     */
    public function handle(InternalLinkingService $linker): int
    {
        $this->info("Starting Semantic Link Graph Generation...");
        $limit = (int) $this->option('limit');

        $this->info("Maximum outgoing links per tool: {$limit}");
        
        $startTime = microtime(true);
        
        try {
            $linker->generateLinkGraph($limit);
            
            $duration = round(microtime(true) - $startTime, 2);
            $this->newLine();
            $this->info("Link Graph Generation Complete in {$duration}s!");
            
            // Output stats
            $totalLinks = \App\Models\InternalLink::count();
            $this->line("<fg=green>Total active links in graph:</> {$totalLinks}");
            
            return Command::SUCCESS;
        } catch (\Exception $e) {
            $this->error("Failed to generate link graph: " . $e->getMessage());
            return Command::FAILURE;
        }
    }
}
