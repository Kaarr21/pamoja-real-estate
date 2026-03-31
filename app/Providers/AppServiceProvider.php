<?php

namespace App\Providers;

use App\Models\WebsiteSetting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
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
        // Share website settings with all views
        View::composer('*', function ($view) {
            $settings = null;
            
            // Check if table exists to prevent errors during initial migration
            if (Schema::hasTable('website_settings')) {
                $settings = WebsiteSetting::current();
            }
            
            $view->with('settings', $settings);
        });
    }
}
