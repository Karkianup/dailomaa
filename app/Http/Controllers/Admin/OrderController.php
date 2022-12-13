<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Request\UpdateOrder;
use App\Order;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::guard('admin')->check()) {
            $orders = Order::with('order_products.product')
                ->latest()
                ->get();
        } else {
            redirect()->back();
        }


        return view('Dashboard.Admin.Order.index', compact('orders'));
    }

    public function pendingOrders()
    {
        // if (Auth::guard('admin')->check()) {
        //     $orders = Order::with('order_products.user')->with('order_products.product')
        //         ->latest()
        //         ->get();
        // } elseif (Auth::guard('retailer')->check()) {
        //     $retailerID = Auth::guard('retailer')->user()->id;
        //     $orders = Order::where('status', 'Ordered')
        //         ->with('order_products.user')
        //         ->with('order_products.product')
        //         ->latest()
        //         ->get();
        // }

        $orders = Order::where('status', 1)
            ->with('order_products.user')
            ->with('order_products.product')
            ->latest()
            ->get();

        return view('Dashboard.Admin.Order.index', compact('orders'));
    }

    public function cancelledOrders()
    {
        // if (Auth::guard('admin')->check()) {
        //     $orders = Order::with('order_products.user')->with('order_products.product')
        //         ->latest()
        //         ->get();
        // } elseif (Auth::guard('retailer')->check()) {
        //     $retailerID = Auth::guard('retailer')->user()->id;
        //     $orders = Order::where('status', 'Ordered')
        //         ->with('order_products.user')
        //         ->with('order_products.product')
        //         ->latest()
        //         ->get();
        // }

        $orders = Order::where('status', 2)
            ->with('order_products.user')
            ->with('order_products.product')
            ->latest()
            ->get();

        return view('Dashboard.Admin.Order.index', compact('orders'));
    }

    public function deliveredOrders()
    {
        // dd('hi');
        // if (Auth::guard('admin')->check()) {
        //     $orders = Order::with('order_products.user')->with('order_products.product')
        //         ->latest()
        //         ->get();
        // } elseif (Auth::guard('retailer')->check()) {
        //     $retailerID = Auth::guard('retailer')->user()->id;
        //     $orders = Order::where('status', 'Delivered')
        //         ->with('order_products.user')
        //         ->with('order_products.product')
        //         ->latest()
        //         ->get();
        // }

        $orders = Order::where('status', 3)
            ->with('order_products.user')
            ->with('order_products.product')
            ->latest()
            ->get();

        return view('Dashboard.Admin.Order.index', compact('orders'));
    }

    public function outForDelivery()
    {
        // dd('hi');
        // if (Auth::guard('admin')->check()) {
        //     $orders = Order::with('order_products.user')->with('order_products.product')
        //         ->latest()
        //         ->get();
        // } elseif (Auth::guard('retailer')->check()) {
        //     $retailerID = Auth::guard('retailer')->user()->id;
        //     $orders = Order::where('status', 'Out For Delivery')
        //         ->with('order_products.user')
        //         ->with('order_products.product')
        //         ->latest()
        //         ->get();
        // }

        $orders = Order::where('status', 4)
            ->with('order_products.user')
            ->with('order_products.product')
            ->latest()
            ->get();

        return view('Dashboard.Admin.Order.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::guard('admin')->check()) {
            $order = Order::where('id', $id)
                ->with('order_products.product')
                ->with('order_products.user')
                ->firstOrFail();
        } elseif (Auth::guard('retailer')->check()) {
            $retailerID = Auth::guard('retailer')->user()->id;
            // dd($retailerID);
            $order = Order::where('id', $id)
                ->with('order_products.user')
                ->with('order_products.product')
                ->firstOrFail();
        }
        // dd($order);
        return view('Dashboard.Admin.Order.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrder $request, $id)
    {
        $segment = $request->segment(1);

        if (Auth::guard('admin')->check()) {
            $order = Order::where('id', $id)
                ->with('order_products.product')
                ->with('order_products.user')
                ->firstOrFail();
        } elseif (Auth::guard('retailer')->check()) {
            // dd('retailer');

            $retailerID = Auth::guard('retailer')->user()->id;
            // dd($retailerID);
            $order = Order::where('id', $id)
                ->with('order_products.user')
                ->with('order_products.product')
                ->firstOrFail();
        }

        $order->status = $request->input('status');
        $order->delivery_date = $request->input('delivery_date');

        $order->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->back();
    }
}
