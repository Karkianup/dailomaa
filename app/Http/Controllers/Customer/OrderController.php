<?php

namespace App\Http\Controllers\Customer;

use App\Admin;
use App\Http\Controllers\Controller;
use App\Order;
use App\Retailer;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Exports\OrderExport;
use Excel;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user()->is_wholesaler == 1) {
            $userType = 'wholesaler';
        } else {
            $userType = 'customer';
        }
        $user = User::findOrFail(Auth::user()->id);
        $tableOrders=Order::where('user_type', $userType)
            ->where('user_id', $user->id)
            ->with('order_products')
            ->with('order_products.product')
            ->with('payment_method')
            ->latest()->get();
        $query = Order::where('user_type', $userType)
            ->where('user_id', $user->id)
            ->with('order_products')
            ->with('order_products.product')
            ->with('payment_method')
            ->latest();

                if($request->query('search')){
                    $search=$request->search;
                    $query->whereHas('order_products',function($query) use($search){
                            $query->where('product_name','LIKE','%'.$search.'%');
                    });
                }
                $orders=$query->paginate(5);
        // dd($orders);
        return view('Dashboard.Customer.Orders.index', compact('orders','tableOrders'));
    }
    public function exportOrder()
    {
        return Excel::download(new OrderExport,'order.xlsx');
    }

    public function search(Request $request)
    {

    }

    public function trackOrder(Request $request)
    {
        if (Auth::user()->is_wholesaler == 1) {
            $userType = 'wholesaler';
        } else {
            $userType = 'customer';
        }
        $user = User::findOrFail(Auth::user()->id);
        $tableOrders=Order::where('user_type', $userType)
            ->where('user_id', $user->id)
            ->with('order_products')
            ->with('order_products.product')
            ->with('payment_method')
            ->latest()->get();
        $query = Order::where('user_type', $userType)
            ->where('user_id', $user->id)
            ->with('order_products')
            ->with('order_products.product')
            ->with('payment_method')
            ->latest();

                if($request->query('search')){
                    $search=$request->search;
                    $query->whereHas('order_products',function($query) use($search){
                            $query->where('product_name','LIKE','%'.$search.'%');
                    });
                }
                $orders=$query->paginate(5);
        // dd($orders);
        return view('Dashboard.Customer.Orders.track-order', compact('orders','tableOrders'));
    }

    public function paymentHistory(Request $request)
    {
        if (Auth::user()->is_wholesaler == 1) {
            $userType = 'wholesaler';
        } else {
            $userType = 'customer';
        }
        $user = User::findOrFail(Auth::user()->id);
        $tableOrders=Order::where('user_type', $userType)
            ->where('user_id', $user->id)
            ->with('order_products')
            ->with('order_products.product')
            ->with('payment_method')
            ->latest()->get();
        $query = Order::where('user_type', $userType)
            ->where('user_id', $user->id)
            ->with('order_products')
            ->with('order_products.product')
            ->with('payment_method')
            ->latest();

                if($request->query('search')){
                    $search=$request->search;
                    $query->whereHas('order_products',function($query) use($search){
                            $query->where('product_name','LIKE','%'.$search.'%');
                    });
                }
                $orders=$query->paginate(5);
        // dd($orders);
        return view('Dashboard.Customer.Payment.index', compact('orders','tableOrders'));
    }

    public function orderCheck($orderId)
    {
        // dd($orderId);
        $orders=Order::with('order_products')->where('random_id',$orderId)->get();
        // dd($orders);
        return view('Dashboard.Customer.Orders.order-check', compact('orders'));

    }
}