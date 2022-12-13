<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Advertisement1;
use Illuminate\Support\Facades\File;

class Advertisement1Controller extends Controller
{
    public function index()
    {
        $advertisements=Advertisement1::all();
        return view('Dashboard.Admin.advertisement1.index',compact('advertisements'));
    }
    public function create()
    {
        return view('Dashboard.Admin.advertisement1.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            "url"=>"required",
            "title"=>"required|max:60",
        ]);
       $advertisement=Advertisement1::create($request->all());
        if($request->hasFile('url'))
        {
            if($request->file('url')){
                $file= $request->file('url');
                $filename= date('YmdHi').$file->getClientOriginalName();
                $file-> move(public_path('Asset/Uploads/advertisements1'), $filename);
                $advertisement->url= $filename;
                $advertisement->save();
            }
        }
        return redirect()->route('admin.advertisement1.index')->withMessage('SuccessFull');
    }
    public function edit(Advertisement1 $advertisement)
    {
        return view('Dashboard.Admin.advertisement1.edit',compact('advertisement'));
    }

    public function update(Request $request,Advertisement1 $advertisement)
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
                $file-> move(public_path('Asset/Uploads/advertisements1'), $filename);
                $advertisement->url= $filename;
                $advertisement->save();
            }
        return redirect()->route('admin.advertisement1.index')->withMessage('SuccessFull');
    }
    public function destroy(Advertisement1 $advertisement)
    {
        $advertisement->delete();
        return redirect()->back();
    }
}