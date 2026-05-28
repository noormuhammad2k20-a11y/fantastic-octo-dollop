<?php

return [
    /*
    |--------------------------------------------------------------------------
    | AdSense Toggle
    |--------------------------------------------------------------------------
    |
    | Set this to true when you are ready to display real advertisements.
    | Set this to false for a clean UI during initial auditing and development.
    |
    */
    'enabled' => env('ADS_ENABLED', false),

    /*
    |--------------------------------------------------------------------------
    | Ad Slots Configuration
    |--------------------------------------------------------------------------
    |
    | Custom settings for specific ad locations if needed in the future.
    |
    */
    'slots' => [
        'top_banner'    => ['width' => 728, 'height' => 90],
        'bottom_banner' => ['width' => 728, 'height' => 90],
        'sidebar'       => ['width' => 300, 'height' => 250],
    ],

    /*
    |--------------------------------------------------------------------------
    | Extension Configuration
    |--------------------------------------------------------------------------
    */
    'extension' => [
        'published' => env('CHROME_EXTENSION_PUBLISHED', false),
        'chrome_web_store_url' => env('CHROME_EXTENSION_URL', 'https://chromewebstore.google.com/detail/toolshub/YOUR_ID'),
        'cta_engagement_threshold' => 3,
        'cta_cooldown_days' => 7,
    ],
];
