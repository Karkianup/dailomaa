<?php

namespace App\Http\Controllers\Admin;

use App\Brand;
use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\Brand\CreateBrand;
use App\Http\Requests\Brand\UpdateBrand;
use App\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::with('category')->with('sub_category')->with('products')->get();

        return view('Dashboard.Admin.Brand.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Brand $brand)
    {
        $categories = Category::select('id','name')->get();
        $subCategories = SubCategory::select('id','name')->get();
        return view('Dashboard.Admin.Brand.create', compact('brand', 'categories', 'subCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateBrand $request, Brand $brand)
    {
        // dd($request->all());
        $segment = $request->segment(1);

        $brand['name'] = $request->name;
        $brand['is_featured'] = $request->has('on')? 1 : 0;
        $brand['category_id'] = $request->category_id;
        $brand['sub_category_id'] = $request->sub_category_id;
        $brand['status'] = $request->status;

        $imageName = Str::slug($request->name);

        if ($request->hasFile('image')) {
            $brand['image'] = $imageName . '.' . $request->image->getClientOriginalExtension();
            $request->image->move('Asset/Uploads/Brands', $brand['image']);
        }

        $brand->save();

        return redirect(route($segment . '.' . 'brand.index'));
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
    public function edit(Brand $brand)
    {
        $categories = Category::select('id','name')->get();
        $subCategories = SubCategory::select('id','name')->get();
        return view('Dashboard.Admin.Brand.edit', compact('brand','categories','subCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBrand $request, Brand $brand)
    {
        // dd($request->all());
        $segment = $request->segment(1);

        $brand->name = $request->input('name');
        $brand->is_featured = $request->input('is_featured');
        $brand->category_id = $request->input('category_id');
        $brand->sub_category_id = $request->input('sub_category_id');
        $brand->status = $request->input('status');

        $name = $request->input('name');

        if ($request->hasFile('image')) {

            $imageName = Str::slug($name);

            $existingImage = 'Asset/Uploads/Brands/' . $brand->image;

            if (file_exists($existingImage)) {
@unlink($existingImage);
            }

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileName = $imageName . '.' . $extension;
            $file->move('Asset/Uploads/Brands/', $fileName);
            $brand->image = $fileName;
        }

        $brand->save();

        return redirect(route($segment . '.' . 'brand.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Brand $brand)
    {
        $segment = $request->segment(1);
        $imagePath = 'Asset/Uploads/Brands/' . $brand->image;

        if (file_exists($imagePath)) {
@unlink($imagePath);
        }

        $brand->delete();

        return redirect(route($segment . '.' . 'brand.index'));
    }



    public function destroyBrand(Request $request,Brand $brand)
    {
        $segment = $request->segment(1);
        $imagePath = 'Asset/Uploads/Brands/' . $brand->image;

        if (file_exists($imagePath)) {
@unlink($imagePath);
        }

        $brand->delete();

        return redirect(route($segment . '.' . 'brand.index'));
    }
}