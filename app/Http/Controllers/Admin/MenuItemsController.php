<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Department;
use App\DistrictProtocol;
use App\DonorsCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Menu;
use App\MenuCategory;
use App\MenuItem;
use App\NewsCategory;
use App\Page;
use App\SubCategory;
use Illuminate\Support\Facades\DB;

class MenuItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menuItems = MenuItem::orderBy('order', 'ASC')->select('id', 'menu_item_title', 'menu_id', 'url', 'status', 'order')->get();

        return view('Dashboard.Admin.Menu-Items.index', compact('menuItems'));
    }

    // public function menuWiseMenuItems($id)
    // {
    //     $menuItems = Menu::where('id', $id)->with(['menu_items' => function ($menuItems) {
    //         $menuItems->orderBy('order', 'asc');
    //     }])->orderBy('order', 'asc')->firstOrFail();

    //     return view('Dashboard.Admin.Menu-Items.index', compact('menuItems'));
    // }

    public function updateOrder(Request $request)
    {
        $menus = MenuItem::all();

        foreach ($menus as $menu) {
            $menu->timestamps = false; // To disable update_at field updation
            $id = $menu->id;

            foreach ($request->order as $order) {
                if ($order['id'] == $id) {
                    $menu->update(['order' => $order['position']]);
                }
            }
        }

        return $request->order;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $id)
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, MenuItem $menuItem)
    {
        if ($request->type == 'none') {
            $this->validate($request, [
                'menu_id' => 'required|string',
                'menu_item_title' => 'required|string',
                'type' => 'required|string',
                'url' => 'required|string',
                'status' => 'required|boolean',

            ]);
        } elseif ($request->type == 'category') {
            $this->validate($request, [
                'menu_id' => 'required|string',
                'category_id' => 'required|string',
                'menu_item_title' => 'required|string',
                'type' => 'required|string',
                'url' => 'nullable|string',
                'status' => 'required|boolean',

            ]);
        } elseif ($request->type == 'sub-category') {
            $this->validate($request, [
                'menu_id' => 'required|string',
                'sub_category_id' => 'required|string',
                'menu_item_title' => 'required|string',
                'type' => 'required|string',
                'url' => 'nullable|string',
                'status' => 'required|boolean',

            ]);
        } elseif ($request->type == 'page') {
            $this->validate($request, [
                'menu_id' => 'required|string',
                'page_category' => 'required|string',
                'menu_item_title' => 'required|string',
                'type' => 'required|string',
                'url' => 'nullable|string',
                'status' => 'required|boolean',

            ]);
        } elseif ($request->type == 'url') {
            $this->validate($request, [
                'menu_id' => 'required|string',
                'menu_item_title' => 'required|string',
                'type' => 'required|string',
                'url' => 'required|string',
                'status' => 'required|boolean',

            ]);
        } elseif ($request->type == 'route') {
            $this->validate($request, [
                'menu_id' => 'required|string',
                'menu_item_title' => 'required|string',
                'type' => 'required|string',
                'url' => 'required|string',
                'status' => 'required|boolean',

            ]);
        }

        $latestMenuItem = MenuItem::where('menu_id', $request->menu_id)->latest()->get()->first();

        if (!empty($latestMenuItem)) {
            $latest = $latestMenuItem->order;

            $newMenuItemOrder = $latest + 1;
        } else {
            $newMenuItemOrder = 1;
        }

        if ($request->type == "none") {
            $menuItem['menu_item_title'] = $request->menu_item_title;
            $menuItem['menu_id'] = $request->menu_id;
            $menuItem['type'] = $request->type;
            $menuItem['url'] = $request->url;
            $menuItem['order'] = $newMenuItemOrder;
            $menuItem['status'] = $request->status;
        } elseif ($request->type == "category") {
            $category = Category::where('id', $request->category_id)->select(
                'name',
                'slug'
            )->get()->toArray();

            $url = $category[0]['slug'];

            $menuItem['menu_item_title'] = $request->menu_item_title;
            $menuItem['menu_id'] = $request->menu_id;
            $menuItem['type'] = $request->type;
            $menuItem['url'] = $url;
            $menuItem['order'] = $newMenuItemOrder;
            $menuItem['status'] = $request->status;
        } elseif ($request->type == "sub-category") {
            $subCategory = SubCategory::where('id', $request->sub_category_id)->select(
                'name',
                'slug'
            )->get()->toArray();

            $url = $subCategory[0]['slug'];

            $menuItem['menu_item_title'] = $request->menu_item_title;
            $menuItem['menu_id'] = $request->menu_id;
            $menuItem['type'] = $request->type;
            $menuItem['url'] = $url;
            $menuItem['order'] = $newMenuItemOrder;
            $menuItem['status'] = $request->status;
        } elseif ($request->type == "page") {
            $page = Page::where('id', $request->page_category)->select('slug')->get()->toArray();

            $url = $page[0]['slug'];

            $menuItem['menu_item_title'] = $request->menu_item_title;
            $menuItem['menu_id'] = $request->menu_id;
            $menuItem['type'] = $request->type;
            $menuItem['url'] = $url;
            $menuItem['order'] = $newMenuItemOrder;
            $menuItem['status'] = $request->status;
        } elseif ($request->type == "url") {
            $menuItem['menu_item_title'] = $request->menu_item_title;
            $menuItem['menu_id'] = $request->menu_id;
            $menuItem['type'] = $request->type;
            $menuItem['url'] = $request->url;
            $menuItem['order'] = $newMenuItemOrder;
            $menuItem['status'] = $request->status;
        } elseif ($request->type == "route") {
            $menuItem['menu_item_title'] = $request->menu_item_title;
            $menuItem['menu_id'] = $request->menu_id;
            $menuItem['type'] = $request->type;
            $menuItem['url'] = $request->url;
            $menuItem['order'] = $newMenuItemOrder;
            $menuItem['status'] = $request->status;
        }


        $menuItem->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // dd('hi');
        $menuItem = new MenuItem();
        // For getting selected menu category
        $parent = Menu::where('status', 1)->where('id', $id)->firstOrFail();

        $menu = Menu::where('status', 1)->get();

        $existingMenuItems = MenuItem::where('status', 1)->select('url')->get()->toArray();

        $category = Category::whereNotIn('slug', $existingMenuItems)->get();

        $subCategory = SubCategory::whereNotIn('slug', $existingMenuItems)->get();

        $pages = Page::where('status', 1)->get();

        return view('Dashboard/Admin/Menu-Items.create', compact(
            'menuItem',
            'parent',
            'menu',
            'category',
            'subCategory',
            'pages',
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(MenuItem $menuItem)
    {
        // dd('hi');
        $menu = Menu::where('status', 1)->get();

        $category = Category::where('status', 1)->get();

        $subCategory = SubCategory::where('status', 1)->get();

        $pages = Page::where('status', 1)->get();

        return view('Dashboard/Admin/Menu-Items.edit', compact(
            'menuItem',
            'menu',
            'category',
            'subCategory',
            'pages',
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MenuItem $menuItem)
    {
        if ($request->type == 'none') {
            $this->validate($request, [
                'menu_id' => 'required|string',
                'menu_item_title' => 'required|string',
                'type' => 'required|string',
                'url' => 'required|string',
                'status' => 'required|boolean',
            ]);
        } elseif ($request->type == 'category') {
            $this->validate($request, [
                'menu_id' => 'required|string',
                'category_id' => 'required|string',
                'menu_item_title' => 'required|string',
                'type' => 'required|string',
                'url' => 'nullable|string',
                'status' => 'required|boolean',


            ]);
        } elseif ($request->type == 'sub-category') {
            $this->validate($request, [
                'menu_id' => 'required|string',
                'sub_category_id' => 'required|string',
                'menu_item_title' => 'required|string',
                'type' => 'required|string',
                'url' => 'nullable|string',
                'status' => 'required|boolean',


            ]);
        } else if ($request->type == 'page') {
            $this->validate($request, [

                'menu_id' => 'required|string',
                'page_category' => 'required|string',
                'menu_item_title' => 'required|string',
                'type' => 'required|string',
                'url' => 'nullable|string',
                'status' => 'required|boolean',

            ]);
        } else if ($request->type == 'url') {
            $this->validate($request, [

                'menu_id' => 'required|string',
                'menu_item_title' => 'required|string',
                'type' => 'required|string',
                'url' => 'required|string',
                'status' => 'required|boolean',


            ]);
        } else if ($request->type == 'route') {
            $this->validate($request, [
                'menu_id' => 'required|string',
                'menu_item_title' => 'required|string',
                'type' => 'required|string',
                'url' => 'required|string',
                'status' => 'required|boolean',

            ]);
        }

        // dd($request->all());

        $order = $menuItem->order;

        if ($request->type == "none") {
            $menuItem['menu_item_title'] = $request->menu_item_title;
            $menuItem['menu_id'] = $request->menu_id;
            $menuItem['type'] = $request->type;
            $menuItem['url'] = $request->url;
            $menuItem['order'] = $order;
            $menuItem['status'] = $request->status;
        } elseif ($request->type == "category") {
            $category = Category::where('id', $request->category_id)->select(
                'name',
                'slug'
            )->get()->toArray();

            $url = $category[0]['slug'];

            $menuItem['menu_item_title'] = $request->menu_item_title;
            $menuItem['menu_id'] = $request->menu_id;
            $menuItem['type'] = $request->type;
            $menuItem['url'] = $url;
            $menuItem['order'] = $order;
            $menuItem['status'] = $request->status;
        } elseif ($request->type == "sub-category") {
            $subCategory = SubCategory::where('id', $request->sub_category_id)->select(
                'name',
                'slug'
            )->get()->toArray();

            $url = $subCategory[0]['slug'];

            $menuItem['menu_item_title'] = $request->menu_item_title;
            $menuItem['menu_id'] = $request->menu_id;
            $menuItem['type'] = $request->type;
            $menuItem['url'] = $url;
            $menuItem['order'] = $order;
            $menuItem['status'] = $request->status;
        } elseif ($request->type == "page") {
            $page = Page::where('id', $request->page_category)->select('slug')->get()->toArray();

            $url = $page[0]['slug'];

            $menuItem['menu_item_title'] = $request->menu_item_title;
            $menuItem['menu_id'] = $request->menu_id;
            $menuItem['type'] = $request->type;
            $menuItem['url'] = $url;
            $menuItem['order'] = $order;
            $menuItem['status'] = $request->status;
        } elseif ($request->type == "url") {

            $menuItem['menu_item_title'] = $request->menu_item_title;
            $menuItem['menu_id'] = $request->menu_id;
            $menuItem['type'] = $request->type;
            $menuItem['url'] = $request->url;
            $menuItem['order'] = $order;
            $menuItem['status'] = $request->status;
        } elseif ($request->type == "route") {

            $menuItem['menu_item_title'] = $request->menu_item_title;
            $menuItem['menu_id'] = $request->menu_id;
            $menuItem['type'] = $request->type;
            $menuItem['url'] = $request->url;
            $menuItem['order'] = $order;
            $menuItem['status'] = $request->status;
        }

        $menuItem->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(MenuItem $menuItem)
    {
        $menuItem->delete();

        return back();
    }
}
