<?php

/**
 * Centralized SEO Configuration — ToolsHub Enterprise
 *
 * Defines supported locales, P-SEO modifier templates, and
 * Organization entity data for the Semantic Knowledge Graph.
 *
 * Octane-safe: This config is immutable and loaded once per worker.
 */
return [

    /*
    |--------------------------------------------------------------------------
    | Organization Entity (Knowledge Graph Root)
    |--------------------------------------------------------------------------
    */
    'organization' => [
        'name'  => 'Kefy Arsalan',
        'url'   => env('APP_URL', 'https://toolshub.com'),
        'logo'  => '/images/logo.png',
        'type'  => 'Organization',
        'sameAs' => [
            // Add social profiles here for Knowledge Panel eligibility
        ],
    ],

    'site_name' => 'ToolsHub',

    /*
    |--------------------------------------------------------------------------
    | Default OG Image
    |--------------------------------------------------------------------------
    | Used as the fallback Open Graph / Twitter Card image for social sharing.
    | Should be 1200x630px for optimal display across platforms.
    */
    'og_image_default' => '/images/og-default.png',

    /*
    |--------------------------------------------------------------------------
    | Social Media Links (Footer)
    |--------------------------------------------------------------------------
    | Add your social media profile URLs here to enable footer social icons.
    | Keys should match FontAwesome brand icon names (e.g., 'twitter', 'github').
    | Leave empty to hide social links from the footer entirely.
    |
    | Example:
    | 'twitter' => 'https://twitter.com/youraccount',
    | 'github' => 'https://github.com/youraccount',
    | 'linkedin-in' => 'https://linkedin.com/company/youraccount',
    | 'youtube' => 'https://youtube.com/@youraccount',
    */
    'social_links' => [
        // Uncomment and fill in your social media URLs:
        // 'twitter' => 'https://twitter.com/toolshub',
        // 'github' => 'https://github.com/toolshub',
        // 'linkedin-in' => 'https://linkedin.com/company/toolshub',
        // 'youtube' => 'https://youtube.com/@toolshub',
    ],

    /*
    |--------------------------------------------------------------------------
    | Supported Locales (15 locales + x-default)
    |--------------------------------------------------------------------------
    | Each key is the URL prefix. 'en' is the default (no prefix).
    | hreflang values follow BCP-47 (language-Region).
    */
    'locales' => [
        'en'    => ['hreflang' => 'en',    'name' => 'English',              'dir' => 'ltr', 'default' => true],
        'es'    => ['hreflang' => 'es',    'name' => 'Español',              'dir' => 'ltr'],
        'fr'    => ['hreflang' => 'fr',    'name' => 'Français',             'dir' => 'ltr'],
        'de'    => ['hreflang' => 'de',    'name' => 'Deutsch',              'dir' => 'ltr'],
        'pt'    => ['hreflang' => 'pt',    'name' => 'Português',            'dir' => 'ltr'],
        'it'    => ['hreflang' => 'it',    'name' => 'Italiano',             'dir' => 'ltr'],
        'nl'    => ['hreflang' => 'nl',    'name' => 'Nederlands',           'dir' => 'ltr'],
        'ru'    => ['hreflang' => 'ru',    'name' => 'Русский',              'dir' => 'ltr'],
        'ja'    => ['hreflang' => 'ja',    'name' => '日本語',                'dir' => 'ltr'],
        'ko'    => ['hreflang' => 'ko',    'name' => '한국어',                'dir' => 'ltr'],
        'zh'    => ['hreflang' => 'zh',    'name' => '中文',                  'dir' => 'ltr'],
        'ar'    => ['hreflang' => 'ar',    'name' => 'العربية',               'dir' => 'rtl'],
        'hi'    => ['hreflang' => 'hi',    'name' => 'हिन्दी',                'dir' => 'ltr'],
        'tr'    => ['hreflang' => 'tr',    'name' => 'Türkçe',               'dir' => 'ltr'],
        'id'    => ['hreflang' => 'id',    'name' => 'Bahasa Indonesia',     'dir' => 'ltr'],
    ],

    /*
    |--------------------------------------------------------------------------
    | P-SEO Intent Modifiers
    |--------------------------------------------------------------------------
    | Each modifier generates a unique landing page variant per tool.
    | 'pattern' is the suffix appended to the base tool slug.
    | 'title_template' and 'description_template' use {tool_name} placeholder.
    */
    'modifiers' => [
        'free-online' => [
            'pattern'              => '{slug}-free-online',
            'title_template'       => '{tool_name} — Free Online Tool | No Signup',
            'description_template' => 'Use {tool_name} completely free online. No registration, no download required. Professional-grade results in seconds.',
            'h1_template'          => 'Free Online {tool_name}',
        ],
        'for-beginners' => [
            'pattern'              => '{slug}-for-beginners',
            'title_template'       => '{tool_name} for Beginners — Easy Step-by-Step Guide',
            'description_template' => 'New to {tool_name}? Our beginner-friendly interface walks you through every step. Zero technical skills required.',
            'h1_template'          => '{tool_name} for Beginners',
        ],
        'bulk' => [
            'pattern'              => 'bulk-{slug}',
            'title_template'       => 'Bulk {tool_name} — Process Multiple Files at Once',
            'description_template' => 'Process hundreds of files simultaneously with our bulk {tool_name}. Enterprise-grade batch processing with no limits.',
            'h1_template'          => 'Bulk {tool_name}',
        ],
        'high-performance' => [
            'pattern'              => '{slug}-high-performance',
            'title_template'       => 'High-Performance {tool_name} — Ultra-Fast Processing',
            'description_template' => 'Experience the fastest {tool_name} available online. Optimized for speed with sub-second processing times.',
            'h1_template'          => 'High-Performance {tool_name}',
        ],
        'for-mac' => [
            'pattern'              => '{slug}-for-mac',
            'title_template'       => '{tool_name} for Mac — Works on macOS Safari & Chrome',
            'description_template' => 'Use {tool_name} on your Mac without installing any software. Runs natively in Safari, Chrome, and Firefox.',
            'h1_template'          => '{tool_name} for Mac',
        ],
        'for-windows' => [
            'pattern'              => '{slug}-for-windows',
            'title_template'       => '{tool_name} for Windows — No Software Install Needed',
            'description_template' => 'Use {tool_name} on Windows 10/11 directly in your browser. No downloads, no installation, just results.',
            'h1_template'          => '{tool_name} for Windows',
        ],
        'for-mobile' => [
            'pattern'              => '{slug}-for-mobile',
            'title_template'       => '{tool_name} for Mobile — iPhone & Android Compatible',
            'description_template' => 'Run {tool_name} on your phone or tablet. Fully responsive, works on iOS and Android browsers.',
            'h1_template'          => '{tool_name} for Mobile',
        ],
        'api' => [
            'pattern'              => '{slug}-api',
            'title_template'       => '{tool_name} API — Integrate Into Your Workflow',
            'description_template' => 'Programmatically access {tool_name} via our developer-friendly API. REST endpoints, JSON responses, and comprehensive docs.',
            'h1_template'          => '{tool_name} API',
        ],
    ],
];
