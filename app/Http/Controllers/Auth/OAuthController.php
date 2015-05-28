<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\User;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Laravel\Socialite\Contracts\Factory as Socialite;
use Laravel\Socialite\SocialiteManager;
use Laravel\Socialite\Two\User as OAuthUser;
use Redirect;

/**
 * Class OAuthController
 * @package App\Http\Controllers\Auth
 */
class OAuthController extends Controller
{

    /**
     * @var array
     */
    protected $providers = ['facebook'];

    /**
     * @var array
     */
    protected $scopes = ['public_profile', 'email'];

    /**
     * @var Socialite|SocialiteManager
     */
    private $socialite;

    /**
     * @var Guard
     */
    private $auth;

    /**
     * @param Socialite|SocialiteManager $socialite
     * @param Guard                      $auth
     */
    public function __construct(Socialite $socialite, Guard $auth)
    {
        $this->socialite = $socialite;
        $this->auth      = $auth;

        $this->middleware('guest');
    }

    /**
     * @param string $provider
     *
     * @return View
     */
    public function login($provider)
    {
        return view('oauth.login', compact('provider'));
    }

    /**
     * @param string $provider
     *
     * @return mixed
     */
    public function redirectToProvider($provider)
    {
        $this->validateProvider($provider);

        return $this->socialite->with('facebook')->scopes($this->scopes)->redirect();
    }

    /**
     * @param string $provider
     *
     * @return RedirectResponse
     */
    public function handleProviderCallback($provider)
    {
        $this->validateProvider($provider);

        /** @var OAuthUser $oauthUser */
        $oauthUser = $this->socialite->with($provider)->user();

        if (($user = User::findByEmail($oauthUser->getEmail()))) {

        } else if ( ! ($user = User::findByFacebookId($oauthUser->getId()))) {
            $user = new User;
        }

        $user->facebook_id = $oauthUser->getId();

        if ( ! $user->name)
            $user->name = $oauthUser->getName();

        if ( ! $user->email)
            $user->email = $oauthUser->getEmail();

        $user->facebook_access_token = $oauthUser->token;

        if ( ! $user->role_id)
            $user->role_id = setting('registration')['role'];

        $user->save();

        // Sign user in
        $this->auth->login($user, true);

        return Redirect::intended('/');
    }

    /**
     * @param string $provider
     */
    private function validateProvider($provider)
    {
        if ( ! in_array($provider, $this->providers))
            abort(404);
    }

}
