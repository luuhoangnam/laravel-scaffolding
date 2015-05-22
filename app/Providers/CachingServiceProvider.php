<?php

namespace App\Providers;

use App\Permission;
use App\Post;
use App\Role;
use App\Setting;
use App\Support\Observers\Cacher;
use App\Tag;
use App\User;
use Illuminate\Support\ServiceProvider;

/**
 * Class CachingServiceProvider
 * @package App\Providers
 */
class CachingServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $models = [
            Permission::class,
            Role::class,
            Setting::class,
            User::class,
        ];

        foreach ($models as $model) {
            forward_static_call([$model, 'observe'], $this->app->make(Cacher::class));
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

    }

}
