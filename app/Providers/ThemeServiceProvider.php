<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class ThemeServiceProvider
 * @package App\Providers
 */
class ThemeServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $settings = $this->app['config']['settings'];

        if ( ! isset($settings['theme']))
            return;

        if ( ! isset($settings['theme']['active']))
            return;

        $theme = $settings['theme']['active'];

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
