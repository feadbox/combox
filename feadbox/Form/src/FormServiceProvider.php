<?php

namespace Feadbox\Form;

use Feadbox\Form\View\Components\Input;
use Feadbox\Form\View\Components\Label;
use Illuminate\Support\ServiceProvider;

class FormServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/form.php', 'form');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->bootPublishes();

        $this->loadViewsFrom(__DIR__ . '/../resources/views/' . config('form.namespace'), 'form');

        $this->loadViewComponentsAs('form', [
            Label::class,
            Input::class,
        ]);
    }

    private function bootPublishes(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../resources/views' => resource_path('views/vendor/form'),
            ], 'form:views');

            $this->publishes([
                __DIR__ . '/../config/form.php' => config_path('form.php'),
            ], 'form:config');
        }
    }
}
