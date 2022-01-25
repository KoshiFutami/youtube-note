<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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

    public function redirectPath()
    {
        return route('home');
    }

    public function username()
    {
        return 'username';
    }

    // ゲストユーザーのID指定
    private const GUEST_USER_ID = 24; /* 本番環境 */
    // private const GUEST_USER_ID = 2; /* ローカル環境 */

    // ゲストログイン
    public function guestLogin()
    {
        if (\Auth::loginUsingID(self::GUEST_USER_ID)) {
            return redirect('/');
        }

        return redirect('/');
    }

}
