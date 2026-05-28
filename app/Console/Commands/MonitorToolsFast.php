<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ToolHealthCheck;
use App\Models\SeoHealthLog;
use App\Models\ScanHistory;
use App\Services\Seo\SeoScanner;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class MonitorToolsFast extends Command
{
    protected $signature = 'monitor:fast 
                            {--limit=0 : Limit number of tools to scan (0 = all)}
                            {--category= : Scan only a specific category}
                            {--slug= : Scan a specific tool slug}
                            {--concurrency=10 : Number of concurrent HTTP requests}
                            {--broken-only : Only rescan tools with status=broken}
                            {--force : Rescan even recently-scanned tools (< 1 hour)}
                            {--dry-run : Check tools but do not write to database}
                            {--timeout=15 : HTTP timeout in seconds per request}
                            {--trigger=cli : Who triggered the scan (cli, dashboard, scheduler)}';

    protected $description = 'Ultra-fast HTTP-based tool health scan. Scans 1500+ tools in minutes with configurable concurrency.';

    private array $healthBuffer = [];
    private array $seoBuffer = [];
    private int $batchFlushSize = 50;

    public function handle()
    {
        $startTime = microtime(true);
        $startedAt = now();

        $this->info('');
        $this->info('══════════════════════════════════════════════');
        $this->info('  ToolsHub Ultra-Fast Scanner v3.0 (PHP HTTP)');
        $this->info('══════════════════════════════════════════════');

        $concurrency = max(1, (int) $this->option('concurrency'));
        $timeout = max(5, (int) $this->option('timeout'));
        $isDryRun = $this->option('dry-run');
        $brokenOnly = $this->option('broken-only');
        $force = $this->option('force');
        $trigger = $this->option('trigger');

        // Collect all tools
        $tools = config('tools.tools') ?? [];
        $proCalculators = config('pro_calculators') ?? [];
        $allTools = array_merge($tools, $proCalculators);

        // Category filter
        $category = $this->option('category');
        if ($category) {
            $allTools = array_filter($allTools, fn($c, $k) => ($c['category'] ?? '') === $category, ARRAY_FILTER_USE_BOTH);
            $this->info("  Category filter: {$category}");
        }

        // Slug filter
        $slugOption = $this->option('slug');
        if ($slugOption) {
            $allTools = array_filter($allTools, fn($c, $k) => $k === $slugOption, ARRAY_FILTER_USE_BOTH);
        }

        // Broken-only filter
        if ($brokenOnly) {
            $brokenSlugs = ToolHealthCheck::where('status', 'broken')->pluck('tool_slug')->toArray();
            $allTools = array_filter($allTools, fn($c, $k) => in_array($k, $brokenSlugs), ARRAY_FILTER_USE_BOTH);
            $this->info("  Broken-only filter: " . count($allTools) . " broken tools");
        }

        // Force filter — skip recently scanned unless --force
        if (!$force && !$brokenOnly && !$slugOption) {
            $recentlySlugs = ToolHealthCheck::where('last_checked_at', '>=', now()->subHour())
                ->pluck('tool_slug')
                ->toArray();
            $beforeCount = count($allTools);
            $allTools = array_filter($allTools, fn($c, $k) => !in_array($k, $recentlySlugs), ARRAY_FILTER_USE_BOTH);
            $skipped = $beforeCount - count($allTools);
            if ($skipped > 0) {
                $this->info("  Skipped {$skipped} recently-scanned tools (use --force to override)");
            }
        }

        $limit = (int) $this->option('limit');
        if ($limit > 0) {
            $allTools = array_slice($allTools, 0, $limit, true);
        }

        $total = count($allTools);
        if ($total === 0) {
            $this->info('  No tools to scan. All tools are up-to-date.');
            return 0;
        }

        $scanType = $brokenOnly ? 'broken_only' : ($category ? 'category' : ($limit > 0 && $limit <= 100 ? 'quick' : 'full'));

        $this->info("  Scanning {$total} tools (concurrency: {$concurrency}, timeout: {$timeout}s)");
        if ($isDryRun) $this->warn('  ⚠️  DRY RUN — no database writes');
        $this->info('');

        $baseUrl = rtrim(config('app.url', 'http://localhost/ToolsHub/public'), '/');

        // Progress file for dashboard
        $progressPath = base_path('tool_monitor/scan_progress.json');
        if (!is_dir(dirname($progressPath))) mkdir(dirname($progressPath), 0755, true);
        $progress = [
            'status' => 'running',
            'total' => $total,
            'scanned' => 0,
            'healthy' => 0,
            'broken' => 0,
            'static' => 0,
            'slow' => 0,
            'ui_only' => 0,
            'current_batch' => 0,
            'total_batches' => ceil($total / $concurrency),
            'started_at' => $startedAt->toISOString(),
            'concurrency' => $concurrency,
        ];
        file_put_contents($progressPath, json_encode($progress));

        $bar = $this->output->createProgressBar($total);
        $bar->setFormat(' %current%/%max% [%bar%] %percent:3s%% — %message%');
        $bar->setMessage('Starting...');
        $bar->start();

        $scanned = 0;
        $batchNum = 0;
        $toolKeys = array_keys($allTools);

        // Process in concurrent batches
        foreach (array_chunk($toolKeys, $concurrency) as $batchSlugs) {
            $batchNum++;
            $progress['current_batch'] = $batchNum;

            $latencies = [];
            $responses = Http::pool(function (\Illuminate\Http\Client\Pool $pool) use ($batchSlugs, $baseUrl, &$latencies, $timeout) {
                foreach ($batchSlugs as $slug) {
                    $pool->as($slug)->timeout($timeout)->connectTimeout(5)->withoutVerifying()->withOptions([
                        'on_stats' => function (\GuzzleHttp\TransferStats $stats) use (&$latencies, $slug) {
                            $latencies[$slug] = round($stats->getTransferTime() * 1000);
                        }
                    ])->get($baseUrl . '/' . $slug);
                }
            });

            $healthBatch = [];
            $seoBatch = [];

            foreach ($batchSlugs as $slug) {
                $response = $responses[$slug] ?? null;
                $responseTime = $latencies[$slug] ?? 0;

                $status = 'ok';
                $errorMessage = null;
                $issueType = null;
                $body = null;

                if ($response instanceof \Illuminate\Http\Client\Response) {
                    $httpCode = $response->status();
                    $body = $response->body();
                    $bodyLength = strlen($body);

                    // Check HTTP errors
                    if ($httpCode >= 500) {
                        $status = 'broken';
                        $issueType = 'server_error';
                        $errorMessage = "HTTP {$httpCode}";
                    } elseif ($httpCode >= 400) {
                        $status = 'broken';
                        $issueType = 'http_error';
                        $errorMessage = "HTTP {$httpCode}";
                    }
                    // Check for empty/tiny response
                    elseif ($bodyLength < 500) {
                        $status = 'broken';
                        $issueType = 'empty_page';
                        $errorMessage = "Page body too small ({$bodyLength} bytes)";
                    }
                    // Check for error pages in content
                    elseif (
                        str_contains($body, 'ErrorException') ||
                        str_contains($body, 'Whoops!') ||
                        str_contains($body, 'SQLSTATE') ||
                        str_contains($body, 'Class &quot;') ||
                        (str_contains($body, 'not found') && str_contains($body, 'Exception'))
                    ) {
                        $status = 'broken';
                        $issueType = 'php_error';
                        if (preg_match('/ErrorException.*?<\/h2>/s', $body, $m)) {
                            $errorMessage = strip_tags($m[0]);
                        } else {
                            $errorMessage = 'PHP error detected in response';
                        }
                    }
                    // Check for slow response
                    elseif ($responseTime > 5000) {
                        $status = 'slow';
                        $issueType = 'slow_response';
                    }

                    // Check if tool has interactive elements
                    $hasInteraction = (
                        str_contains($body, 'addEventListener') ||
                        str_contains($body, 'onclick=') ||
                        str_contains($body, 'data-action') ||
                        str_contains($body, 'type="number"') ||
                        str_contains($body, 'type="text"') ||
                        str_contains($body, '<form') ||
                        str_contains($body, 'type="submit"') ||
                        str_contains($body, 'calculateResult') ||
                        str_contains($body, 'id="calculate"') ||
                        str_contains($body, 'id="convert"') ||
                        str_contains($body, 'btn-primary')
                    );

                    if ($status === 'ok' && !$hasInteraction) {
                        $status = 'ui_only';
                        $issueType = 'no_interactive_elements';
                    }
                } else {
                    $status = 'broken';
                    $issueType = 'connection_error';
                    $errorMessage = 'Connection timeout or request failed';
                }

                // Buffer health record
                $healthBatch[] = [
                    'tool_slug' => $slug,
                    'status' => $status,
                    'response_time_ms' => $responseTime,
                    'error_message' => $errorMessage,
                    'issue_type' => $issueType,
                    'last_checked_at' => now()->format('Y-m-d H:i:s'),
                    'updated_at' => now()->format('Y-m-d H:i:s'),
                ];

                // SEO scan (only if tool is not broken)
                if ($status !== 'broken' && $body) {
                    $url = $baseUrl . '/' . $slug;
                    $seoScanner = new SeoScanner($body, $url);
                    $seoResults = $seoScanner->scan();

                    // Calculate Speed Metrics (Estimated)
                    $fcp = round($responseTime * 0.4 / 1000, 2);
                    $lcp = round($responseTime * 0.8 / 1000, 2);
                    $tbt = $responseTime > 3000 ? round(($responseTime - 3000), 2) : 0;

                    $speedScore = 100;
                    if ($responseTime > 3000) $speedScore = 40;
                    elseif ($responseTime > 1000) $speedScore = 70;

                    $seoBatch[] = array_merge($seoResults, [
                        'tool_slug' => $slug,
                        'url' => $url,
                        'page_speed_score' => $speedScore,
                        'fcp' => $fcp,
                        'lcp' => $lcp,
                        'tbt' => $tbt,
                        'checked_at' => now()->format('Y-m-d H:i:s'),
                        'updated_at' => now()->format('Y-m-d H:i:s'),
                    ]);
                }

                // Update counters
                $scanned++;
                $progress['scanned'] = $scanned;
                if ($status === 'ok') $progress['healthy']++;
                elseif ($status === 'broken') $progress['broken']++;
                elseif ($status === 'static') $progress['static']++;
                elseif ($status === 'slow') $progress['slow']++;
                elseif ($status === 'ui_only') $progress['ui_only']++;

                $icon = match ($status) {
                    'ok' => '✅', 'broken' => '❌', 'slow' => '🐢', 'static' => '⚠️', default => '🔲'
                };
                $bar->setMessage("{$icon} {$slug}");
                $bar->advance();
            }

            // Flush health batch via upsert (single query instead of N queries)
            if (!$isDryRun && !empty($healthBatch)) {
                DB::table('tool_health_checks')->upsert(
                    $healthBatch,
                    ['tool_slug'],
                    ['status', 'response_time_ms', 'error_message', 'issue_type', 'last_checked_at', 'updated_at']
                );
            }

            // Flush SEO batch via upsert
            if (!$isDryRun && !empty($seoBatch)) {
                // SEO data has JSON fields — need to encode them
                $seoUpsertData = [];
                foreach ($seoBatch as $seoRow) {
                    $seoUpsertData[] = [
                        'tool_slug' => $seoRow['tool_slug'],
                        'url' => $seoRow['url'],
                        'seo_score' => $seoRow['seo_score'] ?? 0,
                        'index_status' => $seoRow['index_status'] ?? 'indexed',
                        'page_speed_score' => $seoRow['page_speed_score'],
                        'fcp' => $seoRow['fcp'],
                        'lcp' => $seoRow['lcp'],
                        'tbt' => $seoRow['tbt'],
                        'issues' => json_encode($seoRow['issues'] ?? []),
                        'meta_data' => json_encode($seoRow['meta_data'] ?? []),
                        'checked_at' => $seoRow['checked_at'],
                        'updated_at' => $seoRow['updated_at'],
                    ];
                }
                DB::table('seo_health_logs')->upsert(
                    $seoUpsertData,
                    ['tool_slug'],
                    ['url', 'seo_score', 'index_status', 'page_speed_score', 'fcp', 'lcp', 'tbt', 'issues', 'meta_data', 'checked_at', 'updated_at']
                );
            }

            // Update progress file after each concurrent batch
            file_put_contents($progressPath, json_encode($progress));
        }

        $bar->finish();
        $this->info('');

        $durationSeconds = (int) round(microtime(true) - $startTime);

        // Write scan history
        if (!$isDryRun) {
            ScanHistory::create([
                'scan_type' => $scanType,
                'triggered_by' => $trigger,
                'total_scanned' => $scanned,
                'healthy' => $progress['healthy'],
                'broken' => $progress['broken'],
                'slow' => $progress['slow'],
                'ui_only' => $progress['ui_only'],
                'static_count' => $progress['static'],
                'duration_seconds' => $durationSeconds,
                'category_filter' => $category,
                'started_at' => $startedAt,
                'completed_at' => now(),
            ]);
        }

        // Mark complete
        $progress['status'] = 'completed';
        $progress['completed_at'] = now()->toISOString();
        $progress['duration_seconds'] = $durationSeconds;
        file_put_contents($progressPath, json_encode($progress));

        // Summary
        $this->info('');
        $this->info('══════════════════════════════════════════════');
        $this->info('  SCAN COMPLETE');
        $this->info("  ⏱️  Duration:  {$durationSeconds}s");
        $this->info("  ✅ Healthy:   {$progress['healthy']}");
        $this->info("  ❌ Broken:    {$progress['broken']}");
        $this->info("  ⚠️  Static:    {$progress['static']}");
        $this->info("  🐢 Slow:      {$progress['slow']}");
        $this->info("  🔲 UI Only:   {$progress['ui_only']}");
        if ($isDryRun) $this->warn('  ℹ️  DRY RUN — nothing saved');
        $this->info('══════════════════════════════════════════════');

        return 0;
    }
}
