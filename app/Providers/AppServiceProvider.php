<?php

namespace App\Providers;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (!$this->app->runningInConsole()) {
            if ($locale = setting('app.locale')) {
                App::setLocale($locale);
            }

            if ($timezone = setting('app.timezone')) {
                date_default_timezone_set($timezone);
            }
        }

        Schema::defaultStringLength(191);
    }
}
