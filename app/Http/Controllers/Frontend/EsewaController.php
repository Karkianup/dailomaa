<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\PaymentMethod;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Retailer;
use App\Admin;
use App\Order;
use App\OrderProduct;
use App\User;
use App\Product;
use App\Esewa;
use Exception;

class EsewaController extends Controller
{
    public function orderCompleted($randomOrderID, Request $request)
    {
        if (Auth::guard('retailer')->check()) {
            $user = Retailer::findOrFail(Auth::guard('retailer')->id());
            $userID = $user->id;
        } elseif (Auth::guard('admin')->check()) {
            $user = Admin::findOrFail(Auth::guard('admin')->id());
            $userID = $user->id;
        } elseif (Auth::user()) {
            $user = User::findOrFail(Auth::user()->id);
            $userID = $user->id;
        }

        $order = Order::where('random_id', $randomOrderID)->where('user_id', $userID)->firstOrFail();

        // dd($order->total_amount);

        $gateway = with(new Esewa);

        $response = $gateway->verifyPayment([
            'amount' => $gateway->formatAmount($order->total_amount),
            'referenceNumber' => $request->get('refId'),
            'productCode' => $request->get('oid'),
        ], $request);

        if ($response->isSuccessful()) {
            $order->update([
                'transaction_id' => $request->get('refId'),
                'payment_status' => Order::PAYMENT_COMPLETED,
            ]);

            return redirect()->route('cart.index')->with([
                'success_msg' => 'Thank you for your shopping, Your recent payment was successful.',
            ]);
        }

        return redirect()->route('cart.index')->with([
            'alert_msg' => 'Thank you for your shopping, However, the payment has been declined.',
        ]);
    }


    public function orderFailed($randomOrderID)
    {
        if (Auth::guard('retailer')->check()) {
            $user = Retailer::findOrFail(Auth::guard('retailer')->id());
            $userID = $user->id;
        } elseif (Auth::guard('admin')->check()) {
            $user = Admin::findOrFail(Auth::guard('admin')->id());
            $userID = $user->id;
        } elseif (Auth::user()) {
            $user = User::findOrFail(Auth::user()->id);
            $userID = $user->id;
        }

        // dd('Payment Failed');
        $order = Order::where('random_id', $randomOrderID)->where('user_id', $userID)->firstOrFail();
        $order->update(['status' => Order::ORDER_CANCELLED]);

        return redirect()->route('cart.index')->with([
            'alert_msg' => 'The payment for your order has been declined, so your order has been cancelled.',
        ]);
    }

    public function process(Request $request)
    {
        $totalAmount = \Cart::getTotal();

        // Generates random order id for order and esewa 
        $randomOrderID = uniqid();

        $paymentMethod = PaymentMethod::where('slug', 'esewa')->firstOrFail();

        $paymentMethodID = $paymentMethod->id;

        if (Auth::guard('retailer')->check()) {
            $userType = 'retailer';
            $user = Retailer::findOrFail(Auth::guard('retailer')->id());
            $userID = $user->id;
        } elseif (Auth::guard('admin')->check()) {
            $userType = 'admin';
            $user = Admin::findOrFail(Auth::guard('admin')->id());
            $userID = $user->id;
        } elseif (Auth::user()) {
            if (Auth::user()->is_wholesaler == 1) {
                $userType = 'wholesaler';
            } else {
                $userType = 'customer';
            }
            $user = User::findOrFail(Auth::user()->id);
            $userID = $user->id;
        }

        $cart = \Cart::getContent();

        $order = new Order();
        $order->user_id = $user->id;
        $order->user_type = $userType;
        $order->random_id = $randomOrderID;
        $order->payment_id = $paymentMethodID;
        $order->total_quantity = \Cart::getTotalQuantity();
        $order->total_amount = \Cart::getTotal();
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

        $gateway = with(new Esewa);

        try {
            $response = $gateway->purchase([
                'amount' => $gateway->formatAmount($totalAmount),
                'totalAmount' => $gateway->formatAmount($totalAmount),
                'productCode' => $randomOrderID,
                'failedUrl' => $gateway->getFailedUrl($randomOrderID),
                'returnUrl' => $gateway->getReturnUrl($randomOrderID),
            ], $request);
        } catch (Exception $e) {
            // dd('failed');
            // $order->update(['payment_status' => Order::PAYMENT_PENDING]);

            $order = Order::where('random_id', $randomOrderID)->where('user_id', $userID)->firstOrFail();
            $order->update(['status' => Order::ORDER_CANCELLED]);

            return redirect()
                ->route('cart.index', $randomOrderID)
                ->with('alert_msg', sprintf("Your payment failed with error: %s", $e->getMessage()));
        }

        if ($response->isRedirect()) {
            $response->redirect();
        }

        return redirect()->route('cart.index')->with([
            'alert_msg' => "We're unable to process your payment at the moment, please try again !",
        ]);
    }
}
