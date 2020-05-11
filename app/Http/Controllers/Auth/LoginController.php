<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Socialite;
use App\User;
use Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        $role = $user->role;

        if (Gate::allows('access-dashboard')) return redirect()->intended(route('dashboard'));
        return redirect()->intended(route($role));
    }
    /**
     * Redirect the user to the Social authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->with(['prompt' => 'select_account'])->redirect();
    }

    /**
     * Obtain the user information from oauth provider.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($provider)
    {
        $socialUser = Socialite::driver($provider)->user();

        $user = User::where(['email' => $socialUser->getEmail()])->first();

        if ($user) {
            Auth::login($user, true);
        } else {
            $user = User::create([
                'name'          => $socialUser->getName(),
                'email'         => $socialUser->getEmail(),
                'avatar'         => $socialUser->getAvatar(),
                'provider_id'   => $socialUser->getId(),
                'provider'      => $provider,
            ]);
            Auth::login($user, true);
            return redirect()->intended(route('customer'));
        }

        $role = $user->role;

        if (Gate::allows('access-dashboard')) return redirect()->intended(route('dashboard'));
        return redirect()->intended(route($role));
    }
}
