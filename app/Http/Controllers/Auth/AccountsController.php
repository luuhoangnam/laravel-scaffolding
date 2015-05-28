<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Class AccountsController
 *
 * @author  Nam Hoang Luu <nam@mbearvn.com>
 * @package App\Http\Controllers\Auth
 *
 */
class AccountsController extends Controller
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
        $this->middleware('guest');
        $this->auth = $auth;
    }

    /**
     * @return View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $user = User::create([
            'name'     => $request->get('name'),
            'email'    => $request->get('email'),
            'password' => bcrypt($request->get('password')),
        ]);

        $this->auth->login($user);

        return redirect(route('/'));
    }
}
