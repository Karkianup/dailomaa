<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

class RetailerResetPasswordController extends Controller
{
    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/retailer/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:retailer');
    }

    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.passwords.retailer-reset')
            ->with(['token' => $token, 'email' => $request->email]);
    }


    //defining which guard to use in our case, it's the retailer guard
    protected function guard()
    {
        return Auth::guard('retailer');
    }

   //set password broker name according to guard which you have set in config/auth.php
    protected function broker()
    {
        return Password::broker('retailers');
    }
}
