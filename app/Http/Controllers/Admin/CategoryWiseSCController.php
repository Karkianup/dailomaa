<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CreateSubCategory;
use App\Http\Requests\Category\UpdateSubCategory;
use App\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryWiseSCController extends Controller
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
    public function create(SubCategory $subCategory, $slug)
    {
        // dd($slug);
        $newCategory = Category::where('slug',$slug)->firstOrFail()->toArray();

        // dd($newCategory['id']);
        $categories = Category::select('id','name')->get();

        return view('Dashboard.Admin.Category-Wise-SC.create', compact('newCategory','categories','subCategory'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateSubCategory $request, SubCategory $subCategory)
    {
        $segment = $request->segment(1);

        $subCategory['name'] = $request->name;
        $subCategory['is_featured'] = $request->has('on')? 1 : 0;
        $subCategory['category_id'] = $request->category_id;
        $subCategory['description'] = $request->description;
        $subCategory['status'] = $request->status;

        $imageName = Str::slug($request->name);

        $category = Category::where('id',$request->category_id)->get()->toArray();

        $slug = $category[0]['slug'];

        if ($request->hasFile('image')) {
            $subCategory['image'] = $imageName . '.' . $request->image->getClientOriginalExtension();
            $request->image->move('Asset/Uploads/Sub-Categories', $subCategory['image']);
        }

        $subCategory->save();

        return redirect(route($segment . '.' . 'category-wise-sub-category.show', $slug));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $category = Category::where('slug', $slug)->get()->toArray();
        $subCategories = SubCategory::where('category_id', $category[0]['id'])->with('category')->get();

        return view('Dashboard.Admin.Category-Wise-SC.index', compact('subCategories','category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subCategory = SubCategory::findOrFail($id);
        $categories = Category::select('id','name')->get();
        return view('Dashboard.Admin.Category-Wise-SC.edit', compact('subCategory','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSubCategory $request, $id)
    {
        // dd($request->all());
        $segment = $request->segment(1);

        $subCategory = SubCategory::findOrFail($id);

        $category = $subCategory->category->slug;

        $subCategory->name = $request->input('name');
        $subCategory->is_featured = $request->input('is_featured');
        $subCategory->category_id = $request->input('category_id');
        $subCategory->status = $request->input('status');

        $name = $request->input('name');

        if ($request->hasFile('image')) {

            $imageName = Str::slug($name);

            $existingImage = 'Asset/Uploads/Sub-Categories/' . $subCategory->image;

            if (file_exists($existingImage)) {
@unlink($existingImage);
            }

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileName = $imageName . '.' . $extension;
            $file->move('Asset/Uploads/Sub-Categories/', $fileName);
            $subCategory->image = $fileName;
        }

        $subCategory->save();

        return redirect(route($segment . '.' . 'category-wise-sub-category.show' ,$category));

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
        $subCategory = SubCategory::findOrFail($id);

        $slug = $subCategory->category->slug;
        
        $imagePath = 'Asset/Uploads/Sub-Categories/' . $subCategory->image;

        if (file_exists($imagePath)) {
@unlink($imagePath);
        }

        $subCategory->delete();

        return redirect(route($segment . '.' . 'category-wise-sub-category.show',$slug));
    }
}
