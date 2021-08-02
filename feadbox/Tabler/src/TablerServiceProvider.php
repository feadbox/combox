<?php

namespace Feadbox\Tabler;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class TablerServiceProvider extends ServiceProvider
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
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../resources/views' => resource_path('views/vendor/tabler'),
            ], 'tabler:views');
        }

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'tabler');

        Paginator::useBootstrap();
    }
}
