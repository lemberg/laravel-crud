<?php

namespace Lemberg\CRUD\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class CRUDServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'crud');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
//
    }
}
