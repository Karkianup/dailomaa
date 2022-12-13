<?php

namespace App\Http\Controllers\Admin;

use App\Brand;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\CreateProduct;
use App\Product;
use App\Retailer;
use App\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Image;

class BrandWiseProducts extends Controller
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
    public function create(Product $product, $slug)
    {
        // dd($slug);
        $oldBrand = Brand::where('slug', $slug)->firstOrFail()->toArray();

        // dd($oldBrand['id']);
        $brands = Brand::select('id', 'name')->get();
        $retailers = Retailer::select('id', 'name')->get();

        return view('Dashboard.Admin.Brand-Wise-Products.create', compact(
            'oldBrand',
            'brands',
            'retailers',
            'product'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Product $product)
    {
        if (Auth::guard('admin')->check()) {
            $this->validate($request, [
                'name' => 'required|string|max:255|unique:products',
                'brand_id' => 'required|integer',
                'sku_code' => 'nullable|string',
                'is_featured' => 'required|boolean',
                'regular_price' => 'required|integer',
                'sale_price' => 'nullable|integer',
                'wholesaler_price' => 'nullable|integer',
                'allowed_quantity' => 'nullable|integer',
                'total' => 'required|integer',
                'retailer_id' => 'required|integer',
                'description' => 'required|string|max:2000000',
                'meta_description' => 'required|string|max:200',
                'image' => 'nullable',
                'image.*' => 'mimes:jpeg,jpg,png,gif,csv,txt,pdf|max:10048',
                'status' => 'required|boolean',
            ]);
        } elseif (Auth::guard('retailer')->check()) {
            $this->validate($request, [
                'name' => 'required|string|max:255|unique:products',
                'brand_id' => 'required|integer',
                'sku_code' => 'nullable|string',
                'is_featured' => 'required|boolean',
                'regular_price' => 'required|integer',
                'sale_price' => 'nullable|integer',
                'wholesaler_price' => 'nullable|integer',
                'allowed_quantity' => 'nullable|integer',
                'total' => 'required|integer',
                'description' => 'required|string|max:2000000',
                'meta_description' => 'required|string|max:200',
                'image' => 'nullable',
                'image.*' => 'mimes:jpeg,jpg,png,gif,csv,txt,pdf|max:10048',
                'status' => 'required|boolean',
            ]);
        }
        // dd($request->all());
        $segment = $request->segment(1);

        if (Auth::guard('admin')->check()) {
            $retailerID = $request->retailer_id;
        } elseif (Auth::guard('retailer')->check()) {
            $retailer = Retailer::findOrFail(Auth::guard('retailer')->id());
            $retailerID = $retailer->id;
        }
        $brandID = $request->brand_id;

        $brand = Brand::where('id', $brandID)->firstOrFail();

        $subCategoryID = $brand['sub_category_id'];

        // dd($subCategoryID);

        $product['name'] = $request->name;
        $product['brand_id'] = $brandID;
        $product['sub_category_id'] = $subCategoryID;
        $product['sku_code'] = $request->sku_code;
        $product['is_featured'] = $request->has('on') ? 1 : 0;
        $product['regular_price'] = $request->regular_price;
        $product['sale_price'] = $request->sale_price;
        $product['wholesaler_price'] = $request->wholesaler_price;
        $product['allowed_quantity'] = $request->allowed_quantity;
        $product['total'] = $request->total;
        $product['retailer_id'] = $retailerID;
        $product['description'] = $request->description;
        $product['meta_description'] = $request->meta_description;
        $product['status'] = $request->status;

        $brand = Brand::where('id', $request->brand_id)->get()->toArray();

        $slug = $brand[0]['slug'];

        if ($request->hasFile('main_image')) {
            $image = $request->file('main_image');
            $originalImageName = uniqid() . '-' . "500x500" . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(500, 500)->save('Asset/Uploads/Products/' . $originalImageName);
            $product['main_image'] = $originalImageName;
        }

        if ($request->hasfile('image')) {
            $images = $request->image;
            foreach ($images as $image) {
                $originalImageName = uniqid() . '-' . "500x500" . '.' . $image->getClientOriginalExtension();
                Image::make($image)->resize(500, 500)->save('Asset/Uploads/Products/' . $originalImageName);
                $originalImage[] = $originalImageName;
            }

            $product['image'] = json_encode($originalImage);
        }
        $product->save();


        return redirect(route($segment . '.' . 'brand-wise-products.show', $slug));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $brand = Brand::where('slug', $slug)->get()->toArray();

        // dd($slug);

        $retailers = Retailer::select('id', 'name')->get();


        if (Auth::guard('admin')->check()) {
            $products = Product::where('brand_id', $brand[0]['id'])->with('brand')->with('reviews')->latest()->get();
        } elseif (Auth::guard('retailer')->check()) {
            $retailerID = Auth::guard('retailer')->user()->id;
            $products = Product::where('brand_id', $brand[0]['id'])->where('retailer_id', $retailerID)->with('brand')->with('reviews')->latest()->get();
        }

        return view('Dashboard.Admin.Brand-Wise-Products.index', compact('products', 'brand', 'retailers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $brands = Brand::select('id', 'name')->get();
        $retailers = Retailer::select('id', 'name')->get();
        return view('Dashboard.Admin.Brand-Wise-Products.edit', compact('product', 'brands', 'retailers'));
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
        $product = Product::findOrFail($id);

        if (Auth::guard('admin')->check()) {
            $this->validate($request, [
                'name' => 'required', 'string', 'max:255', 'unique:products,' . $product->name,
                'brand_id' => 'required', 'integer',
                'sku_code' => 'nullable', 'string',
                'is_featured' => 'required', 'boolean',
                'regular_price' => 'required', 'integer',
                'sale_price' => 'nullable', 'integer',
                'wholesaler_price' => 'nullable', 'integer',
                'allowed_quantity' => 'nullable', 'integer',
                'total' => 'required', 'integer',
                'retailer_id' => 'required', 'integer',
                'description' => 'required', 'string', 'max:2000000',
                'meta_description' => 'required|string|max:200',
                'image' => 'nullable',
                'image.*' => 'mimes:jpeg,jpg,png,gif,csv,txt,pdf|max:10048',
                'status' => 'required', 'boolean',
            ]);
        } elseif (Auth::guard('retailer')->check()) {
            $this->validate($request, [
                'name' => 'required', 'string', 'max:255', 'unique:products,' . $product->name,
                'brand_id' => 'required', 'integer',
                'sku_code' => 'nullable', 'string',
                'is_featured' => 'required', 'boolean',
                'regular_price' => 'required', 'integer',
                'sale_price' => 'nullable', 'integer',
                'wholesaler_price' => 'nullable', 'integer',
                'allowed_quantity' => 'nullable', 'integer',
                'total' => 'required', 'integer',
                'description' => 'required', 'string', 'max:2000000',
                'meta_description' => 'required|string|max:200',
                'image' => 'nullable',
                'image.*' => 'mimes:jpeg,jpg,png,gif,csv,txt,pdf|max:10048',
                'status' => 'required', 'boolean',
            ]);
        }


        $segment = $request->segment(1);

        $brand = $product->brand->slug;

        if (Auth::guard('admin')->check()) {
            $retailerID = $request->input('retailer_id');
        } elseif (Auth::guard('retailer')->check()) {
            $retailer = Retailer::findOrFail(Auth::guard('retailer')->id());
            $retailerID = $retailer->id;
        }

        $brandID = $request->input('brand_id');

        $brand = Brand::where('id', $brandID)->firstOrFail();

        $subCategoryID = $brand['sub_category_id'];

        // dd($subCategoryID);

        $product->name = $request->input('name');
        $product->brand_id = $brandID;
        $product->sub_category_id = $subCategoryID;
        $product->sku_code = $request->input('sku_code');
        $product->is_featured = $request->input('is_featured');
        $product->regular_price = $request->input('regular_price');
        $product->sale_price = $request->input('sale_price');
        $product->wholesaler_price = $request->input('wholesaler_price');
        $product->allowed_quantity = $request->input('allowed_quantity');
        $product->total = $request->input('total');
        $product->retailer_id = $retailerID;
        $product->description = $request->input('description');
        $product->meta_description = $request->input('meta_description');
        $product->status = $request->input('status');

        if ($request->hasFile('image')) {
            // $images = explode(",", $product->image);
            if ($product->image) {
                $images = json_decode($product->image);
                foreach ($images as $image) {
                    $existingImage = 'Asset/Uploads/Products/' . $image;
                    if (file_exists($existingImage)) {
                        @unlink($existingImage);
                    }
                }
            }

            $images = $request->image;
            foreach ($images as $image) {
                $originalImageName = uniqid() . '-' . "500x500" . '.' . $image->getClientOriginalExtension();
                Image::make($image)->resize(500, 500)
                    ->save('Asset/Uploads/Products/' . $originalImageName);
                $originalImage[] = $originalImageName;
                $product->image = json_encode($originalImage);
            }
        }

        if ($request->hasFile('main_image')) {
            $existingImage = 'Asset/Uploads/Products/' . $product->main_image;
            if (file_exists($existingImage)) {
                @unlink($existingImage);
            }

            $originalImage = $request->file('main_image');
            $extension = $originalImage->getClientOriginalExtension();

            $defaultImage = Image::make($originalImage);

            $originalPath = 'Asset/Uploads/Products/';

            $originalImageName = uniqid() . '-' . "500x500";

            $defaultImage->resize(500, 500);
            $defaultImage->save($originalPath . $originalImageName . '.' . $extension);

            $originalImageName = $originalImageName . '.' . $extension;

            $product->main_image = $originalImageName;
        }


        $product->save();

        return redirect(route($segment . '.' . 'brand-wise-products.show', $brand));
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
        $product = Product::findOrFail($id);

        $slug = $product->brand->slug;

        $imagePath = 'Asset/Uploads/Products/' . $product->image;

        if (file_exists($imagePath)) {
            @unlink($imagePath);
        }

        $product->delete();

        return redirect(route($segment . '.' . 'brand-wise-products.show', $slug));
    }
}
