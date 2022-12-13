<?php

namespace App\Http\Controllers\Frontend;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductFilter\PriceWiseRequest;
use App\Product;
use App\SiteSetting;
use App\SubCategory;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Illuminate\Support\Str;

class ProductFilterController extends Controller
{
    public function subCategoryPrice(PriceWiseRequest $request)
    {
        $minPrice = $request->min;
        $maxPrice = $request->max;

        $products = Product::where('regular_price', '>=', $minPrice)->where('regular_price', '<=', $maxPrice)
            ->select(
                'id',
                'name',
                'meta_description',
                'regular_price',
                'sale_price',
                'main_image',
                'slug',
                'created_at',
                'brand_id'
            )->with('brand')
            ->latest()
            ->paginate(6);

        $categories = Category::where('status', 1)->select('id', 'slug', 'name', 'status', 'image')->get();
        $subCategories = SubCategory::where('status', 1)->select('id', 'slug', 'name', 'status', 'category_id', 'image')->with('products')->get();

        $siteSEO = SiteSetting::select('title', 'meta_title', 'site_url', 'meta_description', 'twitter', 'default_image')->get()->toArray();

        // dd($siteSEO);

        SEOMeta::setTitle($siteSEO[0]['title']);
        SEOMeta::setDescription($siteSEO[0]['meta_description']);


        OpenGraph::setTitle($siteSEO[0]['title']);
        OpenGraph::setUrl($siteSEO[0]['site_url']);
        OpenGraph::setDescription($siteSEO[0]['meta_description']);
        OpenGraph::addImage($siteSEO[0]['site_url'] . '/' . 'Asset/Uploads/Default/' . $siteSEO[0]['default_image']);
        OpenGraph::setSiteName($siteSEO[0]['title']);
        OpenGraph::addProperty('type', 'article');

        TwitterCard::setType('summary');
        TwitterCard::setSite($siteSEO[0]['twitter']);
        TwitterCard::setTitle($siteSEO[0]['title']);
        TwitterCard::setDescription($siteSEO[0]['meta_description']);
        TwitterCard::addImage($siteSEO[0]['site_url'] . '/' . 'Asset/Uploads/Logo/logo.png');

        return view('Frontend.Product.Sub-Category-Price-Filter.index', compact(
            'categories',
            'subCategories',
            'products',
            'minPrice',
            'maxPrice'
        ));
    }

   
    public function subCategoryPriceSort(Request $request, $minPrice, $maxPrice)
    {
        $segment = $request->fullurl();

        if (Str::contains($segment, 'sort_by=name-ascending')) {
            $products = Product::where('status', 1)
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
            $products = Product::where('status', 1)
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
                ->latest()
                ->paginate(6);
        }

        $categories = Category::where('status', 1)->select('id', 'slug', 'name', 'status', 'image')->with('sub_categories')->with('sub_categories.products')->get();
        $subCategories = SubCategory::where('status', 1)->select('id', 'slug', 'name', 'status', 'image')->get();

        $siteSEO = SiteSetting::select('title', 'meta_title', 'site_url', 'meta_description', 'twitter', 'default_image')->get()->toArray();

        // dd($siteSEO);

        SEOMeta::setTitle($siteSEO[0]['title']);
        SEOMeta::setDescription($siteSEO[0]['meta_description']);


        OpenGraph::setTitle($siteSEO[0]['title']);
        OpenGraph::setUrl($siteSEO[0]['site_url']);
        OpenGraph::setDescription($siteSEO[0]['meta_description']);
        OpenGraph::addImage($siteSEO[0]['site_url'] . '/' . 'Asset/Uploads/Default/' . $siteSEO[0]['default_image']);
        OpenGraph::setSiteName($siteSEO[0]['title']);
        OpenGraph::addProperty('type', 'article');

        TwitterCard::setType('summary');
        TwitterCard::setSite($siteSEO[0]['twitter']);
        TwitterCard::setTitle($siteSEO[0]['title']);
        TwitterCard::setDescription($siteSEO[0]['meta_description']);
        TwitterCard::addImage($siteSEO[0]['site_url'] . '/' . 'Asset/Uploads/Logo/logo.png');

        return view('Frontend.Product.Category-Price-Filter.index', compact(
            'categories',
            'subCategories',
            'products',
            'minPrice',
            'maxPrice'
        ));
    }

    public function categoryPrice(PriceWiseRequest $request)
    {
        $minPrice = $request->min;
        $maxPrice = $request->max;

        $products = Product::where('regular_price', '>=', $minPrice)->where('regular_price', '<=', $maxPrice)
            ->select(
                'id',
                'name',
                'meta_description',
                'regular_price',
                'sale_price',
                'main_image',
                'slug',
                'created_at',
                'brand_id'
            )->with('brand')
            ->latest()
            ->paginate(6);

        $categories = Category::where('status', 1)->select('id', 'slug', 'name', 'status', 'image')->with('sub_categories')->with('sub_categories.products')->get();
        $subCategories = SubCategory::where('status', 1)->select('id', 'slug', 'name', 'status', 'image')->get();

        $siteSEO = SiteSetting::select('title', 'meta_title', 'site_url', 'meta_description', 'twitter', 'default_image')->get()->toArray();

        // dd($siteSEO);

        SEOMeta::setTitle($siteSEO[0]['title']);
        SEOMeta::setDescription($siteSEO[0]['meta_description']);


        OpenGraph::setTitle($siteSEO[0]['title']);
        OpenGraph::setUrl($siteSEO[0]['site_url']);
        OpenGraph::setDescription($siteSEO[0]['meta_description']);
        OpenGraph::addImage($siteSEO[0]['site_url'] . '/' . 'Asset/Uploads/Default/' . $siteSEO[0]['default_image']);
        OpenGraph::setSiteName($siteSEO[0]['title']);
        OpenGraph::addProperty('type', 'article');

        TwitterCard::setType('summary');
        TwitterCard::setSite($siteSEO[0]['twitter']);
        TwitterCard::setTitle($siteSEO[0]['title']);
        TwitterCard::setDescription($siteSEO[0]['meta_description']);
        TwitterCard::addImage($siteSEO[0]['site_url'] . '/' . 'Asset/Uploads/Logo/logo.png');

        return view('Frontend.Product.Category-Price-Filter.index', compact(
            'categories',
            'subCategories',
            'products',
            'minPrice',
            'maxPrice'
        ));
    }

    public function categoryPriceSort(Request $request, $minPrice, $maxPrice)
    {
        $segment = $request->fullurl();

        if (Str::contains($segment, 'sort_by=name-ascending')) {
            $products = Product::where('status', 1)
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
            $products = Product::where('status', 1)
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
                ->latest()
                ->paginate(6);
        }

        $categories = Category::where('status', 1)->select('id', 'slug', 'name', 'status', 'image')->with('sub_categories')->with('sub_categories.products')->get();
        $subCategories = SubCategory::where('status', 1)->select('id', 'slug', 'name', 'status', 'image')->get();

        $siteSEO = SiteSetting::select('title', 'meta_title', 'site_url', 'meta_description', 'twitter', 'default_image')->get()->toArray();

        // dd($siteSEO);

        SEOMeta::setTitle($siteSEO[0]['title']);
        SEOMeta::setDescription($siteSEO[0]['meta_description']);


        OpenGraph::setTitle($siteSEO[0]['title']);
        OpenGraph::setUrl($siteSEO[0]['site_url']);
        OpenGraph::setDescription($siteSEO[0]['meta_description']);
        OpenGraph::addImage($siteSEO[0]['site_url'] . '/' . 'Asset/Uploads/Default/' . $siteSEO[0]['default_image']);
        OpenGraph::setSiteName($siteSEO[0]['title']);
        OpenGraph::addProperty('type', 'article');

        TwitterCard::setType('summary');
        TwitterCard::setSite($siteSEO[0]['twitter']);
        TwitterCard::setTitle($siteSEO[0]['title']);
        TwitterCard::setDescription($siteSEO[0]['meta_description']);
        TwitterCard::addImage($siteSEO[0]['site_url'] . '/' . 'Asset/Uploads/Logo/logo.png');

        return view('Frontend.Product.Category-Price-Filter.index', compact(
            'categories',
            'subCategories',
            'products',
            'minPrice',
            'maxPrice'
        ));
    }
}
