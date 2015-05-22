<?php

namespace App\Providers;

use App\Setting;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;

/**
 * Class ConfigServiceProvider
 * @package App\Providers
 */
class ConfigServiceProvider extends ServiceProvider
{
    protected $defer = true;

    /**
     *
     */
    public function boot()
    {
        $settings = $this->app->make('cache.store')->tags('settings')->rememberForever('settings', function () {
            try {
                return Setting::all(['key', 'value'])->lists('value', 'key');
            } catch ( \Exception $e ) {
                return [];
            }
        });

        config(['settings' => $settings]);
    }

    /**
     * Overwrite any vendor / package configuration.
     *
     * This service provider is intended to provide a convenient location for you
     * to overwrite any "vendor" or package configuration that you may want to
     * modify before the application handles the incoming request / command.
     *
     * @return void
     */
    public function register()
    {
        config([
            //
        ]);
    }

}
