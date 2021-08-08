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
        App::setLocale(setting('app.locale'));
        date_default_timezone_set(setting('app.timezone'));

        Schema::defaultStringLength(191);

        Collection::macro('year', function ($key, $year) {
            return $this->filter(function ($value) use ($key, $year) {
                return $value->{$key}->year === $year;
            });
        });

        Collection::macro('month', function ($key, $month) {
            return $this->filter(function ($value) use ($key, $month) {
                return $value->{$key}->month === $month;
            });
        });
    }
}
