<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Contracts\Foundation\Application;

/**
 * Class Theming
 * @package App\Http\Middleware
 */
class Theming
{
    /**
     * @var Repository
     */
    private $app;

    /**
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $this->registerViewFinder();

        return $next($request);
    }

    /**
     * Register the view finder implementation.
     *
     * @return void
     */
    public function registerViewFinder()
    {
        $theme      = $this->app['config']['settings']['activeTheme'];

        if ( ! $theme)
            return;

        $this->app['view']->addLocation(realpath(base_path("resources/themes/{$theme}")));
    }

}
