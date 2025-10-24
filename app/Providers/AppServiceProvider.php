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

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Share unread messages count with admin sidebar
        \Illuminate\Support\Facades\View::composer(
            'components.layouts.admin',
            \App\View\Composers\AdminSidebarComposer::class
        );

        // Share site settings with public layout (footer, header)
        \Illuminate\Support\Facades\View::composer(
            'layouts.app',
            \App\View\Composers\FooterComposer::class
        );
    }
}
