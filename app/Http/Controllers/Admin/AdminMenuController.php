<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Category;

class AdminMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menu::all();
        return view('admin.menus.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        
        return view('admin.menus.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required',
            'stock' => 'required|integer|min:0',
        ], [
            'category_id.required' => 'Category is required.',
            'name.required' => 'Name is required.',
            'price.required' => 'Price is required.',
            'price.numeric' => 'Price must be a number.',
            'image.required' => 'Image is required.',
            'image.image' => 'The file must be an image.',
            'image.mimes' => 'Image must be in jpeg, png, jpg, gif, or svg format.',
            'image.max' => 'Image size must not exceed 2MB.',
            'stock.required' => 'Stock is required.',
            'stock.integer' => 'Stock must be an integer.',
            'stock.min' => 'Stock must be 0 or more.',
        ]);

         // 画像アップロード
        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('images', 'public'); // publicディスクに保存
        } else {
            return redirect()->back()->withErrors(['image' => 'Image file is required.']);
        }
        // 画像をストレージに保存（publicディスクを使用）
        // if ($request->hasFile('image')) {
        //     $image = $request->file('image');
            
        //     // 画像を保存し、そのパスを取得
        //     $imagePath = $image->store('images', 'public');
        // }

        // 他のデータと一緒に保存（例：名前や説明など）
        Menu::create([
            'image' => $imagePath,  // 保存された画像パスをデータベースに保存
            'category_id' => $request->category_id,
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'status' => $request->status,
            'stock' => $request->stock,
        ]);
        // $menus = new Menu;
        // $menus->category_id = $request->category_id;
        // $menus->name = $request->name;  
        // $menus->price = $request->price;
        // $menus->description = $request->description;
        // $menus->image = $request->image;
        // $menus->status = $request->status;
        // $menus->stock = $request->stock;
        // $menus->save();
        return redirect()->route('admin.menus.index')
            ->with('success', 'Menu created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $menu = Menu::find($id);
        // return view('admin.menus.show', compact('menu'));
        $menu = Menu::find($id);

        if (!$menu) {
            return redirect()->route('admin.menus.index')->with('error', 'Menu not found.');
        }

        return view('admin.menus.show', compact('menu'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $menu = Menu::where('id',$id)->first();
        $categories = Category::all();
        return view('admin.menus.edit', compact('menu','categories'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'price' => 'required',
            'description' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required',
            'stock' => 'required|integer|min:0',
        ], [
            'category_id.required' => 'Category is required.',
            'name.required' => 'Name is required.',
            'price.required' => 'Price is required.',
            'price.numeric' => 'Price must be a number.',
            'image.required' => 'Image is required.',
            'image.image' => 'The file must be an image.',
            'image.mimes' => 'Image must be in jpeg, png, jpg, gif, or svg format.',
            'image.max' => 'Image size must not exceed 2MB.',
            'stock.required' => 'Stock is required.',
            'stock.integer' => 'Stock must be an integer.',
            'stock.min' => 'Stock must be 0 or more.',
        ]);

         // 画像アップロード
        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('images', 'public'); // publicディスクに保存
        } else {
            return redirect()->back()->withErrors(['image' => 'Image file is required.']);
        }
        // 画像をストレージに保存（publicディスクを使用）
        // if ($request->hasFile('image')) {
        //     $image = $request->file('image');
        //リダイレクトさせる
        
        return redirect()->route('admin.menus.show', ['menu' => $id])->with('flash_message', 'メニューを編集しました。');
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
        return to_route('admin.menus.index')->with('flash_message','menuを削除しました。');
    }
}
