<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Config\Repository as Config;
use Illuminate\Contracts\View\Factory as View;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

/**
 * Class ViewContext
 * @package App\Http\Middleware
 */
class ViewContext
{

    /**
     * @var View
     */
    private $view;

    /**
     * @var Config
     */
    private $config;

    /**
     * @param View   $view
     * @param Config $config
     */
    public function __construct(View $view, Config $config)
    {
        $this->view   = $view;
        $this->config = $config;
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
        $this->settings($request);
        $this->bodyClasses($request);

        return $next($request);
    }

    public function settings()
    {
        $this->view->share('settings', new Collection($this->config['settings']));
    }

    /**
     * @param Request $request
     */
    public function bodyClasses(Request $request)
    {
        $classes = [];
        $uri     = $request->route()->uri();

        switch ($uri) {
            case '/':
                $context = 'home';
                break;
            case 'user/{slug}':
                $context = 'user';
                break;
            default:
                $context = 'undefined';
                break;
        }

        $classes[] = "{$context}-page";

        if ($request->get('page') !== null)
            $classes[] = 'paged';

        if ($request->route()->parameter('slug') !== null)
            $classes[] = $context . '-' . $request->route()->parameter('slug');

        $this->view->share('context', $context);
        $this->view->share('bodyClasses', $classes);
    }

}
