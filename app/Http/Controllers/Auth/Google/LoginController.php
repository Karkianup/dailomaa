<?php

namespace App\Http\Controllers\Auth\Google;

use App\Http\Controllers\Controller;

use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Laravel\Socialite\Facades\Socialite;

use Illuminate\Support\Facades\Auth;

use Exception;

use App\User;

use Illuminate\Support\Str;

use Illuminate\Support\Facades\Hash;

class LoginController extends Controller

{

    use AuthenticatesUsers;

    public function __construct()

    {

        $this->middleware('guest')->except('logout');
    }

    public function redirectToGoogle()

    {
        return Socialite::driver('google')->redirect();

        // return Socialite::driver('google')->stateless()->redirect();
    }

    public function handleGoogleCallback()

    {

        try {

            $user = Socialite::driver('google')->user();

            // dd($user->getId());

            $oauth_id = $user->getId();
            // $user = Socialite::driver('google')->stateless()->user();

            $finduser = User::where('google_id', $oauth_id)->first();

            // dd($finduser);

            if ($finduser) {

                Auth::login($finduser);

                return redirect('/');
            } else {

                $newUser = User::create([

                    'name' => $user->name,

                    'email' => $user->email,

                    'random_id' => Str::random(10),

                    'google_id' => $oauth_id,

                    'password' => Hash::make($user->name . '@123456')

                ]);

                Auth::login($newUser);

                return redirect('/');
            }
        } catch (Exception $e) {

            return $e->getMessage();
        }
    }
}
