<?php

namespace App\Http\Controllers\Frontend;

use App\Contact;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\SiteSetting;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function index()
    {
        $contact = new Contact();

        $siteSetting = SiteSetting::select(
            'title',
            'meta_keywords',
            'meta_title',
            'address',
            'email',
            'mobile_no',
            'site_url',
            'meta_description',
            'twitter',
            'about',
            'facebook',
            'instagram',
            'twitter',
            'linkedin',
            'google_maps',
        )->get()->toArray();

        return view('Frontend.Contact.index', compact(
            'siteSetting',
            'contact'
        ));
    }

    public function contact(Request $request, Contact $contact)
    {
        if (Auth::user()) {
            $this->validate($request, [
                'subject' => 'required|string|max:100',
                'phone_number' => 'required|digits:10',
                'message' => 'required|string|max:500',

            ]);
        } else {
            $this->validate($request, [
                'subject' => 'required|string|max:100',
                'name' => 'required|string|max:100',
                'phone_number' => 'required|digits:10',
                'email' => 'required|email|max:255',
                'message' => 'required|string|max:500',
            ]);
        }

        if (Auth::user()) {
            $name = Auth::user()->name;
            $email = Auth::user()->email;
        } else {
            $name = $request->name;
            $email = $request->email;
        }
        $contact['subject'] = $request->subject;
        $contact['name'] = $name;
        $contact['email'] = $email;
        $contact['phone_number'] = $request->phone_number;
        $contact['message'] = $request->message;
        $contact['status'] = 0;

        $contact->save();

        return redirect()->back()->with('message', 'Thank you for contacting!!');
    }
}
