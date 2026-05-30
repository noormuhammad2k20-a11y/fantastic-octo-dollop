<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Topical Cluster — Represents a semantic grouping of related tools.
 *
 * Each cluster can have a parent (for silo depth) and links to a
 * pillar tool (the authoritative page for the topic).
 */
class TopicalCluster extends Model
{
    protected $fillable = [
        'cluster_name',
        'parent_cluster_id',
        'category_slug',
        'description',
        'pillar_tool_slug',
        'silo_depth',
        'language',
        'locale_data',
    ];

    protected $casts = [
        'locale_data' => 'array',
        'silo_depth'  => 'integer',
    ];

    // ─── Relationships ───────────────────────────────────────────

    /**
     * Parent cluster (for hierarchical silo structure).
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(TopicalCluster::class, 'parent_cluster_id');
    }

    /**
     * Child clusters.
     */
    public function children(): HasMany
    {
        return $this->hasMany(TopicalCluster::class, 'parent_cluster_id');
    }

    /**
     * Tools in this cluster via pivot.
     */
    public function toolMappings(): HasMany
    {
        return $this->hasMany(ToolClusterMap::class, 'cluster_id');
    }

    // ─── Scopes ──────────────────────────────────────────────────

    /**
     * Get top-level clusters only.
     */
    public function scopeRoots($query)
    {
        return $query->whereNull('parent_cluster_id');
    }

    /**
     * Filter by language.
     */
    public function scopeForLanguage($query, string $language = 'en')
    {
        return $query->where('language', $language);
    }
}
