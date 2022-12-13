<?php

namespace App\Http\Controllers\Frontend;

use App\Banner;
use App\Brand;
use App\Advertisement;
use App\Advertisement1;
use App\Advertisement2;



use App\Http\Controllers\Controller;
use App\Product;
use App\SubCategory;
use App\SiteSetting;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // $subCategories = SubCategory::select('name', 'slug')->latest()->get();

        $subCategories = SubCategory::where('status', 1)
            ->where('is_featured', 1)
            ->select('id','name', 'image', 'slug', 'status', 'is_featured', 'category_id')
            ->get()
            ->take(8);

        $banners = Banner::select('title', 'description', 'image', 'slug', 'status','url')->where('status', 1)->get();

        $brands = Brand::where('status', 1)
            ->select('id', 'name', 'image', 'slug', 'status', 'is_featured', 'category_id')
            ->where('is_featured', 1)
            ->with(
                [
                    'products' => function ($products) {
                        $products->where('status', 1);
                    },

                ]
            )
            ->get()
            ->take(5);

        $featuredProducts = Product::where('status', 1)
            ->where('is_featured', 1)
            ->select('id','name', 'main_image', 'image' ,'slug', 'status', 'sale_price', 'regular_price', 'is_featured', 'brand_id')
            ->take(6)
            ->get();
        $newProducts = Product::where('status', 1)
            ->select('id','name', 'main_image','image' ,'slug', 'status', 'brand_id', 'sale_price', 'regular_price')
            ->latest()
            ->with('brand')
            ->take(6)
            ->get();

        $justForYou = Product::where('status', 1)
            ->where('is_featured', 0)
            ->select('id','name','image','main_image', 'slug', 'status', 'brand_id', 'sale_price', 'regular_price')
            ->inRandomOrder()
            ->with('brand')
            ->take(6)
            ->get();
            // dd($justForYou);

        // dd($justForYou);

        $topCategories = SubCategory::where('status', 1)
            // ->select('id', 'name', 'image', 'slug', 'status', 'is_featured', 'category_id')
            ->get()
            ->sortByDesc('brands');
        $advertisements=Advertisement::all();
        $advertisements1=Advertisement1::all();
        $sectionFeatured=Advertisement2::all();

        $siteSetting=SiteSetting::first();
        return view('Frontend.Home.index', compact(
            'subCategories',
            'brands',
            'featuredProducts',
            'newProducts',
            'banners',
            'justForYou',
            'topCategories',
            'advertisements',
            'siteSetting'
            ,'advertisements1',
            'sectionFeatured',
        ));
    }

}