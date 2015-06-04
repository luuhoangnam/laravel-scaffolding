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
use ReflectionClass;

/**
 * Class CachingServiceProvider
 * @package App\Providers
 */
class CachingServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @throws \LogicException
     */
    public function boot()
    {
        $tables = config('cache.auto_flush');

        foreach ($tables as $table) {
            $model = "\\App\\" . studly_case(str_singular($table));

            $reflection = new ReflectionClass($model);

            if ($reflection->getParentClass()->getName() != 'Illuminate\Database\Eloquent\Model')
                throw new \LogicException("{$model} must be inherit from Illuminate\\Database\\Eloquent\\Model");

            $model::observe($this->app->make(Cacher::class));
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
