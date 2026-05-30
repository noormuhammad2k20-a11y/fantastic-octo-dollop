<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Services\Seo\InternalLinkingService;

class SeoGenerateLinksCommand extends Command
{
    protected $signature = 'seo:generate-links
        {--limit=   : Max tools to process}
        {--dry-run  : Preview only}';

    protected $description = 'Generate the semantic internal link graph based on topical clusters and fallback logic';

    public function handle(InternalLinkingService $linker): int
    {
        ini_set('memory_limit', '256M');
        $limit = $this->option('limit') ? (int) $this->option('limit') : null;

        $tools = DB::table('tool_health_checks')
            ->select('tool_slug')
            ->where('status', 'ok')
            ->when($limit, fn($q) => $q->limit($limit))
            ->get();

        if ($this->option('dry-run')) {
            $this->info("DRY RUN: Would generate links for {$tools->count()} tools");
            return Command::SUCCESS;
        }

        $this->info("Building internal links for {$tools->count()} tools...");
        $bar = $this->output->createProgressBar($tools->count());
        $bar->start();

        $linked = 0;

        foreach ($tools as $tool) {
            $relatedTools = $linker->findRelatedTools($tool->tool_slug, $tools);

            foreach ($relatedTools->take(5) as $related) {
                $anchors = $linker->generateAnchors($tool->tool_slug, $related->tool_slug);

                DB::table('internal_links')->updateOrInsert(
                    [
                        'source_tool_slug' => $tool->tool_slug,
                        'target_tool_slug' => $related->tool_slug,
                    ],
                    [
                        'anchor_text_primary'    => $anchors[0],
                        'anchor_text_variations' => json_encode($anchors),
                        'relevance_score'        => $related->score,
                        'placement_zone'         => 'related_section',
                        'is_active'              => 1,
                        'auto_generated'         => 1,
                        'human_reviewed'         => 0,
                        'last_refreshed_at'      => now(),
                        'created_at'             => now(),
                        'updated_at'             => now(),
                    ]
                );
                $linked++;
            }

            $bar->advance();
            usleep(100000); // 100ms delay
        }

        $bar->finish();
        $this->newLine();
        $this->info("✅ Created/updated {$linked} internal link relationships");
        return Command::SUCCESS;
    }
}
