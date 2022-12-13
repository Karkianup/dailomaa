<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Page\CreatePage;
use App\Http\Requests\Page\UpdatePage;
use App\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Image;

class PageController extends Controller
{
    public function index()
    {
        $page = Page::latest()
            ->get();

        return view('Dashboard.Admin.Page.index', compact('page'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Page $page)
    {
        return view('Dashboard.Admin.Page.create', compact('page'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePage $request, Page $page)
    {
        $segment = $request->segment(1);

        $page['title'] = $request->title;
        $page['content'] = $request->content;
        $page['status'] = $request->status;


        if ($request->hasFile('image')) {
            $originalImage = $request->file('image');
            $extension = $originalImage->getClientOriginalExtension();

            $defaultImage = Image::make($originalImage);

            $originalPath = 'Asset/Uploads/Page/';

            $originalImageName = uniqid() . '-' . "1160x455";

            // $defaultImage->resize(1160, 455);

            $defaultImage->resize(1160, 455, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            
            $defaultImage->save($originalPath . $originalImageName . '.' . $extension);

            $originalImageName = $originalImageName . '.' . $extension;

            $page['image'] = $originalImageName;
        }

        $page->save();

        return redirect(route($segment . '.' . 'page.index'));
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
    public function edit(Page $page)
    {
        return view('Dashboard.Admin.Page.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePage $request, Page $page)
    {
        // dd($request->all());
        $segment = $request->segment(1);

        $page->title = $request->input('title');
        $page->content = $request->input('content');
        $page->status = $request->input('status');
 

        if ($request->hasFile('image')) {

            $existingImage = 'Asset/Uploads/Page/' . $page->image;

            if (file_exists($existingImage)) {
@unlink($existingImage);
            }

            $originalImage = $request->file('image');
            $extension = $originalImage->getClientOriginalExtension();

            $defaultImage = Image::make($originalImage);

            $originalPath = 'Asset/Uploads/Page/';

            $originalImageName = uniqid() . '-' . "1160x455";

            // $defaultImage->resize(1160, 455);

            $defaultImage->resize(1160, 455, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            $defaultImage->save($originalPath . $originalImageName . '.' . $extension);

            $originalImageName = $originalImageName . '.' . $extension;

            $page->image = $originalImageName;
        }
        $page->save();

        return redirect(route($segment . '.' . 'page.index'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Page $page)
    {
        $segment = $request->segment(1);
        $imagePath = 'Asset/Uploads/Page/' . $page->image;

        if (file_exists($imagePath)) {
            @unlink($imagePath);
        }

        $page->delete();

        return redirect(route($segment . '.' . 'page.index'));
    }
}
