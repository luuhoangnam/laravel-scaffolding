<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Routing\Router;

/**
 * Class CheckPermissions
 * @package App\Http\Middleware
 */
class CheckPermissions
{
    /**
     * @var Guard
     */
    private $auth;

    /**
     * @param Guard $auth
     */
    public function __construct(Guard $auth)
    {
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
        /** @var User $user */
        $user = $this->auth->user();

        $uri    = $request->route()->uri();
        $method = $request->method();

        $rules = array_filter(config('permissions.routes', []), function ($rule) use ($uri, $method) {
            return $rule['uri'] === $uri && in_array($method, explode('|', $rule['method']));
        });

        foreach ($rules as $rule) {

            foreach ($rule['permissions'] as $resource => $permissions) {
                if ( ! $user->can($resource, $permissions))
                    abort(403);
            }

        }

        return $next($request);
    }

}
