<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin;
use App\Http\Requests\Review\ProductReview;
use App\Product;
use App\Retailer;
use App\Review;
use App\User;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(ProductReview $request)
    {
        if (Auth::guard('retailer')->check()) {
            $userType = 'retailer';
            $userID = Retailer::findOrFail(Auth::guard('retailer')->id());
        } elseif (Auth::guard('admin')->check()) {
            $userType = 'admin';
            $userID = Admin::findOrFail(Auth::guard('admin')->id());
        } else {
            if (Auth::user()->is_wholesaler == 1) {
                $userType = 'wholesaler';
            } else {
                $userType = 'customer';
            }
            $userID = User::findOrFail(Auth::user()->id);
        }

        // dd($request->all());

        $productID = $request->product_id;

        $review = new Review();

        $product = Product::where('id', $productID)->select('id','retailer_id')->firstOrFail()->toArray();

        $retailerID = $product['retailer_id'];

        // dd($retailerID);

        $review['user_id'] = $userID['id'];
        $review['product_id'] = $request->product_id;
        $review['retailer_id'] = $retailerID;
        $review['user_type'] = $userType;
        $review['message'] = $request->message;
        $review['rating'] = 3;
        $review['status'] = 0;

        $review->save();

        return redirect()->back();


        // dd($userType);
    }
}
