<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Retailer\CreateRetailer;
use App\Retailer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RetailerController extends Controller
{
    public function index()
    {
        $retailers = Retailer::with('products')->get();

        return view('Dashboard.Admin.Retailer.index', compact('retailers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Retailer $retailer)
    {
        return view('Dashboard.Admin.Retailer.create', compact('retailer'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRetailer $request, Retailer $retailer)
    {
        // dd($request->all());
        $retailer['name'] = $request->name;
        $retailer['email'] = $request->email;
        $retailer['address'] = $request->address;
        $retailer['city'] = $request->city;
        $retailer['country'] = $request->country;
        $retailer['contact_no'] = $request->contact_no;
        $retailer['password'] = Hash::make($request['password']);

        $name = strtolower($request->name);

        $removeSpace = str_replace(' ', '-', $name);

        if ($request->hasFile('image')) {
            $retailer['image'] = $removeSpace . uniqid() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move('Asset/Uploads/Users', $retailer['image']);
        }

        $retailer->save();

        return redirect(route('retailer.index'));
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
        $retailer = Retailer::findOrFail($id);

        return view('Dashboard.Admin.Retailer.edit', compact('retailer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Retailer $retailer)
    {
        $name = strtolower($retailer->name);

        $removeSpace = str_replace(' ', '-', $name);


        switch ($request->input('action')) {
            case 'update':
                // Save 
                $this->validate($request, [
                    'name' => 'required|string|max:255',
                    'email' => 'required|string|email|max:255|unique:retailers,email,' . $retailer->id,
                    'address' => 'nullable', 'string', 'max:255',
                    'city' => 'nullable', 'string', 'max:255',
                    'country' => 'nullable', 'string', 'max:255',
                    'contact_no' => 'nullable', 'string', 'max:255',
                    'image' => 'nullable', 'image', 'max:255',

                ]);
                // dd($request->all());

                $retailer['name'] = $request->name;
                $retailer['email'] = $request->email;
                $retailer['address'] = $request->address;
                $retailer['city'] = $request->city;
                $retailer['country'] = $request->country;
                $retailer['contact_no'] = $request->contact_no;

                    if ($request->hasFile('image')) {
                        $existingImage = 'Asset/Uploads/Users/' . $retailer->image;
            
                        if (file_exists($existingImage)) {
                            @unlink($existingImage);
                        }
            
                        $file = $request->file('image');
                        $extension = $file->getClientOriginalExtension();
                        $fileName = $removeSpace . uniqid() . '.' . $extension;
                        $file->move('Asset/Uploads/Users/', $fileName);
                        $retailer->image = $fileName;
                    }


                $retailer->save();

                break;

            case 'change-password':
                // Preview model
                $this->validate($request, [
                    'password' => 'required|string|min:8|confirmed',

                ]);
                $retailer->password = Hash::make($request->password);

                $retailer->save();

                break;
        }

        return redirect(route('retailer.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Retailer $retailer)
    {
        $existingImage = 'Asset/Uploads/Users/' . $retailer->image;

        if (file_exists($existingImage)) {
            @unlink($existingImage);
        }

        $retailer->delete();

        return redirect(route('retailer.index'));
    }
}
