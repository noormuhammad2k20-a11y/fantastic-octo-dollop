<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'key' => env('POSTMARK_API_KEY'),
    ],

    'resend' => [
        'key' => env('RESEND_API_KEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    // DEPRECATED: OpenAI API configuration (replaced by Gemini)
    // 'openai' => [
    //     'api_key'    => env('OPENAI_API_KEY', ''),
    //     'model'      => env('OPENAI_CONTENT_MODEL', 'gpt-4o'),
    //     'max_tokens' => (int) env('OPENAI_MAX_TOKENS', 2000),
    //     'rpm_limit'  => (int) env('OPENAI_RPM_LIMIT', 20),
    // ],

    // DEPRECATED: OpenRouter API configuration (OpenAI-compatible, used for SEO content generation)
    // 'openrouter' => [
    //     'api_key'    => env('OPENROUTER_API_KEY'),
    //     'model'      => env('OPENROUTER_MODEL', 'anthropic/claude-sonnet-4.6'),
    //     'max_tokens' => (int) env('OPENROUTER_MAX_TOKENS', 6000),
    //     'rpm_limit'  => (int) env('OPENROUTER_RPM_LIMIT', 15),
    //     'endpoint'   => 'https://openrouter.ai/api/v1/chat/completions',
    // ],

    // Gemini API configuration
    'gemini' => [
        'api_key'    => env('GEMINI_API_KEY'),
        'model'      => env('GEMINI_MODEL', 'gemini-3.1-pro'),
        'max_tokens' => (int) env('GEMINI_MAX_TOKENS', 8192),
        'rpm_limit'  => (int) env('GEMINI_RPM_LIMIT', 15),
        'endpoint'   => 'https://generativelanguage.googleapis.com/v1beta/models',
    ],

];
