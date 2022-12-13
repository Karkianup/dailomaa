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

class SCWiseBrandsController extends Controller
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
    public function create(Brand $brand, $slug)
    {
        // dd($slug);
        $newSubCategory = SubCategory::where('slug',$slug)->firstOrFail()->toArray();

        // dd($newSubCategory['id']);
        $categories = Category::select('id','name')->get();
        $subCategories = SubCategory::select('id','name')->get();
        return view('Dashboard.Admin.SC-Wise-Brands.create', compact(
            'brand', 'categories', 'subCategories','newSubCategory'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateBrand $request, Brand $brand)
    {
        $segment = $request->segment(1);

        $brand['name'] = $request->name;
        $brand['is_featured'] = $request->has('on')? 1 : 0;
        $brand['category_id'] = $request->category_id;
        $brand['sub_category_id'] = $request->sub_category_id;
        $brand['status'] = $request->status;

        $imageName = Str::slug($request->name);

        $category = SubCategory::where('id',$request->sub_category_id)->get()->toArray();

        $slug = $category[0]['slug'];

        if ($request->hasFile('image')) {
            $brand['image'] = $imageName . '.' . $request->image->getClientOriginalExtension();
            $request->image->move('Asset/Uploads/Brands', $brand['image']);
        }

        $brand->save();

        return redirect(route($segment . '.' . 'sub-category-wise-brands.show', $slug));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $subCategory = SubCategory::where('slug', $slug)->get()->toArray();
        $brands = Brand::where('sub_category_id', $subCategory[0]['id'])->with('category')->with('sub_category')->with('products')->get();

        return view('Dashboard.Admin.SC-Wise-Brands.index', compact('brands','subCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brand = Brand::findOrFail($id);
        $categories = Category::select('id','name')->get();
        $subCategories = SubCategory::select('id','name')->get();
        return view('Dashboard.Admin.SC-Wise-Brands.edit', compact('brand','categories','subCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBrand $request, $id)
    {
        // dd($request->all());
        $segment = $request->segment(1);

        $brand = Brand::findOrFail($id);

        $subCategory = $brand->sub_category->slug;

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

        return redirect(route($segment . '.' . 'sub-category-wise-brands.show' ,$subCategory));

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
        $brand = Brand::findOrFail($id);

        $slug = $brand->sub_category->slug;
        
        $imagePath = 'Asset/Uploads/Brands/' . $brand->image;

        if (file_exists($imagePath)) {
@unlink($imagePath);
        }

        $brand->delete();

        return redirect(route($segment . '.' . 'sub-category-wise-brands.show',$slug));
    }
}
