<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Product;
use App\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductWiseReviewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        // $productWiseReview = Review::findOrFail($id);

        if (Auth::guard('admin')->check()) {
            $productWiseReview = Review::findOrFail($id);
        } elseif (Auth::guard('retailer')->check()) {
            $retailerID = Auth::guard('retailer')->user()->id;
            $productWiseReview = Review::where('id', $id)->where('retailer_id', $retailerID)->with('retailer')->firstOrFail();
        }

        return view('Dashboard.Admin.Product-Wise-Reviews.edit', compact('productWiseReview'));

        // dd($review->toArray());
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
        $segment = $request->segment(1);

        if (Auth::guard('admin')->check()) {
            $productWiseReview = Review::findOrFail($id);
        } elseif (Auth::guard('retailer')->check()) {
            $retailerID = Auth::guard('retailer')->user()->id;
            $productWiseReview = Review::where('id', $id)->where('retailer_id', $retailerID)->with('retailer')->firstOrFail();
        }

        $categoryID = $productWiseReview->product_id;

        $productWiseReview->status = $request->input('status');
        $productWiseReview->save();

        return redirect(route($segment . '-' . 'product-wise-reviews', $categoryID));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $segment = $request->segment(1);

        if (Auth::guard('admin')->check()) {
            $productWiseReview = Review::findOrFail($id);
        } elseif (Auth::guard('retailer')->check()) {
            $retailerID = Auth::guard('retailer')->user()->id;
            $productWiseReview = Review::where('id', $id)->where('retailer_id', $retailerID)->with('retailer')->firstOrFail();
        }

        $slug = $productWiseReview->product_id;

        $productWiseReview->delete();

        return redirect(route($segment . '-' . 'product-wise-reviews', $slug));
    }
}
