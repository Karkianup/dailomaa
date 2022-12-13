<?php

namespace App\Http\Controllers\Frontend;

use App\Admin;
use App\CellPay;
use App\Http\Controllers\Controller;
use App\Order;
use App\OrderProduct;
use App\PaymentMethod;
use App\Product;
use App\Retailer;
use App\User;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class CellPayController extends Controller
{

    public function process(Request $request)
    {
        // dd('hi');
        $totalAmount = \Cart::getTotal();

        // Generates random order id for order and cellpay 
        $random_order_id = uniqid();

        $paymentMethod = PaymentMethod::where('slug', 'cellpay')->firstOrFail();

        $paymentMethodID = $paymentMethod->id;

        // dd($paymentMethodID);

        $merchantID = "9801977888";

        $description = "CellPay_payment";

        //Setting up urls for live or test
        $url = 'https://app.cellpay.com.np/test_merchant_api?';

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
        $order->user_id = $userID;
        $order->user_type = $userType;
        $order->random_id = $random_order_id;
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


        $cellPay = with(new CellPay);

        try {

            $cartData = [
                'merchant_id' => $merchantID,
                'amount' => $totalAmount,
                'invoice_number' => $random_order_id,
                'description' =>  $description,
                // 'success_callback' =>  URL::to('/checkout/payment/cellpay/completed'),
                'success_callback' => $cellPay->getSuccessCallback($random_order_id),
                'failure_callback' => $cellPay->getFailureCallback($random_order_id),
                'cancel_callback' => $cellPay->getCancelCallback($random_order_id),
            ];
            // dd($cellPay->getSuccessCallback($random_order_id));
            $stringData = http_build_query($cartData);

            return redirect()->away($url . $stringData);
        } catch (Exception $e) {
            // $order->update(['payment_status' => Order::PAYMENT_PENDING]);
            $order = Order::where('random_id', $random_order_id)->where('user_id', $userID)->firstOrFail();
            $order->update(['status' => Order::ORDER_CANCELLED]);

            return redirect()
                ->route('cart.index', $random_order_id)
                ->with('alert_msg', sprintf("Your payment failed with error: %s", $e->getMessage()));
        }

        return redirect()->route('cart.index')->with([
            'alert_msg' => "We're unable to process your payment at the moment, please try again !",
        ]);
    }


    public function paymentCompleted($random_order_id)
    {
        $client = new Client();

        $res = $client->request('POST', 'https: //web.cellpay.com.np/transaction_check/checkTransactionStatus', [
            'form_params' => [
                'cellpay_id' => $random_order_id,
            ]
        ]);

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
        if ($res->getStatusCode() == 200) { // 200 OK
            // $response_data = $res->getBody()->getContents();

            $order = Order::where('random_id', $random_order_id)->where('user_id', $userID)->firstOrFail();
            // dd($order->toarray());
            $order->update(['payment_status' => Order::PAYMENT_COMPLETED]);

            return redirect()->route('cart.index')->with([
                'success_msg' => 'Thank you for your shopping. Your payment has been successful.',
            ]);
        } else {
            $order = Order::where('random_id', $random_order_id)->where('user_id', $userID)->firstOrFail();
            // dd($order->toarray());
            $order->update(['payment_status' => Order::ORDER_CANCELLED]);

            return redirect()->route('cart.index')->with([
                'alert_msg' => 'The payment for your order has been declined, so your order has been cancelled.',
            ]);
        }

        // if (Auth::guard('retailer')->check()) {
        //     $user = Retailer::findOrFail(Auth::guard('retailer')->id());
        //     $userID = $user->id;
        // } elseif (Auth::guard('admin')->check()) {
        //     $user = Admin::findOrFail(Auth::guard('admin')->id());
        //     $userID = $user->id;
        // } elseif (Auth::user()) {
        //     $user = User::findOrFail(Auth::user()->id);
        //     $userID = $user->id;
        // }

        // $order = Order::where('random_id', $random_order_id)->where('user_id', $userID)->firstOrFail();
        // // dd($order->toarray());
        // $order->update(['payment_status' => Order::PAYMENT_COMPLETED]);

        // return redirect()->route('cart.index')->with([
        //     'success_msg' => 'Thank you for your shopping. Your payment has been successful.',
        // ]);
    }


    public function paymentFailed($random_order_id)
    {
        // dd('Failed');
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
        $order = Order::where('random_id', $random_order_id)->where('user_id', $userID)->firstOrFail();
        $order->update(['status' => Order::ORDER_CANCELLED]);

        return redirect()->route('cart.index')->with([
            'alert_msg' => 'The payment for your order has been declined, so your order has been cancelled.',
        ]);
    }

    public function paymentCancelled($random_order_id)
    {
        // dd('Cancelled');
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

        // dd('Payment Cancelled');
        $order = Order::where('random_id', $random_order_id)->where('user_id', $userID)->firstOrFail();
        $order->update(['status' => Order::ORDER_CANCELLED]);
        // dd($random_order_id);
        return redirect()->route('cart.index')->with([
            'alert_msg' => 'You just cancelled the payment, so your order has been cancelled',
        ]);
    }
}
