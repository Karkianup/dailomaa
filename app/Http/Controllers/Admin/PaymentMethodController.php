<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentMethod\CreatePaymentMethod;
use App\Http\Requests\PaymentMethod\UpdatePaymentMethod;
use App\PaymentMethod;
use Illuminate\Http\Request;
use Image;

class PaymentMethodController extends Controller
{
    public function index()
    {
        $paymentMethod = PaymentMethod::latest()
            ->get();

        return view('Dashboard.Admin.Payment-Method.index', compact('paymentMethod'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(PaymentMethod $paymentMethod)
    {
        return view('Dashboard.Admin.Payment-Method.create', compact('paymentMethod'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePaymentMethod $request, PaymentMethod $paymentMethod)
    {
        $segment = $request->segment(1);

        $paymentMethod['title'] = $request->title;
        $paymentMethod['url'] = $request->url;
        $paymentMethod['status'] = $request->status;

        if ($request->hasFile('image')) {
            $extension = $request->image->getClientOriginalExtension();
            $paymentMethod['image'] =  uniqid() . '.' . $extension;
            $request->image->move(public_path('Asset/Uploads/Payment-Methods'), $paymentMethod['image']);
        }

        $paymentMethod->save();

        return redirect(route($segment . '.' . 'payment-method.index'));
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
    public function edit(PaymentMethod $paymentMethod)
    {
        return view('Dashboard.Admin.Payment-Method.edit', compact('paymentMethod'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePaymentMethod $request, PaymentMethod $paymentMethod)
    {
        $segment = $request->segment(1);

        $paymentMethod->title = $request->input('title');
        $paymentMethod->url = $request->input('url');
        $paymentMethod->status = $request->input('status');

        if ($request->hasFile('image')) {


            $existingImage = public_path('Asset/Uploads/Payment-Methods/') . $paymentMethod->image;

            if (file_exists($existingImage)) {
                @unlink($existingImage);
            }

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileName = uniqid() . '.' . $extension;
            $file->move('Asset/Uploads/Payment-Methods/', $fileName);
            $paymentMethod->image = $fileName;
        }

        $paymentMethod->save();

        return redirect(route($segment . '.' . 'payment-method.index'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, PaymentMethod $paymentMethod)
    {
        $segment = $request->segment(1);

        $paymentMethod->delete();

        return redirect(route($segment . '.' . 'payment-method.index'));
    }
}
