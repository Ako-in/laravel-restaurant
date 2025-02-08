<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShoppingCart;
use App\Models\Menu;
use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menu::all();
        // return view('orders.index', compact('menu'));
        return view('orders.index', ['menus' => $menus]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Menu $menu)
    {
        $menu = Menu::all();
        // dd($menus);
        return view('orders.create', compact('menu'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            // 'id' => 'required|exists:menus,id',
            'menu_id' => 'required',
            'name' => 'required|string',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric',
            'request' => 'nullable|string',
        ]);
        

        // ShoppingCart::create([
        //     'menu_id' => $validated['id'],
        //     'name' => $validated['name'],
        //     'quantity' => $validated['quantity'],
        //     'price' => $validated['price'],
        //     'request' => $validated['request'],
        //     'user_id' => Auth::id(),
        // ]);
        // dd($validated);
        // $shoppingcarts = ShoppingCart::create($validated);
        $shoppingcarts = new ShoppingCart();
        $shoppingcarts->menu_id = $validated['menu_id'];
        $shoppingcarts->quantity = $validated['quantity'];
        $shoppingcarts->price = $validated['price'];
        $shoppingcarts->request = $validated['request'] ?? null;
        $shoppingcarts->user_id = auth()->id();
        $shoppingcarts->save();

        // return redirect()->route('carts.index')->with('success', 'カートに入りました（注文確定していません）');
        
        return to_route('checkouts.index')->with('success', '注文がカートに追加されました！');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $shoppingcarts = ShoppingCart::all();

        // $order_items = ShoppingCart::where('menu_id', $id)->get();
        // $menu = Menu::find($id);
        $menu = Menu::findOrFail($id); // メニュー情報を取得
        // if (!$menu) {
        //     // メニューが存在しない場合は404エラーを返す
        //     abort(404, '指定されたメニューが見つかりません。');
        // }

    
        // dd($ShoppingCarts);

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

    // public function cart()
    // {
    //     $ShoppingCarts = ShoppingCart::with('menu')->get(); // ShoppingCart と Menu を関連付けて取得

    //     $orderTotal = 0;

    //     foreach ($ShoppingCarts as $ShoppingCart) {
    //         $subTotal = $ShoppingCart->menu->price * $ShoppingCart->quantity;
    //         $orderTotal += $subTotal;
    //     }

    //     return view('carts.index', compact('ShoppingCarts', 'orderTotal'));
    // }

    public function checkout(){
        // $menu = Menu::all();
        $shoppingcarts = ShoppingCart::with('menu')->get(); 
        // dd($carts);

        $orderTotal = 0;
        
        // $subTotal = ($carts->menu->price * $carts->quantity);
        foreach ($shoppingcarts as $shoppingcart) {
                    $subTotal = $shoppingcart->menu->price * $shoppingcart->quantity;
                    $orderTotal += $subTotal;
                }
        // 総合計に小計を加算
        // $orderTotal = $subTotal;
        // $orderTotal += $subTotal;
        dd($subTotal);
        dd($orderTotal);

        // 在庫数を確認
        if ($menu->stock < $carts->quantity) {
            return redirect()->back()->withErrors(['error' => 'Insufficient stock for this order.']);
        }

        // 在庫を減少
        $menu->decrement('stock', $carts->quantity);

        return view('checkouts.index', compact('carts', 'orderTotal'));

    }
    
}
