<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Advertisement;
use Illuminate\Support\Facades\File;


class AdvertisementController extends Controller
{
    public function index()
    {
        $advertisements=Advertisement::all();
        return view('Dashboard.Admin.advertisement.index',compact('advertisements'));
    }
    public function create()
    {
        return view('Dashboard.Admin.advertisement.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            "url"=>"required",
            "title"=>"required|max:60",
        ]);
       $advertisement=Advertisement::create($request->all());
        if($request->hasFile('url'))
        {
            if($request->file('url')){
                $file= $request->file('url');
                $filename= date('YmdHi').$file->getClientOriginalName();
                $file-> move(public_path('Asset/Uploads/advertisements'), $filename);
                $advertisement->url= $filename;
                $advertisement->save();
            }

        }
        return redirect()->route('admin.advertisement.index')->withMessage('SuccessFull');
    }

    public function edit(Advertisement $advertisement)
    {
        return view('Dashboard.Admin.advertisement.edit',compact('advertisement'));

    }
    public function update(Request $request,Advertisement $advertisement)
    {
        if($request->hasFile('url'))
        {
            $destination='Asset/Uploads/advertisements'.$advertisement->url;
            if(File::exists($destination))
            {
                File::delete($destination);
            }
        }
            $advertisement->update($request->all());
            if($request->file('url')){
                $file= $request->file('url');
                $filename= date('YmdHi').$file->getClientOriginalName();
                $file-> move(public_path('Asset/Uploads/advertisements'), $filename);
                $advertisement->url= $filename;
                $advertisement->save();
            }
        return redirect()->route('admin.advertisement.index')->withMessage('SuccessFull');

    }
    public function destroy(Advertisement $advertisement)
    {
        $advertisement->delete();
        return redirect()->back();
    }

}