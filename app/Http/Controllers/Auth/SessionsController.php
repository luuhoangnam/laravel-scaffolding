<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Class SessionsController
 * @package App\Http\Controllers\Auth
 */
class SessionsController extends Controller
{

    /**
     * The Guard implementation.
     *
     * @var \Illuminate\Contracts\Auth\Guard
     */
    protected $auth;

    /**
     * @param Guard $auth
     */
    public function __construct(Guard $auth)
    {
        $this->middleware('guest', ['except' => 'destroy']);
        $this->auth = $auth;
    }

    /**
     * @return View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        if ($this->auth->attempt($credentials, boolval($request->get('remember', false)))) {
            return redirect()->intended(route('frontend.home'));
        }

        return redirect(route('frontend.home'))
            ->withInput($request->only('email', 'remember'))
            ->withErrors(['email' => 'These credentials do not match our records.']);
    }

    /**
     * @return RedirectResponse
     */
    public function destroy()
    {
        $this->auth->logout();

        return redirect(route('frontend.home'));
    }
}
