<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class ComposerServiceProvider
 * @package App\Providers
 */
class ComposerServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->make('view')->composer('*', 'App\Http\View\Composers\AuthenticationComposer');
        $this->app->make('view')->composer('*', 'App\Http\View\Composers\SettingsComposer');
        $this->app->make('view')->composer('*', 'App\Http\View\Composers\ContextComposer');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // Noop
    }

}
