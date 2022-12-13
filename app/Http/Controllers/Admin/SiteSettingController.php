<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\SiteSetting;
use Illuminate\Http\Request;
use Image;

class SiteSettingController extends Controller
{
    public function index()
    {
        $siteSettings = SiteSetting::all();

        $site_setting = $siteSettings[0]->toArray();

        // dd($site_setting);

        return view('Dashboard.Admin.SiteSettings.index', compact('site_setting'));
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|string',
            'email' => 'nullable|string',
            'mobile_no' => 'nullable|string',
            'address' => 'nullable|string',
            'post_code' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'facebook' => 'nullable|string',
            'instagram' => 'nullable|string',
            'twitter' => 'nullable|string',
            'linkedin' => 'nullable|string',
            'skype' => 'nullable|string',
            'meta_title' => 'sometimes|string',
            'meta_keywords' => 'sometimes|string',
            'meta_description' => 'sometimes|string',
            'site_url' => 'required|string',
            'about' => 'required|string',
            'google_maps' => 'nullable|string',

        ]);

        $setting = SiteSetting::findOrFail($id);
        $setting->title = $request->input('title');
        $setting->email = $request->input('email');
        $setting->mobile_no = $request->input('mobile_no');
        $setting->address = $request->input('address');
        $setting->post_code = $request->input('post_code');
        $setting->facebook = $request->input('facebook');
        $setting->instagram = $request->input('instagram');
        $setting->twitter = $request->input('twitter');
        $setting->linkedin = $request->input('linkedin');
        $setting->skype = $request->input('skype');
        $setting->meta_title = $request->input('meta_title');
        $setting->meta_keywords = $request->input('meta_keywords');
        $setting->meta_description = $request->input('meta_description');
        $setting->site_url = $request->input('site_url');
        $setting->about = $request->input('about');
        $setting->google_maps = $request->input('google_maps');

        if ($request->hasFile('logo')) {
            $setting['logo'] = uniqid() . '.' . $request->logo->getClientOriginalExtension();
            $request->logo->move('Asset/Uploads/Logo', $setting['logo']);
        }
        $setting->save();


        return redirect(route('site-settings.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
