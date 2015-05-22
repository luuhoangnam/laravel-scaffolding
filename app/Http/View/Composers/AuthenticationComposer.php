<?php

namespace App\Http\View\Composers;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\View\View;

/**
 * Class AuthenticationComposer
 *
 * @author  Nam Hoang Luu <nam@mbearvn.com>
 * @package App\View\Composers
 *
 */
class AuthenticationComposer
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
     * @param View $view
     */
    public function compose(View $view)
    {
        $view->with('authUser', $this->auth->user());
    }
}
