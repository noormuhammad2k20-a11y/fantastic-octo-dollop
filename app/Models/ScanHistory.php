<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScanHistory extends Model
{
    protected $fillable = [
        'scan_type',
        'triggered_by',
        'total_scanned',
        'healthy',
        'broken',
        'slow',
        'ui_only',
        'static_count',
        'duration_seconds',
        'category_filter',
        'started_at',
        'completed_at',
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    /**
     * Get the health rate as a percentage.
     */
    public function getHealthRateAttribute(): float
    {
        if ($this->total_scanned === 0) return 0;
        return round(($this->healthy / $this->total_scanned) * 100, 1);
    }

    /**
     * Get a human-readable duration string.
     */
    public function getDurationHumanAttribute(): string
    {
        $s = $this->duration_seconds;
        if ($s < 60) return "{$s}s";
        $m = floor($s / 60);
        $rem = $s % 60;
        return "{$m}m {$rem}s";
    }
}
