<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Cache;

/**
 * HOTFIX-1.0: Health check command to validate all SEO automation dependencies
 * before running any generation commands.
 *
 * Usage: php artisan seo:health-check
 */
class SeoHealthCheckCommand extends Command
{
    protected $signature = 'seo:health-check';
    protected $description = 'Validate all SEO automation dependencies (DB, API keys, tables, queue)';

    public function handle(): int
    {
        $this->info('');
        $this->info('╔══════════════════════════════════════════╗');
        $this->info('║     SEO Automation Health Check          ║');
        $this->info('╚══════════════════════════════════════════╝');
        $this->newLine();

        $allPassed = true;

        $checks = [
            'OpenAI API Key'          => !empty(config('services.openai.api_key')),
            'Database Connected'      => $this->checkDatabase(),
            'content_drafts table'    => Schema::hasTable('content_drafts'),
            'semantic_keywords table' => Schema::hasTable('semantic_keywords'),
            'internal_links table'    => Schema::hasTable('internal_links'),
            'topical_clusters table'  => Schema::hasTable('topical_clusters'),
            'tool_cluster_map table'  => Schema::hasTable('tool_cluster_map'),
            'seo_audit_log table'     => Schema::hasTable('seo_audit_log'),
        ];

        foreach ($checks as $name => $passed) {
            if ($passed) {
                $this->line("  <fg=green>✅</> {$name}");
            } else {
                $this->line("  <fg=red>❌</> {$name} — <fg=red>FAILED</>");
                $allPassed = false;
            }
        }

        $this->newLine();

        // Show stats
        $this->info('─── Pipeline Statistics ───');
        $this->newLine();

        if (Schema::hasTable('content_drafts')) {
            $draftStats = DB::table('content_drafts')
                ->selectRaw("status, COUNT(*) as count")
                ->groupBy('status')
                ->pluck('count', 'status')
                ->toArray();

            $this->line("  Content Drafts:");
            foreach ($draftStats as $status => $count) {
                $this->line("    {$status}: {$count}");
            }
            if (empty($draftStats)) {
                $this->line("    <fg=yellow>(empty — no drafts generated yet)</>");
            }

            // Check for duplicates
            $duplicates = DB::table('content_drafts')
                ->selectRaw('tool_slug, COUNT(*) as count')
                ->groupBy('tool_slug')
                ->havingRaw('COUNT(*) > 1')
                ->count();
            
            if ($duplicates > 0) {
                $this->line("  <fg=red>⚠ Duplicate tool_slugs found: {$duplicates}</>");
                $allPassed = false;
            } else {
                $this->line("  <fg=green>✅</> No duplicate content_drafts");
            }
        }

        if (Schema::hasTable('semantic_keywords')) {
            $kwCount = DB::table('semantic_keywords')->where('is_active', true)->count();
            $kwTools = DB::table('semantic_keywords')->where('is_active', true)->distinct('tool_slug')->count('tool_slug');
            $this->line("  Semantic Keywords: {$kwCount} keywords across {$kwTools} tools");
        }

        if (Schema::hasTable('internal_links')) {
            $linkCount = DB::table('internal_links')->where('is_active', true)->count();
            $this->line("  Internal Links: {$linkCount} active links");
        }

        if (Schema::hasTable('topical_clusters')) {
            $clusterCount = DB::table('topical_clusters')->count();
            $mappingCount = DB::table('tool_cluster_map')->count();
            $this->line("  Topical Clusters: {$clusterCount} clusters, {$mappingCount} tool mappings");
        }

        $this->newLine();

        // Tool config check
        $allTools = array_merge(config('tools.tools', []), config('pro_calculators', []));
        $this->line("  Total tools in config: " . count($allTools));

        // Last run
        $lastRun = Cache::get('seo:last_content_generation_run', 'Never');
        $this->line("  Last content generation run: {$lastRun}");

        $this->newLine();

        if ($allPassed) {
            $this->info('✅ All checks passed. System is ready for SEO automation.');
        } else {
            $this->error('❌ Some checks failed. Fix the issues above before running SEO commands.');
        }

        return $allPassed ? Command::SUCCESS : Command::FAILURE;
    }

    private function checkDatabase(): bool
    {
        try {
            DB::connection()->getPdo();
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
