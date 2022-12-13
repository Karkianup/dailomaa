<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Admin;
use App\PaymentMethod;
use App\Product;
use App\Retailer;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function checkout(Request $request)
    {
        if (Auth::guard('retailer')->check()) {
            $userType = 'retailer';
            $user = Retailer::findOrFail(Auth::guard('retailer')->id());
        } elseif (Auth::guard('admin')->check()) {
            $userType = 'admin';
            $user = Admin::findOrFail(Auth::guard('admin')->id());
        } elseif (Auth::user()) {
            if (Auth::user()->is_wholesaler == 1) {
                $userType = 'wholesaler';
            } else {
                $userType = 'customer';
            }
            $user = User::findOrFail(Auth::user()->id);
        }

        // dd($request->all());
        $product = Product::findOrFail($request->product_id);
        $quantity = $request->quantity;

        return view('Frontend.Order.checkout', compact('user', 'userType', 'product', 'quantity'));
    }

    public function cartCheckout(Request $request)
    {
        // dd('hi');
        if (Auth::guard('retailer')->check()) {
            $userType = 'retailer';
            $user = Retailer::findOrFail(Auth::guard('retailer')->id());
        } elseif (Auth::guard('admin')->check()) {
            $userType = 'admin';
            $user = Admin::findOrFail(Auth::guard('admin')->id());
        } elseif (Auth::user()) {
            if (Auth::user()->is_wholesaler == 1) {
                $userType = 'wholesaler';
            } else {
                $userType = 'customer';
            }
            $user = User::findOrFail(Auth::user()->id);
        }

        $paymentMethods = PaymentMethod::where('status', 1)->where('title','Esewa')->orWhere('title','Cash On Delivery')->select('title', 'slug', 'url', 'status','image')->get();

        // dd($request->all());
        $cartCollection = \Cart::getContent();

        return view('Frontend.Cart.checkout', compact('user', 'userType', 'cartCollection', 'paymentMethods'));
    }
}