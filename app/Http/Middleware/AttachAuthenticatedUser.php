<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\View\Factory as View;

/**
 * Class AttachAuthenticatedUser
 * @package App\Http\Middleware
 */
class AttachAuthenticatedUser
{
    /**
     * @var View
     */
    private $view;

    /**
     * @var Guard
     */
    private $auth;

    /**
     * @param View  $view
     * @param Guard $auth
     */
    public function __construct(View $view, Guard $auth)
    {
        $this->view = $view;
        $this->auth = $auth;
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
        $this->view->share('authUser', $this->auth->user());

        return $next($request);
    }

}
