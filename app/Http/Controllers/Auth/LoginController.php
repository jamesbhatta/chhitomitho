<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Socialite;
use App\User;
use Auth;

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

    public function authenticated(Request $request, User $user)
    {
        // $role = Auth::user()->isRole();
        $role = $user->role;

        return redirect()->route($role);
    }

    public function redirectByRoles()
    {
        $role = Auth::user()->role;

        switch ($role) {
            case 'admin':
                echo 'admin';
                return redirect(route('admin'));
                echo 'after redorection';
                break;
            case 'manager':
                echo 'manager';
                return redirect()->route('manager');
                break;
            default:
                echo 'default';
                return redirect()->route('customer');
        }
        dd('Not redirected');
    }

    /**
     * Redirect the user to the Social authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
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
        }
        
        $role = $user->role;

        return redirect()->route($role);
    }
}
