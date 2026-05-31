<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(\App\Services\SEO\GeminiService::class);
        $this->app->singleton(\App\Services\SEO\GeminiContentGenerator::class);
    }

    public function boot(): void
    {
        if (config('app.url')) {
            \Illuminate\Support\Facades\URL::forceRootUrl(config('app.url'));
        }
        \Illuminate\Support\Facades\View::composer('layouts.app', \App\View\Composers\FooterComposer::class);

        // HOTFIX-1.0: Warn loudly if Gemini key is missing in production
        if (app()->environment('production') && empty(config('services.gemini.api_key'))) {
            \Illuminate\Support\Facades\Log::critical(
                'GEMINI_API_KEY is not configured. SEO content generation will use mock fallback. Set it in .env'
            );
        }
    }
}
