<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ToolHealthCheck;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class MonitorTools extends Command
{
    protected $signature = 'monitor:run 
                            {--limit=0 : Limit number of tools to scan (0 = all)}
                            {--category= : Scan only tools in this category}
                            {--export=none : Export format: csv, json, or none}';

    protected $description = 'Runs the production-grade tool health scan using Playwright.';

    public function handle()
    {
        $this->info('');
        $this->info('══════════════════════════════════════════');
        $this->info('  ToolsHub Monitoring Engine v2.0');
        $this->info('══════════════════════════════════════════');
        $this->info('');

        // ── Step 1: Collect all tools ──
        $this->info('📋 Collecting tools from config...');
        $tools = config('tools.tools') ?? [];
        $proCalculators = config('pro_calculators') ?? [];
        $allTools = array_merge($tools, $proCalculators);

        // Apply category filter
        $category = $this->option('category');
        if ($category) {
            $allTools = array_filter($allTools, function ($config) use ($category) {
                return ($config['category'] ?? '') === $category;
            });
            $this->info("  Filtered to category: {$category}");
        }

        $this->info('  Found ' . count($allTools) . ' tools.');

        // ── Step 2: Build test data ──
        $baseUrl = config('app.url', 'http://localhost/ToolsHub/public');
        $testData = [];
        foreach ($allTools as $slug => $config) {
            $testData[] = [
                'slug' => $slug,
                'url' => $baseUrl . '/' . $slug,
                'type' => $config['type'] ?? 'interactive',
                'category' => $config['category'] ?? 'uncategorized',
            ];
        }

        // Apply limit
        $limit = (int)$this->option('limit');
        if ($limit > 0) {
            $testData = array_slice($testData, 0, $limit);
            $this->info("  Limited to {$limit} tools (test mode).");
        }

        // Write test input
        $inputPath = base_path('tool_monitor/tools_to_test.json');
        file_put_contents($inputPath, json_encode($testData, JSON_PRETTY_PRINT));

        // ── Step 3: Launch Playwright ──
        $this->info('');
        $this->info('🚀 Launching Playwright monitoring engine...');
        $this->info('');

        $process = new \Symfony\Component\Process\Process(
            ['node', 'tool_monitor/monitor.js', $inputPath],
            base_path()
        );
        $process->setTimeout(7200); // 2 hours max for full 1500+ scan
        $process->run(function ($type, $buffer) {
            $this->output->write($buffer);
        });

        if (!$process->isSuccessful()) {
            $this->error('❌ Monitoring engine encountered an error!');
            $this->error($process->getErrorOutput());
            return 1;
        }

        // ── Step 4: Import results ──
        $this->info('');
        $this->info('📥 Importing results into database...');

        $resultsPath = base_path('tool_monitor/results.json');
        if (!file_exists($resultsPath)) {
            $this->error('❌ results.json not found!');
            return 1;
        }

        $results = json_decode(file_get_contents($resultsPath), true);
        $imported = 0;

        foreach ($results as $result) {
            ToolHealthCheck::updateOrCreate(
                ['tool_slug' => $result['tool_slug']],
                [
                    'status' => $result['status'],
                    'response_time_ms' => $result['response_time_ms'],
                    'error_message' => $result['error_message'],
                    'issue_type' => $result['issue_type'],
                    'last_checked_at' => Carbon::parse($result['last_checked_at'])->format('Y-m-d H:i:s'),
                ]
            );
            $imported++;
        }

        $this->info("  ✅ Successfully imported {$imported} tool health records.");

        // ── Step 5: Export Report ──
        $exportFormat = $this->option('export');
        if ($exportFormat !== 'none') {
            $this->exportReport($results, $exportFormat);
        }

        // ── Step 6: Summary ──
        $this->info('');
        $this->info('══════════════════════════════════════════');
        $this->info('  SCAN SUMMARY');
        $this->info('══════════════════════════════════════════');

        $stats = [
            'ok' => 0, 'broken' => 0, 'static' => 0, 'slow' => 0, 'ui_only' => 0,
        ];
        foreach ($results as $r) {
            $stats[$r['status']] = ($stats[$r['status']] ?? 0) + 1;
        }

        $this->info("  Total Scanned: " . count($results));
        $this->info("  ✅ Healthy:    {$stats['ok']}");
        $this->info("  ❌ Broken:     {$stats['broken']}");
        $this->info("  ⚠️  Static:     {$stats['static']}");
        $this->info("  🐢 Slow:       {$stats['slow']}");
        $this->info("  🔲 UI Only:    {$stats['ui_only']}");
        $this->info('');

        return 0;
    }

    private function exportReport(array $results, string $format)
    {
        $timestamp = now()->format('Y-m-d_H-i-s');
        $reportDir = storage_path('app/monitor-reports');
        if (!is_dir($reportDir)) {
            mkdir($reportDir, 0755, true);
        }

        if ($format === 'json') {
            $path = "{$reportDir}/report_{$timestamp}.json";
            file_put_contents($path, json_encode([
                'generated_at' => now()->toISOString(),
                'total' => count($results),
                'results' => $results,
            ], JSON_PRETTY_PRINT));
            $this->info("  📄 JSON report saved: {$path}");
        }

        if ($format === 'csv') {
            $path = "{$reportDir}/report_{$timestamp}.csv";
            $fp = fopen($path, 'w');
            fputcsv($fp, ['Tool Slug', 'Category', 'Status', 'Response Time (ms)', 'Issue Type', 'Error Message', 'Last Checked']);
            foreach ($results as $r) {
                fputcsv($fp, [
                    $r['tool_slug'],
                    $r['category'] ?? '',
                    $r['status'],
                    $r['response_time_ms'],
                    $r['issue_type'] ?? '',
                    $r['error_message'] ?? '',
                    $r['last_checked_at'],
                ]);
            }
            fclose($fp);
            $this->info("  📄 CSV report saved: {$path}");
        }
    }
}
