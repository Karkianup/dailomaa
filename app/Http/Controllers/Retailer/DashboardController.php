<?php

namespace App\Http\Controllers\Retailer;

use App\Brand;
use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use App\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $retailerID = Auth::guard('retailer')->user()->id;
        $categories = Category::count();
        $subCategories = SubCategory::count();
        $brands = Brand::count();
        $products = Product::where('retailer_id', $retailerID)->count();
        return view('Dashboard/Retailer/Dashboard/index', compact('categories','subCategories','brands','products'));
    }
}
