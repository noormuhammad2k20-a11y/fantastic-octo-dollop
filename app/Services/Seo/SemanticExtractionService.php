<?php

namespace App\Services\Seo;

use App\Models\SemanticKeyword;
use App\Models\TopicalCluster;
use App\Models\ToolClusterMap;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class SemanticExtractionService
{
    private string $baseUrl;
    private string $secret;

    public function __construct()
    {
        $this->baseUrl = env('EXTRACTOR_URL', 'http://127.0.0.1:8100');
        $this->secret = env('EXTRACTOR_SECRET', 'dev-secret-change-in-production');
    }

    /**
     * Call the Python microservice to extract semantics for a given tool.
     * 
     * @param string $toolSlug
     * @param array $toolConfig The tool's configuration array
     * @param int $maxResults Maximum number of keywords to fetch
     * @return array|null The parsed JSON response or null on failure
     */
    public function extractFromService(string $toolSlug, array $toolConfig, int $maxResults = 50): ?array
    {
        try {
            $response = Http::timeout(120)->post("{$this->baseUrl}/extract", [
                'tool_slug' => $toolSlug,
                'tool_name' => $toolConfig['name'] ?? Str::title(str_replace('-', ' ', $toolSlug)),
                'tool_h1' => $toolConfig['seo_h1'] ?? '',
                'tool_description' => $toolConfig['description'] ?? '',
                'tool_category' => $toolConfig['category'] ?? '',
                'language' => 'en', // Default for now
                'max_results' => $maxResults,
            ]);

            if ($response->successful()) {
                return $response->json();
            }

            Log::error("Semantic Extractor failed for {$toolSlug}: HTTP {$response->status()} - {$response->body()}");
            return null;

        } catch (\Exception $e) {
            Log::error("Semantic Extractor connection error for {$toolSlug}: " . $e->getMessage());
            return null;
        }
    }

    /**
     * Process and persist the extraction response into the database.
     * 
     * @param string $toolSlug
     * @param array $payload The JSON payload from the microservice
     * @return bool True on success
     */
    public function persistExtraction(string $toolSlug, array $payload): bool
    {
        if (!isset($payload['status']) || $payload['status'] !== 'success') {
            return false;
        }

        try {
            // 1. Persist Semantic Keywords
            $this->persistKeywords($toolSlug, $payload['keywords'] ?? [], $payload['entities'] ?? []);

            // 2. Persist Topical Clusters
            $this->persistClusters($toolSlug, $payload['clusters'] ?? []);

            return true;
        } catch (\Exception $e) {
            Log::error("Failed to persist semantic extraction for {$toolSlug}: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Save extracted keywords and entities.
     */
    private function persistKeywords(string $toolSlug, array $keywords, array $entities): void
    {
        // Deactivate old keywords to keep historical data but flag them as inactive
        SemanticKeyword::forTool($toolSlug)->update(['is_active' => false]);

        $now = now();
        $insertData = [];

        $allTerms = array_merge($entities, $keywords);

        foreach ($allTerms as $term) {
            $insertData[] = [
                'tool_slug' => $toolSlug,
                'keyword' => Str::limit($term['keyword'] ?? '', 500),
                'keyword_type' => $term['keyword_type'] ?? 'semantic',
                'search_intent' => $term['search_intent'] ?? 'informational',
                'source' => $term['source'] ?? 'unknown',
                'confidence_score' => $term['confidence_score'] ?? 0.5,
                'is_active' => true,
                'language' => $term['language'] ?? 'en',
                'locale_data' => json_encode($term['meta'] ?? []),
                'extracted_at' => $now,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        if (!empty($insertData)) {
            // Chunk inserts to handle large amounts of keywords
            foreach (array_chunk($insertData, 500) as $chunk) {
                SemanticKeyword::insert($chunk);
            }
        }
    }

    /**
     * Save cluster definitions and mappings.
     */
    private function persistClusters(string $toolSlug, array $clusters): void
    {
        // Remove existing primary cluster mappings for this tool
        ToolClusterMap::where('tool_slug', $toolSlug)->where('is_primary', true)->delete();

        foreach ($clusters as $clusterName => $keywords) {
            // Find or create the topical cluster
            $cluster = TopicalCluster::firstOrCreate(
                ['cluster_name' => $clusterName],
                [
                    'language' => 'en',
                    'silo_depth' => 1,
                    // If it's a new cluster, this tool becomes the pillar tool by default
                    // until we build out the full pillar page strategy
                    'pillar_tool_slug' => $toolSlug,
                ]
            );

            // Map the tool to this cluster
            ToolClusterMap::updateOrCreate(
                ['tool_slug' => $toolSlug, 'cluster_id' => $cluster->id],
                [
                    'relevance_score' => $this->calculateRelevance($keywords),
                    'is_primary' => true, // Assuming LLM groups represent primary intent
                ]
            );
        }
    }

    /**
     * Calculate a basic relevance score based on keyword confidence.
     */
    private function calculateRelevance(array $keywords): float
    {
        if (empty($keywords)) {
            return 0.5;
        }

        $sum = 0;
        foreach ($keywords as $kw) {
            $sum += $kw['confidence_score'] ?? 0.5;
        }
        
        $avg = $sum / count($keywords);
        return round(min(1.0, max(0.1, $avg)), 2);
    }
}
