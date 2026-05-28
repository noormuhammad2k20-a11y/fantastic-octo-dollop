<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

use Illuminate\Support\Facades\Schedule;
Schedule::command('tools:cleanup')->hourly();

// Auto-scan: full health + SEO scan every 6 hours
Schedule::command('monitor:fast --trigger=scheduler --force')->everySixHours()->withoutOverlapping();

// Auto-scan: re-check broken tools every hour
Schedule::command('monitor:fast --broken-only --trigger=scheduler')->hourly()->withoutOverlapping();

