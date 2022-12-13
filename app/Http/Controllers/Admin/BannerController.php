<?php

namespace App\Http\Controllers\Admin;

use App\Banner;
use App\Http\Controllers\Controller;
use App\Http\Requests\Banner\CreateBanner;
use App\Http\Requests\Banner\UpdateBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Image;


class BannerController extends Controller
{
    public function index()
    {
        $banner = Banner::latest()
            ->get();

        return view('Dashboard.Admin.Banner.index', compact('banner'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Banner $banner)
    {
        return view('Dashboard.Admin.Banner.create', compact('banner'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateBanner $request, Banner $banner)
    {
        $banner['title'] = $request->title;
        $banner['description'] = $request->description;
        $banner['url'] = $request->url;
        $banner['status'] = $request->status;

        if ($request->hasFile('image')) {
            $path = 'Asset/Uploads/Banner/';
            $image = $request->file('image');
            $defaultImage = uniqid() . '-' . "1540x532" . '.' . $image->getClientOriginalExtension();

            Image::make($image)->resize(1540,5432, function ($constraint) {
                $constraint->aspectRatio();
            })->resizeCanvas(1540,5432)
                ->save($path . $defaultImage);

            $banner['image'] = $defaultImage;
        }


        $banner->save();

        return redirect(route('banner.index'));
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
    public function edit(Banner $banner)
    {
        return view('Dashboard.Admin.Banner.edit', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBanner $request, Banner $banner)
    {
        $banner->title = $request->input('title');
        $banner->description = $request->input('description');
        $banner->url = $request->input('url');
        $banner->status = $request->input('status');

        if ($request->hasFile('image')) {

            $existingImage = 'Asset/Uploads/Banner/' . $banner->image;

            if (file_exists($existingImage)) {
                @unlink($existingImage);
            }

            $originalImage = $request->file('image');
            $extension = $originalImage->getClientOriginalExtension();

            $defaultImage = Image::make($originalImage);

            $originalPath = 'Asset/Uploads/Banner/';

            $originalImageName = uniqid() . '-' . "1540x532";

            $defaultImage->resize(1540,532, function ($constraint) {
                $constraint->aspectRatio();
            })->resizeCanvas(1540,532)
                ->save($originalPath . $originalImageName . '.' . $extension);


            $originalImageName = $originalImageName . '.' . $extension;

            $banner->image = $originalImageName;
        }

        $banner->save();

        return redirect(route('banner.index'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $banner = Banner::findOrFail($id);
        $imagePath = 'Asset/Uploads/Banner/' . $banner->image;

        if (file_exists($imagePath)) {
            @unlink($imagePath);
        }

        $banner->delete();

        return redirect(route('banner.index'));
    }
}
