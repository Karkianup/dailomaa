<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CreateCategory;
use App\Http\Requests\Category\UpdateCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with('sub_categories')->get();

        return view('Dashboard.Admin.Category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Category $category)
    {
        return view('Dashboard.Admin.Category.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCategory $request, Category $category)
    {
        // dd($request->all());
        $segment = $request->segment(1);

        $category['name'] = $request->name;
        $category['is_featured'] = $request->has('on')? 1 : 0;
        $category['description'] = $request->description;
        $category['status'] = $request->status;

        if ($request->hasFile('image')) {
            $category['image'] = uniqid() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move('Asset/Uploads/Categories', $category['image']);
        }

        $category->save();

        return redirect(route($segment . '.' . 'category.index'));
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
    public function edit(Category $category)
    {
        return view('Dashboard.Admin.Category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategory $request, Category $category)
    {
        // dd($request->all());
        $segment = $request->segment(1);

        $category->name = $request->input('name');
        $category->is_featured = $request->input('is_featured');
        $category->description = $request->input('description');
        $category->status = $request->input('status');

        if ($request->hasFile('image')) {

            $existingImage = 'Asset/Uploads/Categories/' . $category->image;

            if (file_exists($existingImage)) {
                @unlink($existingImage);
            }

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileName = uniqid() . '.' . $extension;
            $file->move('Asset/Uploads/Categories/', $fileName);
            $category->image = $fileName;
        }

        $category->save();

        return redirect(route($segment . '.' . 'category.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Category $category)
    {
        $segment = $request->segment(1);
        $imagePath = 'Asset/Uploads/Categories/' . $category->image;

        if (file_exists($imagePath)) {
@unlink($imagePath);
        }

        $category->delete();

        return redirect(route($segment . '.' . 'category.index'));
    }



    public function destroyCategory(Request $request, Category $category)
    {
        $segment = $request->segment(1);
        $imagePath = 'Asset/Uploads/Categories/' . $category->image;

        if (file_exists($imagePath)) {
@unlink($imagePath);
        }

        $category->delete();

        return redirect(route($segment . '.' . 'category.index'));
    }
}