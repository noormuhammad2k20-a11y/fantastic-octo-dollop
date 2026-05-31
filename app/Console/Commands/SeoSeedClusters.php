<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SeoSeedClusters extends Command
{
    protected $signature = 'seo:seed-clusters {--dry-run}';
    protected $description = 'Create topical clusters and assign tools to them';

    // Core cluster definitions — expand this list as needed
    private array $clusters = [
        [
            'name'     => 'Finance & Investment',
            'category' => 'finance',
            'keywords' => ['roi', 'cagr', 'mortgage', 'loan', 'interest', 'investment',
                          'profit', 'margin', 'dividend', 'stock', 'bond', 'savings',
                          'budget', 'credit', 'debt', 'equity', 'tax', 'salary', 'income'],
        ],
        [
            'name'     => 'Sports & Athletics',
            'category' => 'sports',
            'keywords' => ['era', 'fip', 'ops', 'war', 'whip', 'batting', 'bowling',
                          'basketball', 'football', 'soccer', 'running', 'marathon',
                          'swimming', 'cycling', 'triathlon', 'bench', 'strength', 'vo2'],
        ],
        [
            'name'     => 'Health & Fitness',
            'category' => 'health',
            'keywords' => ['bmi', 'calorie', 'bmr', 'weight', 'blood', 'body', 'protein',
                          'sleep', 'macro', 'tdee', 'keto', 'pregnancy', 'heart', 'bac',
                          'fat', 'lean', 'waist', 'health', 'fitness', 'diabetes'],
        ],
        [
            'name'     => 'Developer Tools',
            'category' => 'developer',
            'keywords' => ['json', 'base64', 'jwt', 'hash', 'regex', 'url', 'html', 'css',
                          'sql', 'yaml', 'xml', 'markdown', 'uuid', 'ip', 'unicode', 'ascii',
                          'encode', 'decode', 'password', 'token', 'sitemap', 'robots'],
        ],
        [
            'name'     => 'Math & Statistics',
            'category' => 'math',
            'keywords' => ['percentage', 'fraction', 'probability', 'matrix', 'prime',
                          'algebra', 'calculus', 'statistics', 'mean', 'median', 'mode',
                          'variance', 'deviation', 'regression', 'log', 'exponent'],
        ],
        [
            'name'     => 'Physics & Engineering',
            'category' => 'physics',
            'keywords' => ['velocity', 'force', 'energy', 'momentum', 'ohm', 'torque',
                          'pressure', 'wavelength', 'acceleration', 'voltage', 'current',
                          'resistance', 'capacitance', 'power', 'gravity'],
        ],
        [
            'name'     => 'Chemistry & Science',
            'category' => 'chemistry',
            'keywords' => ['molar', 'molarity', 'ph', 'chemical', 'titration', 'reaction',
                          'stoichiometry', 'empirical', 'solution', 'boiling'],
        ],
        [
            'name'     => 'Unit Converters',
            'category' => 'converter',
            'keywords' => ['acres', 'hectares', 'feet', 'inches', 'meters', 'miles', 'km',
                          'kg', 'pounds', 'grams', 'liters', 'gallons', 'bytes', 'mb', 'gb'],
        ],
        [
            'name'     => 'Generators & Random Tools',
            'category' => 'generator',
            'keywords' => ['generator', 'random', 'name', 'password', 'uuid', 'lorem',
                          'barcode', 'qr', 'maze', 'sudoku', 'prompt', 'idea', 'picker'],
        ],
        [
            'name'     => 'Text & Writing Tools',
            'category' => 'text',
            'keywords' => ['text', 'word', 'counter', 'case', 'formatter', 'converter',
                          'markdown', 'html', 'diff', 'compare', 'extractor', 'cleaner'],
        ],
    ];

    public function handle(): int
    {
        $isDryRun = $this->option('dry-run');

        $this->info("Seeding topical clusters...");

        // Get all tool slugs
        $allTools = DB::table('tool_health_checks')
            ->where('status', 'ok')
            ->pluck('tool_slug');

        $clustersCreated = 0;
        $assignmentsMade = 0;

        foreach ($this->clusters as $clusterData) {
            if (!$isDryRun) {
                $clusterId = DB::table('topical_clusters')->insertGetId([
                    'cluster_name' => $clusterData['name'],
                    'category_slug' => $clusterData['category'],
                    'description'  => "Tools related to {$clusterData['name']}",
                    'created_at'   => now(),
                    'updated_at'   => now(),
                ]);
            } else {
                $clusterId = 0;
                $this->line("Would create cluster: {$clusterData['name']}");
            }

            $clustersCreated++;
            $toolsInCluster = 0;

            foreach ($allTools as $slug) {
                $parts = explode('-', $slug);
                $matched = false;

                foreach ($clusterData['keywords'] as $keyword) {
                    if (in_array($keyword, $parts) || str_contains($slug, $keyword)) {
                        $matched = true;
                        break;
                    }
                }

                if ($matched) {
                    if (!$isDryRun) {
                        DB::table('tool_cluster_map')->updateOrInsert(
                            ['tool_slug' => $slug, 'cluster_id' => $clusterId],
                            [
                                'is_primary'      => true,
                                'relevance_score' => 80.00,
                                'created_at'      => now(),
                                'updated_at'      => now(),
                            ]
                        );
                    }
                    $toolsInCluster++;
                    $assignmentsMade++;
                }
            }

            $this->line("Cluster: {$clusterData['name']} → {$toolsInCluster} tools");
        }

        if ($isDryRun) {
            $this->info("DRY RUN: Would create {$clustersCreated} clusters, {$assignmentsMade} assignments");
        } else {
            $this->info("✅ Created {$clustersCreated} clusters, {$assignmentsMade} tool assignments");
            Log::channel('seo')->info("Cluster seeding complete: {$clustersCreated} clusters, {$assignmentsMade} assignments");
        }

        return Command::SUCCESS;
    }
}
