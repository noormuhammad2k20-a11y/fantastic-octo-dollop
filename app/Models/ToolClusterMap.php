<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Tool ↔ Cluster Map — Pivot linking tool slugs to topical clusters.
 *
 * Uses tool_slug (not numeric ID) because tools are config-driven.
 */
class ToolClusterMap extends Model
{
    protected $table = 'tool_cluster_map';

    protected $fillable = [
        'tool_slug',
        'cluster_id',
        'relevance_score',
        'is_primary',
    ];

    protected $casts = [
        'relevance_score' => 'decimal:2',
        'is_primary'      => 'boolean',
    ];

    // ─── Relationships ───────────────────────────────────────────

    /**
     * The cluster this mapping belongs to.
     */
    public function cluster(): BelongsTo
    {
        return $this->belongsTo(TopicalCluster::class, 'cluster_id');
    }

    // ─── Helpers ─────────────────────────────────────────────────

    /**
     * Get the tool config array from the slug.
     */
    public function getToolConfigAttribute(): ?array
    {
        $tools = config('tools.tools', []);
        $proCalcs = config('pro_calculators', []);
        $all = array_merge($tools, $proCalcs);

        return $all[$this->tool_slug] ?? null;
    }

    // ─── Scopes ──────────────────────────────────────────────────

    /**
     * Only primary cluster assignments.
     */
    public function scopePrimary($query)
    {
        return $query->where('is_primary', true);
    }

    /**
     * High-relevance mappings (score >= threshold).
     */
    public function scopeHighRelevance($query, float $threshold = 0.7)
    {
        return $query->where('relevance_score', '>=', $threshold);
    }
}
