<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Menu;
use App\MenuCategory;
use App\NewsCategory;
use App\NewsSubCategory;
use App\Page;
use App\SubCategory;
use App\WritingCategory;
use App\WritingType;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        // $menus = Menu::all();
        $menu = Menu::orderBy('order', 'ASC')->select(
            'id',
            'menu_title',
            'menu_category_id',
            'url',
            'status',
            'order'
        )->get();

        // dd($menu->toArray());
        return view('Dashboard/Admin/Menu.index', compact('menu'));
    }

    public function menuWiseMenuItems($id)
    {
        $menu = Menu::where('id', $id)->with(
            [
                'menu_items' => function ($menu) {
                    $menu->orderBy('order', 'asc');
                },
            ]
        )->orderBy('order', 'asc')->firstOrFail();

        return view('Dashboard/Admin/Menu-Items.index', compact('menu'));
    }

    public function updateOrder(Request $request)
    {
        $menus = Menu::all();

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

        // return response('Update Successfully.', 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Menu $menu)
    {
        // dd($request->all());
        if ($request->type == 'none') {
            $this->validate($request, [

                'menu_category_id' => 'required|string',
                'menu_title' => 'required|string',
                'type' => 'required|string',
                'url' => 'required|string',
                'mega_menu' => 'required|boolean',
                'status' => 'required|boolean',

            ]);
        } elseif ($request->type == 'category') {
            $this->validate($request, [
                'menu_category_id' => 'required|string',
                'category_id' => 'required|string',
                'menu_title' => 'required|string',
                'type' => 'required|string',
                'url' => 'nullable|string',
                'mega_menu' => 'required|boolean',
                'status' => 'required|boolean',

            ]);
        } elseif ($request->type == 'sub-category') {
            $this->validate($request, [
                'menu_category_id' => 'required|string',
                'sub_category_id' => 'required|string',
                'menu_title' => 'required|string',
                'type' => 'required|string',
                'url' => 'nullable|string',
                'mega_menu' => 'required|boolean',
                'status' => 'required|boolean',

            ]);
        } elseif ($request->type == 'page') {
            $this->validate($request, [
                'menu_category_id' => 'required|string',
                'page_category' => 'required|string',
                'menu_title' => 'required|string',
                'type' => 'required|string',
                'url' => 'nullable|string',
                'mega_menu' => 'required|boolean',
                'status' => 'required|boolean',

            ]);
        } elseif ($request->type == 'url') {
            $this->validate($request, [
                'menu_category_id' => 'required|string',
                'menu_title' => 'required|string',
                'type' => 'required|string',
                'url' => 'required|string',
                'mega_menu' => 'required|boolean',
                'status' => 'required|boolean',

            ]);
        } elseif ($request->type == 'route') {
            $this->validate($request, [
                'menu_category_id' => 'required|string',
                'menu_title' => 'required|string',
                'type' => 'required|string',
                'url' => 'required|string',
                'mega_menu' => 'required|boolean',
                'status' => 'required|boolean',

            ]);
        }
        $latestMenu = Menu::where('menu_category_id', $request->menu_category_id)->latest()->get()->first();

        if (!empty($latestMenu)) {
            $latest = $latestMenu->order;

            $newMenuOrder = $latest + 1;
        } else {
            $newMenuOrder = 1;
        }

        if ($request->type == "none") {
            $menu['menu_title'] = $request->menu_title;
            $menu['menu_category_id'] = $request->menu_category_id;
            $menu['type'] = $request->type;
            $menu['url'] = $request->url;
            $menu['mega_menu'] = $request->mega_menu;
            $menu['order'] = $newMenuOrder;
            $menu['status'] = $request->status;
        } elseif ($request->type == "category") {
            $category = Category::where('id', $request->category_id)->select(
                'name',
                'slug'
            )->get()->toArray();

            $url = $category[0]['slug'];

            $menu['menu_title'] = $request->menu_title;
            $menu['menu_category_id'] = $request->menu_category_id;
            $menu['type'] = $request->type;
            $menu['url'] = $url;
            $menu['mega_menu'] = $request->mega_menu;
            $menu['order'] = $newMenuOrder;
            $menu['status'] = $request->status;
        } elseif ($request->type == "sub-category") {
            $subCategory = SubCategory::where('id', $request->sub_category_id)->select(
                'name',
                'slug'
            )->get()->toArray();

            $url = $subCategory[0]['slug'];

            $menu['menu_title'] = $request->menu_title;
            $menu['menu_category_id'] = $request->menu_category_id;
            $menu['type'] = $request->type;
            $menu['url'] = $url;
            $menu['mega_menu'] = $request->mega_menu;
            $menu['order'] = $newMenuOrder;
            $menu['status'] = $request->status;
        } elseif ($request->type == "page") {
            $page = Page::where('id', $request->page_category)->select('slug')->get()->toArray();

            $url = $page[0]['slug'];

            $menu['menu_title'] = $request->menu_title;
            $menu['menu_category_id'] = $request->menu_category_id;
            $menu['mega_menu'] = $request->mega_menu;
            $menu['type'] = $request->type;
            $menu['url'] = $url;
            $menu['order'] = $newMenuOrder;
            $menu['status'] = $request->status;
        } elseif ($request->type == "url") {
            $menu['menu_title'] = $request->menu_title;
            $menu['menu_category_id'] = $request->menu_category_id;
            $menu['type'] = $request->type;
            $menu['url'] = $request->url;
            $menu['mega_menu'] = $request->mega_menu;
            $menu['order'] = $newMenuOrder;
            $menu['status'] = $request->status;
        } elseif ($request->type == "route") {
            $menu['menu_title'] = $request->menu_title;
            $menu['menu_category_id'] = $request->menu_category_id;
            $menu['type'] = $request->type;
            $menu['url'] = $request->url;
            $menu['mega_menu'] = $request->mega_menu;
            $menu['order'] = $newMenuOrder;
            $menu['status'] = $request->status;
        }


        $menu->save();

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $menu = new Menu();
        // For getting selected menu category
        $parent = MenuCategory::where('status', 1)->where('id', $id)->firstOrFail();

        $menuCategory = MenuCategory::where('status', 1)->get();

        $existingMenus = Menu::where('status', 1)->select('url')->get()->toArray();

        $category = Category::whereNotIn('slug', $existingMenus)->get();

        $subCategory = SubCategory::whereNotIn('slug', $existingMenus)->get();

        $pages = Page::where('status', 1)->get();

        return view('Dashboard/Admin/Menu.create', compact(
            'menu',
            'parent',
            'menuCategory',
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
    public function edit(Menu $menu)
    {
        $menuCategory = MenuCategory::where('status', 1)->get();

        $category = Category::where('status', 1)->get();

        $subCategory = SubCategory::where('status', 1)->get();

        $pages = Page::where('status', 1)->get();

        return view('Dashboard/Admin/Menu.edit', compact(
            'menu',
            'menuCategory',
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
    public function update(Request $request, Menu $menu)
    {
        if ($request->type == 'none') {
            $this->validate($request, [
                'menu_category_id' => 'required|string',
                'menu_title' => 'required|string',
                'type' => 'required|string',
                'url' => 'required|string',
                'mega_menu' => 'required|boolean',
                'status' => 'required|boolean',
            ]);
        } elseif ($request->type == 'category') {
            $this->validate($request, [
                'menu_category_id' => 'required|string',
                'category_id' => 'required|string',
                'menu_title' => 'required|string',
                'type' => 'required|string',
                'url' => 'nullable|string',
                'mega_menu' => 'required|boolean',
                'status' => 'required|boolean',


            ]);
        } elseif ($request->type == 'sub-category') {
            $this->validate($request, [
                'menu_category_id' => 'required|string',
                'sub_category_id' => 'required|string',
                'menu_title' => 'required|string',
                'type' => 'required|string',
                'url' => 'nullable|string',
                'mega_menu' => 'required|boolean',
                'status' => 'required|boolean',


            ]);
        } else if ($request->type == 'page') {
            $this->validate($request, [

                'menu_category_id' => 'required|string',
                'page_category' => 'required|string',
                'menu_title' => 'required|string',
                'type' => 'required|string',
                'url' => 'nullable|string',
                'mega_menu' => 'required|boolean',
                'status' => 'required|boolean',

            ]);
        } else if ($request->type == 'url') {
            $this->validate($request, [

                'menu_category_id' => 'required|string',
                'menu_title' => 'required|string',
                'type' => 'required|string',
                'url' => 'required|string',
                'mega_menu' => 'required|boolean',
                'status' => 'required|boolean',


            ]);
        } else if ($request->type == 'route') {
            $this->validate($request, [
                'menu_category_id' => 'required|string',
                'menu_title' => 'required|string',
                'type' => 'required|string',
                'url' => 'required|string',
                'mega_menu' => 'required|boolean',
                'status' => 'required|boolean',

            ]);
        }

        // dd($request->all());

        $order = $menu->order;

        if ($request->type == "none") {
            $menu['menu_title'] = $request->menu_title;
            $menu['menu_category_id'] = $request->menu_category_id;
            $menu['type'] = $request->type;
            $menu['url'] = $request->url;
            $menu['mega_menu'] = $request->mega_menu;
            $menu['order'] = $order;
            $menu['status'] = $request->status;
        } elseif ($request->type == "category") {
            $category = Category::where('id', $request->category_id)->select(
                'name',
                'slug'
            )->get()->toArray();

            $url = $category[0]['slug'];

            $menu['menu_title'] = $request->menu_title;
            $menu['menu_category_id'] = $request->menu_category_id;
            $menu['type'] = $request->type;
            $menu['url'] = $url;
            $menu['mega_menu'] = $request->mega_menu;
            $menu['order'] = $order;
            $menu['status'] = $request->status;
        } elseif ($request->type == "sub-category") {
            $subCategory = SubCategory::where('id', $request->sub_category_id)->select(
                'name',
                'slug'
            )->get()->toArray();

            $url = $subCategory[0]['slug'];

            $menu['menu_title'] = $request->menu_title;
            $menu['menu_category_id'] = $request->menu_category_id;
            $menu['type'] = $request->type;
            $menu['url'] = $url;
            $menu['mega_menu'] = $request->mega_menu;
            $menu['order'] = $order;
            $menu['status'] = $request->status;
        } elseif ($request->type == "page") {
            $page = Page::where('id', $request->page_category)->select('slug')->get()->toArray();

            $url = $page[0]['slug'];

            $menu['menu_title'] = $request->menu_title;
            $menu['menu_category_id'] = $request->menu_category_id;
            $menu['mega_menu'] = $request->mega_menu;
            $menu['type'] = $request->type;
            $menu['url'] = $url;
            $menu['order'] = $order;
            $menu['status'] = $request->status;
        } elseif ($request->type == "url") {

            $menu['menu_title'] = $request->menu_title;
            $menu['menu_category_id'] = $request->menu_category_id;
            $menu['type'] = $request->type;
            $menu['url'] = $request->url;
            $menu['mega_menu'] = $request->mega_menu;
            $menu['order'] = $order;
            $menu['status'] = $request->status;
        } elseif ($request->type == "route") {

            $menu['menu_title'] = $request->menu_title;
            $menu['menu_category_id'] = $request->menu_category_id;
            $menu['type'] = $request->type;
            $menu['url'] = $request->url;
            $menu['mega_menu'] = $request->mega_menu;
            $menu['order'] = $order;
            $menu['status'] = $request->status;
        }

        $menu->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        $menu->delete();

        return back();
    }
}
