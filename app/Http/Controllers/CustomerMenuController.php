<?php

namespace App\Http\Controllers;
use App\Models\ShoppingCart;
use App\Models\Menu;
use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class CustomerMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menu::all();
        return view('customer.menus.index', compact('menus'));
        // return view('customer.menus.index', ['menus' => $menus]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create(Menu $menu)
    // {
    //     $menu = Menu::all();
    //     // dd($menus);
    //     return view('orders.create', compact('menu'));
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        //メニューの詳細
        // $menus = $menu->get();
     
        // return view('orders.index', compact('menu'));
        $cart = ShoppingCart::where('menu_id', $menu->id)->first();

        return view('customer.menus.show', compact('menu', 'cart'));

        // // ショッピングカート内の商品を取得
        // $shoppingcarts = ShoppingCart::where('menu_id', $id)->get();

        // // 合計金額を計算
        // $orderTotal = $shoppingcarts->sum(function ($cart) {
        //     return $cart->quantity * $cart->menu->price; // 数量 × 単価
        // });

        // // 指定されたメニュー情報を取得
        // $menu = Menu::findOrFail($id);

        // // ビューにデータを渡す
        // return view('carts.index', compact('shoppingcarts', 'menu', 'orderTotal'));

        // $shoppingcarts = ShoppingCart::all();

        // // $order_items = ShoppingCart::where('menu_id', $id)->get();
        // // $menu = Menu::find($id);
        // $menu = Menu::findOrFail($id); // メニュー情報を取得
        // // if (!$menu) {
        // //     // メニューが存在しない場合は404エラーを返す
        // //     abort(404, '指定されたメニューが見つかりません。');
        // // }

    
        // // dd($ShoppingCarts);

        // return view('checkouts.index',compact('shoppingcarts','menu'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
