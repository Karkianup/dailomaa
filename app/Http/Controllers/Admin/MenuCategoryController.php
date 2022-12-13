<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\MenuCategory;
use Illuminate\Http\Request;

class MenuCategoryController extends Controller
{
    public function index()
    {
        $menuCategory = MenuCategory::orderBy('order', 'asc')->select(
            'id',
            'menu_category_name',
            'status',
            'order',
            'created_at'
        )->get();

        return view('Dashboard/Admin/Menu-Category.index', compact('menuCategory'));
    }



    public function updateOrder(Request $request)
    {
        $menusCategory = MenuCategory::all();

        foreach ($menusCategory as $category) {
            $category->timestamps = false; // To disable update_at field updation
            $id = $category->id;

            foreach ($request->order as $order) {
                if ($order['id'] == $id) {
                    $category->update(['order' => $order['position']]);
                }
            }
        }

        return $request->order;

        // return response('Update Successfully.', 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(MenuCategory $menuCategory)
    {
        return view('Dashboard/Admin/Menu-Category.create', compact('menuCategory'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, MenuCategory $menuCategory)
    {
        $this->validate($request, [
            'menu_category_name' => 'string',
            'status' => 'boolean',

        ]);

        $segment = $request->segment(1);

        $latestMenuCategory = MenuCategory::latest()->get()->first();

        if (!empty($latestMenuCategory)) {
            $latest = $latestMenuCategory->order;

            $newMenuOrder = $latest + 1;
        } else {
            $newMenuOrder = 1;
        }


        $menuCategory['menu_category_name'] = $request->menu_category_name;
        $menuCategory['order'] = $newMenuOrder;
        $menuCategory['status'] = $request->status;

        $menuCategory->save();

        return redirect(route($segment . '.' . 'menu-category.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    public function categoryWiseMenus($id)
    {
        $menuCategory = MenuCategory::where('id', $id)->with(
            [
                'menus' => function ($menuCategory) {
                    $menuCategory->orderBy('order', 'asc');
                },
                'menus.menu_items'
            ]
        )->orderBy('order', 'asc')->firstOrFail();

        return view('Dashboard/Admin/Menu.index', compact('menuCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(MenuCategory $menuCategory)
    {
        return view('Dashboard/Admin/Menu-Category.edit', compact('menuCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MenuCategory $menuCategory)
    {
        $this->validate($request, [
            'menu_category_name' => 'required|string',
            'status' => 'required|boolean',

        ]);
        $segment = $request->segment(1);

        $menuCategory->menu_category_name = $request->input('menu_category_name');
        $menuCategory->status = $request->input('status');

        $menuCategory->save();

        return redirect(route($segment . '.' . 'menu-category.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(MenuCategory $menuCategory)
    {
        $menuCategory->delete();

        return back();
    }
}
