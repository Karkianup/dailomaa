<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Order\DirectOrders;
use  Illuminate\Support\Facades\Mail;

class ScrapSellController extends Controller
{
    public function index()
    {
        return view('Frontend.Direct-Order.scrap-sell');
    }

    public function store(DirectOrders $request)
    {

        $data = ["name" => $request->name,"type"=>$request->type, "contact" => $request->contact_number
        , "body" => $request->body];
            Mail::send('mail', $data, function ($message) use($data) {
                // $message->to('trekkinghubnepal@trekkinghubnepal.com');
                $message->subject("Message");
                  $message->from($data['name']);
            });

            return redirect()->back()->withMessage('Successfully send');

    }
}