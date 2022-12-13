<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  Illuminate\Support\Facades\Mail;
use App\SiteSetting;
use App\Map;
class MailController extends Controller
{

    public function index()
    {
        return view('Frontend.ContactUs.index',[
            "siteSetting"=>SiteSetting::first(),
          	"map"=>Map::first(),
        ]);
    }

    public function contactForm(Request $request)
    {
        $data = ["name" => $request->name, "email" => $request->email, "phone" => $request->phone, "requirement" => $request->requirement
    , "description" => $request->description
    ];
        Mail::send('Frontend.ContactUs.mail', $data, function ($message) use($data) {
             $message->to('dailoma@dailomaa.com');
            $message->subject("Message");
          	$message->from($data['email'],$data['name']);
});
        return redirect()->back()->withMessage('Successfully submitted');
    }
}