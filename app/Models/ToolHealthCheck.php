<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ToolHealthCheck extends Model
{
    protected $fillable = [
        'tool_slug',
        'status',
        'response_time_ms',
        'error_message',
        'issue_type',
        'screenshot_path',
        'last_checked_at',
    ];

    public function getSuggestedFixAttribute()
    {
        if ($this->status === 'ok') return null;

        return match ($this->issue_type) {
            'js_error' => 'Review the JavaScript logic in the partials/tools/scripts. Look for "' . Str::limit($this->error_message, 50) . '".',
            'empty_output' => 'Verify if the processor class is correctly returning a result. check app/Services/Processors/',
            'slow_response' => 'Optimization required. Check for heavy loops or external API timeouts.',
            'timeout_or_crash' => 'Server resources might be low or the tool is hitting a PHP execution limit.',
            'no_ui_response' => 'The action button is present but clicking it yields no result. check event listeners.',
            default => 'Manual audit required.'
        };
    }
}
