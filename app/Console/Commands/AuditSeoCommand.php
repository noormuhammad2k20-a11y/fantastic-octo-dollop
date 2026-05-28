<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ToolHealthCheck;
use App\Models\SeoHealthLog;
use App\Services\Seo\SeoScanner;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class AuditSeoCommand extends Command
{
    protected $signature = 'audit:seo {--limit=0} {--category=}';
    protected $description = 'Perform a production-grade SEO and AdSense compliance audit.';

    public function handle()
    {
        $this->info('Starting Comprehensive SEO Audit...');

        $tools = array_merge(config('tools.tools') ?? [], config('pro_calculators') ?? []);
        
        if ($cat = $this->option('category')) {
            $tools = array_filter($tools, fn($t) => ($t['category'] ?? '') === $cat);
        }
        
        if ($limit = (int)$this->option('limit')) {
            $tools = array_slice($tools, 0, $limit, true);
        }

        $total = count($tools);
        $bar = $this->output->createProgressBar($total);
        $bar->start();

        $baseUrl = rtrim(config('app.url'), '/');
        $results = [
            'total_pages' => $total,
            'optimized_pages' => 0,
            'issues_found' => [],
            'fixes_applied' => [],
            'seo_score_avg' => 0,
            'timestamp' => now()->toDateTimeString(),
        ];

        $totalScore = 0;
        $allIssues = [];

        foreach ($tools as $slug => $config) {
            $url = $baseUrl . '/' . $slug;
            
            try {
                $response = Http::timeout(30)->withoutVerifying()->get($url);
                
                if ($response->successful()) {
                    $scanner = new SeoScanner($response->body(), $url);
                    $scanData = $scanner->scan();
                    
                    $totalScore += $scanData['seo_score'];
                    if ($scanData['seo_score'] >= 90) $results['optimized_pages']++;
                    
                    foreach ($scanData['issues'] as $issue) {
                        $allIssues[$issue] = ($allIssues[$issue] ?? 0) + 1;
                    }

                    // Save to DB
                    SeoHealthLog::updateOrCreate(
                        ['tool_slug' => $slug],
                        array_merge($scanData, ['url' => $url, 'checked_at' => now()])
                    );

                    $bar->setMessage("Auditing: {$slug} (Score: {$scanData['seo_score']})");
                } else {
                    $allIssues['page_not_reachable'] = ($allIssues['page_not_reachable'] ?? 0) + 1;
                }
            } catch (\Exception $e) {
                $this->error("\nFailed to audit {$slug}: " . $e->getMessage());
            }

            $bar->advance();
        }

        $bar->finish();
        $this->info("\nAudit Complete!");

        $results['seo_score_avg'] = $total > 0 ? round($totalScore / $total) : 0;
        $results['issues_found'] = $allIssues;

        // Save JSON Report
        Storage::disk('local')->put('seo_audit_report.json', json_encode($results, JSON_PRETTY_PRINT));
        $this->info("Report saved to storage/app/seo_audit_report.json");

        // Summary Table
        $this->table(['Metric', 'Value'], [
            ['Total Pages', $results['total_pages']],
            ['Optimized (90+)', $results['optimized_pages']],
            ['Average SEO Score', $results['seo_score_avg'] . '%'],
        ]);

        return 0;
    }
}
