<?php

namespace App\Http\Controllers\Frontend;

use App\Admin;
use App\Esewa;
use App\Http\Controllers\Controller;
use App\Http\Requests\Order\PlaceOrder;
use App\Http\Requests\Order\ProceedToPay;
use App\Order;
use App\OrderProduct;
use App\PaymentMethod;
use App\Product;
use App\Retailer;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function cashOnDelivery(Request $request)
    {
        $totalAmount = \Cart::getTotal();

        $totalQuantity = \Cart::getTotalQuantity();

        // Generates random order id for order
        $randomOrderID = uniqid();

        $paymentMethod = PaymentMethod::where('slug', 'cash-on-delivery')->firstOrFail();

        $paymentMethodID = $paymentMethod->id;

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

        $cart = \Cart::getContent();

        $order = new Order();
        $order->user_id = $user->id;
        $order->user_type = $userType;
        $order->random_id = $randomOrderID;
        $order->payment_id = $paymentMethodID;
        $order->total_quantity = $totalQuantity;
        $order->total_amount = $totalAmount;
        $order->status = Order::ORDER_COMPLETE;
        $order->payment_status = Order::PAYMENT_PENDING;
        $order->save();

        $orderID = DB::getPdo()->lastInsertId();


        foreach ($cart as $data) {
            $product = Product::where('id', $data['id'])->with('retailer')->firstOrFail()->toArray();

            $retailerID = $product['retailer']['id'];
            // dd($retailerID);

            $productID = $product['id'];
            $quantity = $data['quantity'];
            $OrderPro = new OrderProduct();
            $OrderPro->order_id = $orderID;
            $OrderPro->product_id = $productID;
            $OrderPro->product_image = $data['attributes']['image'];
            $OrderPro->retailer_id = $retailerID;
            $OrderPro->product_name = $data['name'];
            $OrderPro->price = $data['price'];
            $OrderPro->quantity = $quantity;
            $OrderPro->save();
        }

        \Cart::clear();

        return redirect()->route('cart.index')->with([
            'success_msg' => 'Thank you for your shopping, Your product will be at your door step ASAP.',
        ]);
    }

    public function paymentMethods(ProceedToPay $request)
    {
        $userID = Auth::user()->id;

        $user = User::where('id', $userID)->firstOrFail();
        $user->update(
            [
                'address' => $request->address,
                'contact_no' => $request->contact_no,
            ]
        );

        $cartCollection = \Cart::getContent();
        $paymentMethods = PaymentMethod::where('status', 1)->select('title', 'slug', 'url', 'status', 'image')->get();
        $productID = uniqid();
        if (\Cart::getTotalQuantity()) {
            return view('Frontend.Payment-Methods.list')->with(
                [
                    'cartCollection' => $cartCollection,
                    'paymentMethods' => $paymentMethods,
                    'productID' => $productID,
                ]
            );
        } else {
            return redirect()->route('cart.index');
        }
    }
}