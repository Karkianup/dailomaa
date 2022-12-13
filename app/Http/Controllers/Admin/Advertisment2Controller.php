<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Advertisement2;
use Illuminate\Support\Facades\File;

class Advertisment2Controller extends Controller
{
    public function index()
    {
        $advertisements=Advertisement2::all();
        $advertisementCount=Advertisement2::count();
        return view('Dashboard.Admin.advertisement2.index',compact('advertisements','advertisementCount'));
    }
    public function create()
    {
        return view('Dashboard.Admin.advertisement2.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            "url"=>"required",
            "title"=>"required|max:60",
        ]);
       $advertisement=Advertisement2::create($request->all());
        if($request->hasFile('url'))
        {
            if($request->file('url')){
                $file= $request->file('url');
                $filename= date('YmdHi').$file->getClientOriginalName();
                $file-> move(public_path('Asset/Uploads/advertisements2'), $filename);
                $advertisement->url= $filename;
                $advertisement->save();
            }
        }
        return redirect()->route('admin.advertisement2.index')->withMessage('SuccessFull');
    }
    public function edit(Advertisement2 $advertisement)
    {
        return view('Dashboard.Admin.advertisement2.edit',compact('advertisement'));
    }

    public function update(Request $request,Advertisement2 $advertisement)
    {
        if($request->hasFile('url'))
        {
            $destination='Asset/Uploads/advertisements1'.$advertisement->url;
            if(File::exists($destination))
            {
                File::delete($destination);
            }
        }
            $advertisement->update($request->all());
            if($request->file('url')){
                $file= $request->file('url');
                $filename= date('YmdHi').$file->getClientOriginalName();
                $file-> move(public_path('Asset/Uploads/advertisements2'), $filename);
                $advertisement->url= $filename;
                $advertisement->save();
            }
        return redirect()->route('admin.advertisement2.index')->withMessage('SuccessFull');
    }
    public function destroy(Advertisement2 $advertisement)
    {
        $advertisement->delete();
        return redirect()->back();
    }
}