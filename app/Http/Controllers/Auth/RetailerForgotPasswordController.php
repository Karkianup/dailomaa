<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class RetailerForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;
    
    public function __construct()
    {
        $this->middleware('guest:retailer');
    }

    public function showLinkRequestForm()
    {
        return view('auth.passwords.retailer-email');
    }

    //defining which password broker to use, in our case its the retailers
    protected function broker()
    {
        return Password::broker('retailers');
    }
}
