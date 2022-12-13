<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Map;
class MapController extends Controller
{
    public function edit()
    {
        return view('Dashboard.Admin.Map.edit',[
            "map"=>Map::first(),
        ]);
    }
    public function update(Request $request)
    {
        $map=Map::first();
        $map->update($request->all());
        return redirect()->back()->withMessage('Successfully Updated');
    }
}