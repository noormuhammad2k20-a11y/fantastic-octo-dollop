<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * SEO Audit Log — Records findings from automated SEO audits.
 *
 * Each entry represents a single finding (issue or observation) from
 * the DailySEOAuditJob or manual scan, classified by severity.
 */
class SeoAuditLog extends Model
{
    protected $table = 'seo_audit_log';

    protected $fillable = [
        'audit_type',
        'entity_type',
        'entity_slug',
        'findings',
        'severity',
        'is_resolved',
        'resolved_at',
    ];

    protected $casts = [
        'findings'    => 'array',
        'is_resolved' => 'boolean',
        'resolved_at' => 'datetime',
    ];

    // ─── Scopes ──────────────────────────────────────────────────

    /**
     * Filter by severity.
     */
    public function scopeOfSeverity($query, string $severity)
    {
        return $query->where('severity', $severity);
    }

    /**
     * Critical issues only.
     */
    public function scopeCritical($query)
    {
        return $query->where('severity', 'critical');
    }

    /**
     * High + Critical issues.
     */
    public function scopeHighPriority($query)
    {
        return $query->whereIn('severity', ['critical', 'high']);
    }

    /**
     * Unresolved issues only.
     */
    public function scopeUnresolved($query)
    {
        return $query->where('is_resolved', false);
    }

    /**
     * Resolved issues only.
     */
    public function scopeResolved($query)
    {
        return $query->where('is_resolved', true);
    }

    /**
     * Filter by audit type (e.g., 'daily_scan', 'manual_review').
     */
    public function scopeOfType($query, string $type)
    {
        return $query->where('audit_type', $type);
    }

    /**
     * Filter by entity type (e.g., 'tool', 'category', 'page').
     */
    public function scopeForEntityType($query, string $entityType)
    {
        return $query->where('entity_type', $entityType);
    }

    /**
     * Issues from the last N days.
     */
    public function scopeRecent($query, int $days = 7)
    {
        return $query->where('created_at', '>=', now()->subDays($days));
    }

    // ─── Actions ─────────────────────────────────────────────────

    /**
     * Mark this issue as resolved.
     */
    public function markResolved(): bool
    {
        return $this->update([
            'is_resolved' => true,
            'resolved_at' => now(),
        ]);
    }

    // ─── Accessors ───────────────────────────────────────────────

    /**
     * Human-readable severity badge color.
     */
    public function getSeverityColorAttribute(): string
    {
        return match ($this->severity) {
            'critical' => '#DC2626',
            'high'     => '#F97316',
            'medium'   => '#EAB308',
            'low'      => '#3B82F6',
            'info'     => '#6B7280',
            default    => '#6B7280',
        };
    }
}
