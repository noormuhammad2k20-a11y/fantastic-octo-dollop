<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConversionLog extends Model
{
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'tool_slug',
        'original_filename',
        'original_size',
        'processed_size',
        'status',
        'ip_address',
        'user_agent',
        'processing_time_ms',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'original_size' => 'integer',
        'processed_size' => 'integer',
        'processing_time_ms' => 'integer',
    ];
}
