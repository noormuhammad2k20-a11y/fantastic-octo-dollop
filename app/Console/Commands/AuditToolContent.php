<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class AuditToolContent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tools:audit-content';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Audit tool content word counts and generate a report for low-content tools.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting ToolsHub Content Audit...');

        // 1. Gather all tools
        $tools = config('tools.tools', []);
        $proCalculators = config('pro_calculators', []) ?? [];
        $allTools = array_merge($tools, $proCalculators);

        // 2. Load SEO pages
        $seoPages = [];
        $seoPath = storage_path('seo_pages.php');
        if (file_exists($seoPath)) {
            $data = include $seoPath;
            $seoPages = $data['pages'] ?? [];
        }

        $flaggedTools = [];
        $totalTools = count($allTools);
        $bar = $this->output->createProgressBar($totalTools);
        $bar->start();

        foreach ($allTools as $slug => $tool) {
            $content = '';
            
            // Priority 1: Check SEO Pages (most detailed content usually here)
            // Note: In SeoToolController, the slug passed might be an SEO page slug that maps to a tool_slug.
            // But we can also check if a tool_slug exists directly in seo_pages keys or as a tool_slug field.
            
            $seoEntry = $seoPages[$slug] ?? null;
            if ($seoEntry && isset($seoEntry['article'])) {
                $content = $seoEntry['article'];
            } elseif (isset($tool['content'])) {
                // Priority 2: In-config content
                $content = $tool['content'];
            }

            // Strip HTML and count words
            $cleanContent = strip_tags($content);
            $wordCount = str_word_count($cleanContent);

            if ($wordCount < 250) {
                $flaggedTools[] = [
                    'name' => $tool['h1'] ?? $tool['name'] ?? $tool['title'] ?? 'Unknown Tool',
                    'slug' => $slug,
                    'word_count' => $wordCount
                ];
            }

            $bar->advance();
        }

        $bar->finish();
        $this->newLine();

        // 3. Generate Markdown Report
        $reportPath = base_path('low_content_tools.md');
        $reportContent = "# ToolsHub Low Content Audit Report\n";
        $reportContent .= "Generated on: " . now()->toDateTimeString() . "\n\n";
        $reportContent .= "Total Tools Audited: " . $totalTools . "\n";
        $reportContent .= "Flagged Tools (Word Count < 250): " . count($flaggedTools) . "\n\n";
        $reportContent .= "| Tool Name | Slug | Word Count |\n";
        $reportContent .= "| :--- | :--- | :--- |\n";

        foreach ($flaggedTools as $flagged) {
            $reportContent .= "| {$flagged['name']} | `{$flagged['slug']}` | {$flagged['word_count']} |\n";
        }

        file_put_contents($reportPath, $reportContent);

        $this->info("Audit complete! Found " . count($flaggedTools) . " flagged tools.");
        $this->info("Report saved to: " . $reportPath);
    }
}
