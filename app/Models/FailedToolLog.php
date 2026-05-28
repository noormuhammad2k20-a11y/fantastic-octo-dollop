<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FailedToolLog extends Model
{
    protected $fillable = ['tool_slug', 'issue_type', 'input_data'];

    protected $casts = [
        'input_data' => 'array',
    ];
}
