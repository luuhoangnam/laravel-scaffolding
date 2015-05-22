<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class ThemeServiceProvider
 * @package App\Providers
 */
class ThemeServiceProvider extends ServiceProvider
{
    protected $defer = true;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $theme = $this->app['config']['settings']['theme']['active'];

        if ( ! $theme)
            return;

        $this->app->make('view')->addLocation(realpath(base_path("resources/themes/{$theme}")));
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
