<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CellPay extends Model
{

    public function formatAmount($amount)
    {
        return number_format($amount, 2, '.', '');
    }


    /**
     * @param 
     */
    public function getSuccessCallback($random_order_id)
    {
        return route('checkout.payment.cellpay.completed', $random_order_id);

        // return route('cart.index');
        // return "https://www.bloggerstale.com";
    }

    public function getFailureCallback($random_order_id)
    {
        return route('checkout.payment.cellpay.failed', $random_order_id);
    }


    public function getCancelCallback($random_order_id)
    {
        return route('checkout.payment.cellpay.cancelled', $random_order_id);
    }
}
