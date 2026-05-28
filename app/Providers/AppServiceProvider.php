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
    }
}
