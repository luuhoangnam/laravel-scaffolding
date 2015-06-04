<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class SlugServiceProvider
 * @package App\Providers
 */
class SlugServiceProvider extends ServiceProvider
{
    protected $defer = true;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('slugs', function () {
            return $this->app->make('App\Services\SlugGenerator');
        });
    }

    /**
     *
     */
    public function provides()
    {
        return ['App\Services\SlugGenerator'];
    }

}
