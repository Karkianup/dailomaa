<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Product;
use App\Review;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function index()
    {
        if (Auth::guard('admin')->check()) {
            $userID = Auth::guard('admin')->user()->id;
        } elseif (Auth::guard('retailer')->check()) {
            $userID = Auth::guard('retailer')->user()->id;
        } else {
            $userID = Auth::user()->id;
        }

        // dd($userID);

        $reviews = Review::where('user_id', $userID)
            ->select('user_id', 'product_id', 'status', 'message', 'created_at')
            ->where('status', 1)
            ->with('product')
            ->latest()
            ->get();

        // dd($reviews->toArray());


        return view('Dashboard.Customer.Reviews.index', compact('reviews'));
    }
}
