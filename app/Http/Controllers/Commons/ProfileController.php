<?php

namespace App\Http\Controllers\Commons;

use App\Admin;
use App\Agent;
use App\Http\Controllers\Controller;
use App\Retailer;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        if (Auth::guard('admin')->check()) {
            $profile = Admin::findOrFail(Auth::guard('admin')->id());
        } else if (Auth::guard('retailer')->check()) {
            $profile = Retailer::findOrFail(Auth::guard('retailer')->id());
        } else {
            $profile = User::findOrFail(Auth::id());
        }

        return view('Dashboard.Commons.profile', compact('profile'));
    }

    public function changePassword()
    {
        return view('Dashboard.Commons.change-password');
    }

    public function updatePassword(Request $request)
    {
        // $guard = request()->segment(1);

        $url = $request->segment(1);

        if (Auth::guard('admin')->check()) {
            $user = Admin::findOrFail(Auth::guard('admin')->id());
        } elseif (Auth::guard('retailer')->check()) {
            $user = Retailer::findOrFail(Auth::guard('retailer')->id());
        } elseif (Auth::user()) {
            $user = User::findOrFail(Auth::id());
        }

        $this->validate($request, [
            'oldPassword' => 'required|min:6',
            'password' => 'required|min:6|confirmed',
        ]);


        if (Hash::check($request->oldPassword, $user->password)) {
            // dd('Password matched');
            $user->fill([
                'password' => Hash::make($request->password)
            ])->save();
            $request->session()->flash('success', 'Password changed');
        } else {
            // dd('Does not match');
            $request->session()->flash('error', 'Your old password does not match');
            return redirect($url . '/change-password');
        }

        return view('Dashboard.Commons.change-password');
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
        dd($request->all());
        if (Auth::guard('admin')->check()) {
            $user = Admin::findOrFail($id);
        } elseif ((Auth::guard('retailer')->check())) {
            $user = Retailer::findOrFail($id);
        } else {
            $user = User::findOrFail($id);
        }


        $this->validate($request, [
            'name' => 'required|string|max:191',
            'address' => 'nullable|string|max:191',
            'city' => 'nullable|string|max:191',
            'country' => 'nullable|string|max:191',
            'contact_no' => 'nullable|string|max:191',
            //in the email field for the current user email can be same
            'email' => 'required|string|email|max:191|unique:users,email,' . $user->id,
            'password' => 'sometimes|min:6',
            'image' => 'nullable', 'image',
        ]);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->address = $request->input('address');
        $user->city = $request->input('city');
        $user->country = $request->input('country');
        $user->contact_no = $request->input('contact_no');
        if ($request->hasFile('image')) {

            $imageName = Str::slug($user->name);

            $existingImage = public_path('Asset/Uploads/Users/') . $user->image;

            if (file_exists($existingImage)) {
                @unlink($existingImage);
                // Storage::delete($existingImage);
            }

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            // $fileName = time() . '.' . $extension;
            $fileName = $imageName . uniqid() . '.' . $extension;
            $file->move('Asset/Uploads/Users/', $fileName);
            $user->image = $fileName;
        }

        $user->save();

        return redirect('/customer/profile')->withMessage('Successfully updated');
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