<?php

namespace App\Http\Controllers\Frontend;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\Search\SearchAndSort;
use App\Http\Requests\Search\SearchByPrice;
use App\Http\Requests\Search\SearchProduct;
use App\Product;
use App\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SearchController extends Controller
{
    public function search(SearchProduct $request)
    {
        // dd($request->all());
        // Get the search value from the request
        $searchData = $request->input('product');

        // Search in the name and description columns from the posts table
        $products = Product::query()
            ->where('name', 'LIKE', "%{$searchData}%")
            ->orWhere('description', 'LIKE', "%{$searchData}%")
            ->orWhere('meta_description', 'LIKE', "%{$searchData}%")
            ->get();

        $categories = Category::where('status', 1)->select('id', 'slug', 'name', 'status', 'image')->with('sub_categories')->with('sub_categories.products')->get();
        $subCategories = SubCategory::where('status', 1)->select('id', 'slug', 'name', 'status', 'image')->get();

        // dd($products->toArray());

        // Return the search view with the resluts compacted
        return view('Frontend.Product.Search-Results.index', compact(
            'products',
            'categories',
            'subCategories',
            'searchData'
        ));
    }

    public function searchByPrice(SearchByPrice $request)
    {
        $minPrice = $request->min;
        $maxPrice = $request->max;
        $searchData = $request->product;

        $products = Product::query()
            ->where('name', 'LIKE', "%{$searchData}%")
            // ->where('description', 'LIKE', "%{$searchData}%")
            // ->where('meta_description', 'LIKE', "%{$searchData}%")
            ->where('regular_price', '>=', $minPrice)
            ->where('regular_price', '<=', $maxPrice)
            ->get();

        $categories = Category::where('status', 1)->select('id', 'slug', 'name', 'status', 'image')->with('sub_categories')->with('sub_categories.products')->get();
        $subCategories = SubCategory::where('status', 1)->select('id', 'slug', 'name', 'status', 'image')->get();

        return view('Frontend.Product.Search-By-Price.index', compact(
            'products',
            'searchData',
            'minPrice',
            'maxPrice',
            'categories',
            'subCategories'
        ));
    }

    // For sorting the product after searching
    public function justSort(Request $request, $product)
    {
        $segment = $request->fullurl();
        $searchData = $product;

        if (Str::contains($segment, 'sort_by=name-ascending')) {
            $products = Product::where('status', 1)
                ->where('name', 'LIKE', "%{$searchData}%")
                ->where('description', 'LIKE', "%{$searchData}%")
                ->where('meta_description', 'LIKE', "%{$searchData}%")
                ->select(
                    'id',
                    'name',
                    'meta_description',
                    'regular_price',
                    'sale_price',
                    'main_image',
                    'slug',
                    'created_at',
                    'brand_id',
                    'status',
                )->with('brand')
                ->orderBy('name')
                ->paginate(6);
        } elseif (Str::contains($segment, 'sort_by=name-descending')) {
            $products = Product::where('status', 1)
                ->where('name', 'LIKE', "%{$searchData}%")
                ->where('description', 'LIKE', "%{$searchData}%")
                ->where('meta_description', 'LIKE', "%{$searchData}%")
                ->select(
                    'id',
                    'name',
                    'meta_description',
                    'regular_price',
                    'sale_price',
                    'main_image',
                    'slug',
                    'created_at',
                    'brand_id',
                    'status',
                )->with('brand')
                ->orderBy('name', 'DESC')
                ->paginate(6);
        } elseif (Str::contains($segment, 'sort_by=price-ascending')) {
            $products = Product::where('status', 1)
                ->where('name', 'LIKE', "%{$searchData}%")
                ->where('description', 'LIKE', "%{$searchData}%")
                ->where('meta_description', 'LIKE', "%{$searchData}%")
                ->select(
                    'id',
                    'name',
                    'meta_description',
                    'regular_price',
                    'sale_price',
                    'main_image',
                    'slug',
                    'created_at',
                    'brand_id',
                    'status',
                )->with('brand')
                ->orderBy('regular_price')
                ->paginate(6);
        } elseif (Str::contains($segment, 'sort_by=price-descending')) {
            $products = Product::where('status', 1)
                ->where('name', 'LIKE', "%{$searchData}%")
                ->where('description', 'LIKE', "%{$searchData}%")
                ->where('meta_description', 'LIKE', "%{$searchData}%")
                ->select(
                    'id',
                    'name',
                    'meta_description',
                    'regular_price',
                    'sale_price',
                    'main_image',
                    'slug',
                    'created_at',
                    'brand_id',
                    'status',
                )->with('brand')
                ->orderBy('regular_price', 'DESC')
                ->paginate(6);
        } else {
            return redirect()->back();
        }

        $categories = Category::where('status', 1)->select('id', 'slug', 'name', 'status', 'image')->with('sub_categories')->with('sub_categories.products')->get();
        $subCategories = SubCategory::where('status', 1)->select('id', 'slug', 'name', 'status', 'image')->get();


        return view('Frontend.Product.Search-Results.index', compact(
            'products',
            'searchData',
            'categories',
            'subCategories',
        ));
    }

    public function searchAndSort(Request $request, $product, $minPrice, $maxPrice)
    {
        $segment = $request->fullurl();

        $minPrice = $minPrice;
        $maxPrice = $maxPrice;

        $searchData = $product;

        if (Str::contains($segment, 'sort_by=name-ascending')) {
            $products = Product::where('status', 1)
                ->where('name', 'LIKE', "%{$searchData}%")
                ->where('regular_price', '>=', $minPrice)
                ->where('regular_price', '<=', $maxPrice)
                ->select(
                    'id',
                    'name',
                    'meta_description',
                    'regular_price',
                    'sale_price',
                    'main_image',
                    'slug',
                    'created_at',
                    'brand_id',
                    'status',
                )->with('brand')
                ->orderBy('name')
                ->paginate(6);
        } elseif (Str::contains($segment, 'sort_by=name-descending')) {
            $products = Product::where('status', 1)
                ->where('name', 'LIKE', "%{$searchData}%")
                ->where('regular_price', '>=', $minPrice)
                ->where('regular_price', '<=', $maxPrice)
                ->select(
                    'id',
                    'name',
                    'meta_description',
                    'regular_price',
                    'sale_price',
                    'main_image',
                    'slug',
                    'created_at',
                    'brand_id',
                    'status',
                )->with('brand')
                ->orderBy('name', 'DESC')
                ->paginate(6);
        } elseif (Str::contains($segment, 'sort_by=price-ascending')) {
            $products = Product::where('status', 1)
                ->where('name', 'LIKE', "%{$searchData}%")
                ->where('regular_price', '>=', $minPrice)
                ->where('regular_price', '<=', $maxPrice)
                ->select(
                    'id',
                    'name',
                    'meta_description',
                    'regular_price',
                    'sale_price',
                    'main_image',
                    'slug',
                    'created_at',
                    'brand_id',
                    'status',
                )->with('brand')
                ->orderBy('regular_price')
                ->paginate(6);
        } elseif (Str::contains($segment, 'sort_by=price-descending')) {
            $products = Product::where('status', 1)
                ->where('name', 'LIKE', "%{$searchData}%")
                ->where('regular_price', '>=', $minPrice)
                ->where('regular_price', '<=', $maxPrice)
                ->select(
                    'id',
                    'name',
                    'meta_description',
                    'regular_price',
                    'sale_price',
                    'main_image',
                    'slug',
                    'created_at',
                    'brand_id',
                    'status',
                )->with('brand')
                ->orderBy('regular_price', 'DESC')
                ->paginate(6);
        } else {
            return redirect()->back();
        }

        $categories = Category::where('status', 1)->select('id', 'slug', 'name', 'status', 'image')->with('sub_categories')->with('sub_categories.products')->get();
        $subCategories = SubCategory::where('status', 1)->select('id', 'slug', 'name', 'status', 'image')->get();


        return view('Frontend.Product.Search-By-Price.index', compact(
            'products',
            'searchData',
            'categories',
            'subCategories',
            'minPrice',
            'maxPrice',
        ));
    }
}
