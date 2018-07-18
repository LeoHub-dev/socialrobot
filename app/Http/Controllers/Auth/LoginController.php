<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;

use Auth;
use Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/app/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->setScopes(['read:user', 'public_repo'])->redirect();
    }

    public function handleFacebookCallback()
    {
        $user = Socialite::driver('facebook')->user();

        // $user->token;
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->setScopes(['read:user', 'public_repo'])->redirect();
    }

    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->user();

        // $user->token;
    }

    public function findOrCreateUser($user, $provider)
    {
        $authUser = User::where('email', $user->getEmail())->first();
        if ($authUser) {
            return $authUser;
        }
        return User::create([
            'name'     => $user->getName(),
            'email'    => $user->getEmail(),
            'password' => Hash::make($user->getName().$user->getId().$user->getEmail())
        ]);
    }
}
