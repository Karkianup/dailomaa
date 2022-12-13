<?php

namespace App\Exports;
use App\Order;
use App\OrderProduct;
use Maatwebsite\Excel\Concerns\FromCollection;
use Excel;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
class OrderExport implements  FromView
{

    public function view() : view
    {
        $orders= OrderProduct::with('order')->wherehas('order',function($query){
            $query->where('user_id',auth()->id());
        })->get()->makeHidden('order_id');
            // dd($orders);
        return view('excel',compact('orders'));
    }

}