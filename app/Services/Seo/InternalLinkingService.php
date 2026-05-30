<?php

namespace App\Services\Seo;

use App\Models\ToolClusterMap;
use App\Models\SemanticKeyword;
use App\Models\InternalLink;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class InternalLinkingService
{
    /**
     * Generate the semantic internal link graph for all tools.
     * Finds related tools based on shared topical clusters and
     * semantic overlap.
     * 
     * @param int $maxLinksPerTool Maximum outgoing links to generate per tool
     */
    public function generateLinkGraph(int $maxLinksPerTool = 8): void
    {
        // 1. Get all tools that belong to clusters
        $allMappings = ToolClusterMap::with('cluster')->get()->groupBy('tool_slug');
        $allToolSlugs = $allMappings->keys();

        foreach ($allToolSlugs as $sourceSlug) {
            $this->generateLinksForTool($sourceSlug, $allMappings, $maxLinksPerTool);
        }
    }

    /**
     * Generate outgoing links for a specific tool.
     */
    public function generateLinksForTool(string $sourceSlug, $allMappings, int $limit): void
    {
        $sourceMappings = $allMappings->get($sourceSlug);
        if (!$sourceMappings) {
            return;
        }

        $sourceClusterIds = $sourceMappings->pluck('cluster_id')->toArray();
        $targetCandidates = [];

        // 2. Find target candidates sharing the same clusters
        foreach ($allMappings as $targetSlug => $targetMappings) {
            if ($targetSlug === $sourceSlug) {
                continue;
            }

            $targetClusterIds = $targetMappings->pluck('cluster_id')->toArray();
            $sharedClusters = array_intersect($sourceClusterIds, $targetClusterIds);

            if (!empty($sharedClusters)) {
                // Calculate relevance based on number of shared clusters + base score
                $relevance = 0.5 + (count($sharedClusters) * 0.1);
                
                // Bonus if they share a primary cluster
                $sharesPrimary = $sourceMappings->where('is_primary', true)->whereIn('cluster_id', $targetClusterIds)->isNotEmpty();
                if ($sharesPrimary) {
                    $relevance += 0.2;
                }

                $targetCandidates[$targetSlug] = min(1.0, $relevance);
            }
        }

        // Sort candidates by highest relevance
        arsort($targetCandidates);
        $selectedTargets = array_slice($targetCandidates, 0, $limit, true);

        // 3. Generate links with semantic anchor texts
        foreach ($selectedTargets as $targetSlug => $relevanceScore) {
            $this->createOrUpdateLink($sourceSlug, $targetSlug, $relevanceScore);
        }
    }

    /**
     * Create or update the link pair in the database with rich anchor texts.
     */
    private function createOrUpdateLink(string $sourceSlug, string $targetSlug, float $relevance): void
    {
        // Generate anchor texts based on the target tool's semantic keywords
        $anchors = $this->generateAnchorTexts($targetSlug);

        InternalLink::updateOrCreate(
            [
                'source_tool_slug' => $sourceSlug,
                'target_tool_slug' => $targetSlug,
            ],
            [
                'anchor_text_primary' => $anchors['primary'],
                'anchor_text_variations' => $anchors['variations'],
                'relevance_score' => $relevance,
                'placement_zone' => 'related_section',
                'auto_generated' => true,
                'last_refreshed_at' => now(),
            ]
        );
    }

    /**
     * Generate semantically rich anchor text variations for a target tool.
     */
    private function generateAnchorTexts(string $targetSlug): array
    {
        // Fallback generic name based on slug
        $fallbackName = ucwords(str_replace('-', ' ', $targetSlug));

        // Get high-confidence keywords for the target tool
        $keywords = SemanticKeyword::where('tool_slug', $targetSlug)
            ->where('is_active', true)
            ->orderByDesc('confidence_score')
            ->limit(5)
            ->get();

        if ($keywords->isEmpty()) {
            return [
                'primary' => $fallbackName,
                'variations' => [],
            ];
        }

        // Separate by intent if possible
        $transactional = $keywords->where('search_intent', 'transactional')->first();
        $primaryKw = $transactional ? $transactional->keyword : $keywords->first()->keyword;

        $variations = $keywords->pluck('keyword')->reject(function ($kw) use ($primaryKw) {
            return strtolower($kw) === strtolower($primaryKw);
        })->values()->toArray();

        // Add the fallback name as a variation just in case
        if (!in_array(strtolower($fallbackName), array_map('strtolower', $variations)) 
            && strtolower($primaryKw) !== strtolower($fallbackName)) {
            $variations[] = $fallbackName;
        }

        return [
            'primary' => ucwords((string) $primaryKw),
            'variations' => array_map('ucwords', $variations),
        ];
    }
}
