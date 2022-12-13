<?php

namespace App\Http\Controllers\Admin;

use App\Brand;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\CreateProduct;
use App\Http\Requests\Product\UpdateProduct;
use App\Product;
use App\Retailer;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Image;

class ProductController extends Controller
{
    public function index()
    {
        if (Auth::guard('admin')->check()) {
            $products = Product::with('brand')->with('retailer')->with('reviews')->latest()->get();
        } elseif (Auth::guard('retailer')->check()) {
            $retailerID = Auth::guard('retailer')->user()->id;
            $products = Product::with('brand')->with('retailer')->where('retailer_id', $retailerID)->with('reviews')->latest()->get();
        }



        return view('Dashboard.Admin.Product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Product $product)
    {
        $brands = Brand::select('id', 'name')->get();

        $retailers = Retailer::select('id', 'name')->get();

        return view('Dashboard.Admin.Product.create', compact('product', 'brands', 'retailers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Product $product)
    {
        $segment = $request->segment(1);

        if ($segment == 'admin') {
            $this->validate($request, [
                'name' => 'required|string|max:255|unique:products',
                'brand_id' => 'required|integer',
                'sku_code' => 'nullable|string',
                'is_featured' => 'required|boolean',
                'regular_price' => 'required|integer',
                'sale_price' => 'nullable|integer',
                'wholesaler_price' => 'nullable|integer',
                'shipping_price' => 'nullable|integer',
                'allowed_quantity' => 'nullable|integer',
                'total' => 'required|integer',
                'retailer_id' => 'required|integer',
                'description' => 'required|string|max:2000000',
                'additional_information' => 'nullable|string|max:2000000',
                'meta_description' => 'nullable|string|max:200',
                'main_image' => 'required|image',
                'image' => 'nullable',
                'image.*' => 'mimes:jpeg,jpg,png,gif,csv,txt,pdf|max:10048',
                'status' => 'required|boolean',
            ]);
        } elseif ($segment == 'retailer') {
            $this->validate($request, [
                'name' => 'required|string|max:255|unique:products',
                'brand_id' => 'required|integer',
                'sku_code' => 'nullable|string',
                'is_featured' => 'required|boolean',
                'regular_price' => 'required|integer',
                'sale_price' => 'nullable|integer',
                'wholesaler_price' => 'nullable|integer',
                'shipping_price' => 'nullable|integer',
                'allowed_quantity' => 'nullable|integer',
                'total' => 'required|integer',
                'description' => 'required|string|max:2000000',
                'additional_information' => 'nullable|string|max:2000000',
                'meta_description' => 'nullable|string|max:200',
                'main_image' => 'required|image',
                'image' => 'nullable',
                'image.*' => 'mimes:jpeg,jpg,png,gif,csv,txt,pdf|max:10048',
                'status' => 'required|boolean',
            ]);
        }
        // dd($request->all());

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
        $product['shipping_price'] = $request->shipping_price;
        $product['allowed_quantity'] = $request->allowed_quantity;
        $product['total'] = $request->total;
        $product['retailer_id'] = $retailerID;
        $product['description'] = $request->description;
        $product['additional_information'] = $request->additional_information;
        $product['meta_description'] = $request->meta_description;
        $product['status'] = $request->status;

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

        return redirect(route($segment . '.' . 'product.index'));
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

    public function productWiseReviews($id)
    {
        // $productReviews = Product::where('id', $id)->with('reviews')
        //     ->firstOrFail();

        if (Auth::guard('admin')->check()) {
            $productReviews = Product::where('id', $id)->with('reviews')->firstOrFail();
        } elseif (Auth::guard('retailer')->check()) {
            $retailerID = Auth::guard('retailer')->user()->id;
            $productReviews = Product::where('id', $id)->where('retailer_id', $retailerID)->with('reviews')->firstOrFail();
        }

        // dd($productReviews->toArray());

        return view('Dashboard/Admin/Product-Wise-Reviews.index', compact('productReviews'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $brands = Brand::select('id', 'name')->get();
        $retailers = Retailer::select('id', 'name')->get();
        return view('Dashboard.Admin.Product.edit', compact('product', 'brands', 'retailers'));
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
        // dd($request->all());
        $segment = $request->segment(1);
        $product = Product::findOrFail($id);
        if ($segment == 'admin') {
            $this->validate($request, [
                'name' => 'required', 'string', 'max:255', 'unique:products,' . $product->name,
                'brand_id' => 'required', 'integer',
                'sku_code' => 'nullable', 'string',
                'is_featured' => 'required', 'boolean',
                'regular_price' => 'required', 'integer',
                'sale_price' => 'nullable', 'integer',
                'wholesaler_price' => 'nullable', 'integer',
                'shipping_price' => 'nullable', 'integer',
                'allowed_quantity' => 'nullable', 'integer',
                'total' => 'required', 'integer',
                'retailer_id' => 'required', 'integer',
                'description' => 'required', 'string', 'max:2000000',
                'additional_information' => 'nullable', 'string', 'max:2000000',
                'meta_description' => 'nullable|string|max:200',
                'image' => 'nullable',
                'image.*' => 'mimes:jpeg,jpg,png,gif,csv,txt,pdf|max:10048',
                'status' => 'required', 'boolean',
            ]);
        } elseif ($segment == 'retailer') {
            $this->validate($request, [
                'name' => 'required', 'string', 'max:255', 'unique:products,' . $product->name,
                'brand_id' => 'required', 'integer',
                'sku_code' => 'nullable', 'string',
                'is_featured' => 'required', 'boolean',
                'regular_price' => 'required', 'integer',
                'sale_price' => 'nullable', 'integer',
                'wholesaler_price' => 'nullable', 'integer',
                'shipping_price' => 'nullable', 'integer',
                'allowed_quantity' => 'nullable', 'integer',
                'total' => 'required', 'integer',
                'description' => 'required', 'string', 'max:2000000',
                'additional_information' => 'nullable', 'string', 'max:2000000',
                'meta_description' => 'nullable|string|max:200',
                'image' => 'nullable',
                'image.*' => 'mimes:jpeg,jpg,png,gif,csv,txt,pdf|max:10048',
                'status' => 'required', 'boolean',
            ]);
        }
        // dd($request->all());


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
        $product->shipping_price = $request->input('shipping_price');
        $product->allowed_quantity = $request->input('allowed_quantity');
        $product->total = $request->input('total');
        $product->retailer_id = $retailerID;
        $product->description = $request->input('description');
        $product->additional_information = $request->input('additional_information');
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

        return redirect(route($segment . '.' . 'product.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Product $product)
    {
        dd($product->id);
        $segment = $request->segment(1);
        $mainImagePath = 'Asset/Uploads/Products/' . $product->main_image;

        if (file_exists($mainImagePath)) {
@unlink($mainImagePath);
        }


        if ($product->image) {
            $images = json_decode($product->image);
            foreach ($images as $image) {
                $imagePath = 'Asset/Uploads/Products/' . $image;
                if (file_exists($imagePath)) {
@unlink($imagePath);
                }
            }
        }

        $product->delete();

        // return redirect(route($segment . '.' . 'product.index'));
        return redirect()->back();
    }
    public function destroyProduct(Request $request, Product $product)
    {
        $segment = $request->segment(1);
        $mainImagePath = 'Asset/Uploads/Products/' . $product->main_image;

        if (file_exists($mainImagePath)) {
@unlink($mainImagePath);
        }


        if ($product->image) {
            $images = json_decode($product->image);
            foreach ($images as $image) {
                $imagePath = 'Asset/Uploads/Products/' . $image;
                if (file_exists($imagePath)) {
@unlink($imagePath);
                }
            }
        }

        $product->delete();

        // return redirect(route($segment . '.' . 'product.index'));
        return redirect()->back();
    }
}