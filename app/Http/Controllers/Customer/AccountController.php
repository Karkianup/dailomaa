<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Order;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index()
    {
        // $user = Auth::user();
        if (Auth::user()->is_wholesaler == 1) {
            $userType = 'wholesaler';
        } else {
            $userType = 'customer';
        }
        $user = User::findOrFail(Auth::user()->id);

        $orders = Order::where('user_type', $userType)
            ->where('user_id', $user->id)
            ->with('order_products')
            ->with('order_products.product')
            ->latest()
            ->take(5)
            ->get();

        // dd($orders[0]['order_products']->toArray());
        // dd($user);
        return view('Dashboard.Customer.Manage-Account.index', compact('user', 'orders'));
    }
}
