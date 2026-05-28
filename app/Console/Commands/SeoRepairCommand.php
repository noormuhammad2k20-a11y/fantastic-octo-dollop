<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\Seo\SeoAutoGenerator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SeoRepairCommand extends Command
{
    protected $signature = 'seo:repair {--limit=0} {--dry-run}';
    protected $description = 'Automatically repair and populate missing SEO metadata for all tools.';

    public function handle()
    {
        $this->info('Starting SEO Repair System...');
        $dryRun = $this->option('dry-run');

        $tools = config('tools.tools') ?? [];
        $proCalculators = config('pro_calculators') ?? [];
        $allTools = array_merge($tools, $proCalculators);

        if ($limit = (int)$this->option('limit')) {
            $allTools = array_slice($allTools, 0, $limit, true);
        }

        $repairedCount = 0;
        $bar = $this->output->createProgressBar(count($allTools));
        $bar->start();

        foreach ($allTools as $slug => $config) {
            $needsRepair = false;
            $tool = $config;
            $tool['slug'] = $slug;

            // Missing Title
            if (empty($tool['title']) || strlen($tool['title']) < 40) {
                $tool['title'] = SeoAutoGenerator::generateTitle($tool);
                $needsRepair = true;
            }

            // Missing Description
            if (empty($tool['description']) || strlen($tool['description']) < 100) {
                $tool['description'] = SeoAutoGenerator::generateDescription($tool);
                $needsRepair = true;
            }

            // Missing FAQ
            if (empty($tool['custom_faq']) && empty($tool['faq'])) {
                $tool['faq'] = SeoAutoGenerator::generateFaq($tool);
                $needsRepair = true;
            }

            // Missing Instructions
            if (empty($tool['instructions'])) {
                $tool['instructions'] = SeoAutoGenerator::generateInstructions($tool);
                $needsRepair = true;
            }

            if ($needsRepair) {
                $repairedCount++;
                if (!$dryRun) {
                    $this->logFix($slug, $tool);
                }
            }

            $bar->advance();
        }

        $bar->finish();
        $this->info("\nRepair Complete!");
        $this->info("Repaired tools: {$repairedCount}");

        if ($dryRun) {
            $this->warn("Dry run complete. No changes were actually saved.");
        } else {
            $this->info("Fixes logged and applied dynamically.");
        }

        return 0;
    }

    protected function logFix($slug, $tool)
    {
        // For now, we log to a special fix log
        $logPath = storage_path('logs/seo_fixes.log');
        $msg = "[" . now() . "] REPAIRED: {$slug} | Title: {$tool['title']} | Desc: " . Str::limit($tool['description'], 50) . "\n";
        file_put_contents($logPath, $msg, FILE_APPEND);
    }
}
