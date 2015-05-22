<?php

namespace App\Http\View\Composers;

use Illuminate\Contracts\Config\Repository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

/**
 * Class ContextComposer
 *
 * @author  Nam Hoang Luu <nam@mbearvn.com>
 * @package App\View\Composers
 *
 */
class ContextComposer
{
    /**
     * @var Repository
     */
    private $config;

    /**
     * @var Request
     */
    private $request;

    /**
     * @param Repository $config
     * @param Request    $request
     */
    public function __construct(Repository $config, Request $request)
    {
        $this->config  = $config;
        $this->request = $request;
    }

    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $classes = [];
        $route   = $this->request->route();

        if (is_null($route))
            return;

        $uri = $route->uri();

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

        if ($this->request->get('page') !== null)
            $classes[] = 'paged';

        if ($route->parameter('slug') !== null)
            $classes[] = $context . '-' . $route->parameter('slug');

        $view->with('context', $context);
        $view->with('bodyClasses', $classes);
    }
}
