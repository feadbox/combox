<?php

namespace App\Providers;

use App\Eloquent\Enums\AccountTypeEnum;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('components.layouts.app', function ($view) {
            $view->with('accountTypes', AccountTypeEnum::getAllPluralTitles());
        });
    }
}
