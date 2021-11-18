<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Exception;

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

    protected $redirectTo = RouteServiceProvider::DASHBOARD;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectToProvider($website)
    {
        return Socialite::driver($website)->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($website)
    {

        try {
            $user = Socialite::driver($website)->user();
            dd($user);
            $cek = User::where('email', $user->email)->first();

            if ($cek) {
                Auth::login($cek);

                if ($cek->isRole('admin')) {
                    return redirect()->route('dashboard');
                } elseif ($cek->isRole('pelanggan')) {
                    return redirect()->route('outside.home');
                }
            } else {

                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'role_id' => 2,
                    'email_verified_at' => now(),
                    'password' => bcrypt('dummy76859230123'),
                ]);

                Auth::login($newUser);

                if ($cek->isRole('admin')) {
                    return redirect()->route('dashboard');
                } elseif ($cek->isRole('pelanggan')) {
                    return redirect()->route('outside.home');
                }
            };
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
