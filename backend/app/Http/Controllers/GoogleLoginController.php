<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleLoginController extends Controller
{
    public function getGoogleAuth()
    {
        return Socialite::driver('google')->redirect();
    }

    public function authGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();

        $user = User::where('email', $googleUser->email)->first();
        if ($user == null) {
            $user = $this->createUserByGoogle($googleUser);
        }

        Auth::login($user, true);
        session()->flash('toastr', config('toastr.google.login'));
        return redirect(route('home'));
    }

    public function createUserByGoogle($googleUser)
    {
        $user = User::create([
            'name' => $googleUser->name,
            'email' => $googleUser->email,
            'username' => $this->makeUsernameFromGmail($googleUser->email),
            'password' => \Hash::make(uniqid()),
        ]);
        return $user;
    }

    public function makeUsernameFromGmail($gmailAddress)
    {
        $posAt = strpos($gmailAddress, '@');
        $username = substr($gmailAddress, 0, $posAt);
        return $username;
    }
}
