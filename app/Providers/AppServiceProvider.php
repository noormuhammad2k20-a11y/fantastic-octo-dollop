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
        //
    }

    public function boot(): void
    {
        if (config('app.url')) {
            \Illuminate\Support\Facades\URL::forceRootUrl(config('app.url'));
        }
        \Illuminate\Support\Facades\View::composer('layouts.app', \App\View\Composers\FooterComposer::class);

        // HOTFIX-1.0: Warn loudly if OpenAI key is missing in production
        if (app()->environment('production') && empty(config('services.openai.api_key'))) {
            \Illuminate\Support\Facades\Log::critical(
                'OPENAI_API_KEY is not configured. SEO content generation will use mock fallback. Set it in .env'
            );
        }
    }
}
