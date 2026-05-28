<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ToolAnalytics extends Model
{
    protected $fillable = ['tool_slug', 'view_count'];
}
