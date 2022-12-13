<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;

class AdminController extends Controller
{
    public function index()
    {
        if (Gate::allows('is_super_admin')) {
            $admins = Admin::all();
            return view('Dashboard.Admin.Admin.index', compact('admins'));
        }
        else{
            return abort('404');
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Admin $admin)
    {
        if (Gate::allows('is_super_admin')) {
            return view('Dashboard.Admin.Admin.create', compact('admin'));
        }
        else{
            return abort('404');
        }
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateAdmin $request, Admin $admin)
    {
        // dd($request->all());
        $admin['name'] = $request->name;
        $admin['email'] = $request->email;
        $admin['address'] = $request->address;
        $admin['city'] = $request->city;
        $admin['country'] = $request->country;
        $admin['contact_no'] = $request->contact_no;
        $admin['is_super'] = $request->is_super;
        $admin['password'] = Hash::make($request['password']);

        $name = strtolower($request->name);

        $removeSpace = str_replace(' ', '-', $name);

        if ($request->hasFile('image')) {
            $admin['image'] = $removeSpace . uniqid() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move('Asset/Uploads/Users', $admin['image']);
        }

        $admin->save();

        return redirect(route('admin.index'));
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
        if (Gate::allows('is_super_admin')) {
            $admin = Admin::findOrFail($id);
            return view('Dashboard.Admin.Admin.edit', compact('admin'));
        }
        else{
            return abort('404');
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        $name = strtolower($admin->name);

        $removeSpace = str_replace(' ', '-', $name);


        switch ($request->input('action')) {
            case 'update':
                // Save 
                $this->validate($request, [
                    'name' => 'required|string|max:255',
                    'email' => 'required|string|email|max:255|unique:admins,email,' . $admin->id,
                    'address' => 'nullable', 'string', 'max:255',
                    'city' => 'nullable', 'string', 'max:255',
                    'country' => 'nullable', 'string', 'max:255',
                    'contact_no' => 'nullable', 'string', 'max:255',
                    'is_super' => 'required', 'boolean',
                    'image' => 'nullable', 'image', 'max:255',

                ]);
                // dd($request->all());

                $admin['name'] = $request->name;
                $admin['email'] = $request->email;
                $admin['address'] = $request->address;
                $admin['city'] = $request->city;
                $admin['country'] = $request->country;
                $admin['contact_no'] = $request->contact_no;
                $admin['is_super'] = $request->is_super;

                    if ($request->hasFile('image')) {
                        $existingImage = 'Asset/Uploads/Users/' . $admin->image;
            
                        if (file_exists($existingImage)) {
@unlink($existingImage);
                        }
            
                        $file = $request->file('image');
                        $extension = $file->getClientOriginalExtension();
                        $fileName = $removeSpace . uniqid() . '.' . $extension;
                        $file->move('Asset/Uploads/Users/', $fileName);
                        $admin->image = $fileName;
                    }


                $admin->save();

                break;

            case 'change-password':
                // Preview model
                $this->validate($request, [
                    'password' => 'required|string|min:8|confirmed',

                ]);
                $admin->password = Hash::make($request->password);

                $admin->save();

                break;
        }

        return redirect(route('admin.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        if (Gate::allows('is_super_admin')) {
            $existingImage = 'Asset/Uploads/Users/' . $admin->image;
    
            if (file_exists($existingImage)) {
    @unlink($existingImage);
            }
    
            $admin->delete();
            return redirect(route('admin.index'));
        }
        else{
            return abort('404');
        }

    }
}
