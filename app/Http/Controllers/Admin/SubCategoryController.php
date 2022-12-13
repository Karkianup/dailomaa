<?php

namespace App\Http\Controllers\Admin;

use App\Brand;
use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CreateSubCategory;
use App\Http\Requests\Category\UpdateSubCategory;
use App\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function index()
    {
        $subCategories = SubCategory::with('category')->with('brands')->get();

        return view('Dashboard.Admin.Sub-Category.index', compact('subCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(SubCategory $subCategory)
    {
        $categories = Category::select('id','name')->get();

        return view('Dashboard.Admin.Sub-Category.create', compact('subCategory','categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateSubCategory $request, SubCategory $subCategory)
    {
        // dd($request->all());
        $segment = $request->segment(1);

        $subCategory['name'] = $request->name;
        $subCategory['is_featured'] = $request->has('on')? 1 : 0;
        $subCategory['description'] = $request->description;
        $subCategory['category_id'] = $request->category_id;
        $subCategory['status'] = $request->status;

        if ($request->hasFile('image')) {
            $subCategory['image'] = uniqid() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move('Asset/Uploads/Sub-Categories', $subCategory['image']);
        }

        $subCategory->save();

        return redirect(route($segment . '.' . 'sub-category.index'));
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
    public function edit(SubCategory $subCategory)
    {
        $categories = Category::select('id','name')->get();
        return view('Dashboard.Admin.Sub-Category.edit', compact('subCategory','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSubCategory $request, SubCategory $subCategory)
    {
        // dd($request->all());
        $segment = $request->segment(1);

        $subCategory->name = $request->input('name');
        $subCategory->is_featured = $request->input('is_featured');
        $subCategory->description = $request->input('description');
        $subCategory->category_id = $request->input('category_id');
        $subCategory->status = $request->input('status');

        if ($request->hasFile('image')) {

            $existingImage = 'Asset/Uploads/Sub-Categories/' . $subCategory->image;

            if (file_exists($existingImage)) {
@unlink($existingImage);
            }

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileName = uniqid() . '.' . $extension;
            $file->move('Asset/Uploads/Sub-Categories/', $fileName);
            $subCategory->image = $fileName;
        }

        $subCategory->save();

        return redirect(route($segment . '.' . 'sub-category.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, SubCategory $subCategory)
    {
        $segment = $request->segment(1);
        $imagePath = 'Asset/Uploads/Sub-Categories/' . $subCategory->image;

        if (file_exists($imagePath)) {
@unlink($imagePath);
        }

        $subCategory->delete();

        return redirect(route($segment . '.' . 'subcategory.index'));
    }
}
