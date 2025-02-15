<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShoppingCart;
use App\Models\Menu;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Database\PDO\MySqlDriver;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(Auth::user());//ok
        

        // $total = 0;
        // $subTotal=0;

        // foreach ($cart as $menu) {
        //     $subTotal += $menu->qty * $menu->price;
        // }
        // $total += $subTotal;

        // Log::info('Total Price:', ['subTotal' => $subTotal, 'total' => $total]);

        //カートの中身を表示
        // $cart = Cart::content();
        $cart = Cart::instance(Auth::user()->id)->content();
        // dd(Auth::user()->id);
        $subTotal = Cart::subtotal();
        $total = Cart::total();
        // dd(Cart::content());

        return view('carts.index', compact('cart', 'total','subTotal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // if (!Auth::check()) {
        //     return redirect()->route('login')->with('error', 'ログインしてください');
        // }
        //カートに商品を追加する
        $request->validate([
            // 'id' => 'required|integer',
            // 'name' => 'required|string',
            'qty' => 'required|integer|min:1',
            // 'price' => 'required|numeric|min:0',
            'request' => 'nullable|string',
        ]);

        // dd('カートテストstore');    

        Cart::instance(Auth::user()->id)->add(
        // Cart::add(
            [
                'id' => $request->id, 
                'name' => $request->name, 
                'qty' => $request->qty, 
                'price' => $request->price, 
                'weight' => 0, // 必ずデフォルト値を指定
                'options' => [
                    // 'request' => $request->request,
                    'image' => $request->image,
                    'table_number' => 1,//仮で1を入れている
                ],
            ] 
        );

        // dd(Cart::content()); // カートの中身を確認

        return redirect()->route('carts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // dd(Auth::user()->id);
        //カートの中身を表示
        // $cart = Cart::instance(Auth::user()->id)->get($id);
        $cart = Cart::instance(Auth::user()->id)->content();

        // 特定の rowId を取得
        // $rowId = 'your_row_id';  // 実際の rowId に置き換えてください
        $item = $cart->firstWhere('id', $id);

        // アイテムが見つかった場合に表示
        if ($item) {
            return view('carts.show', compact('item'));
        } else {
            // アイテムが見つからない場合
            return redirect()->route('carts.index')->with('error', '指定された商品がカートに存在しません。');
        }
        // return view('carts.show', compact('cart'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        //カートの中身を編集
        $cart = Cart::instance(Auth::user()->id)->content();

        logger($cart); // カート内の全データをログに出力

        $item = $cart->firstWhere('id', $id); // 指定されたIDのアイテムを取得
        // dd($item);
        // 指定されたIDのアイテムがカート内にあるか確認
        // if (!$cart->search(fn($cartItem) => $cartItem->rowId === $id)->isNotEmpty()) {
        //     return redirect()->route('carts.index')->with('error', '指定された商品がカートに存在しません。');
        // }

        if (!$item) {
            return redirect()->route('carts.index')->with('error', '指定された商品がカートに存在しません。');
        }

        // $item = $cart->get($id); 
        return view('carts.edit', compact('cart','item'));
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
        //カートの中身を更新
        $request->validate([
            'qty' => 'required|integer|min:1',
            // 'request' => 'nullable|string',
        ]);
        //カート内の全アイテムを取得
        $cart = Cart::instance(Auth::user()->id)->content();

        Cart::instance(Auth::user()->id)->update($id, $request->qty);
        return redirect()->route('carts.index')->with('success', 'カートを更新しました。');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //カートの中身を削除
        Cart::instance(Auth::user()->id)->remove($request->id);
        return redirect()->route('carts.index');
    }

    public function add(Request $request)
    {
        // Log::info('カートに追加リクエスト１',$request->all()); //log ok

        $request->validate([
            'id' => 'required|integer',
            'name' => 'required|string',
            'qty' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            // 'image' => 'required|string',
            // 'table_number' => 'required|integer|min:1',
        ]);

        Log::info('バリデーション通過,カート追加する前');//log ok

        Log::info('addの前',$request->all());
        // dd($request->all());
        Cart::instance(Auth::user()->id)->add([
            'id' => $request->id, 
            'name' => $request->name, 
            'qty' => $request->qty, 
            'price' => $request->price, //税込を想定 config/cart.php taxで税率変更できる。今は０としている。
            'weight' => 0, // 必ずデフォルト値を指定
            'options' => [
                // 'request' => $request->request,
                'image' => $request->image,
                'table_number' => 1,
            ],
            // 'subTotal' => $request->price, 
            // 'total' => $request->qty * $request->price,
        ]);
        // dd(Cart::content());

        // dd($request->image);
        Log::info('addの後ろ',$request->all());
        // Cart::add([
        //     'id' => 2, 
        //     'name' => 'ホットカフェラテ', 
        //     'qty' => 2, 
        //     'price' => 450, 
        //     'weight' => 0, // 必ずデフォルト値を指定
        // ]);

        Log::info('カートに追加した後',$request->all()); //log ok
        // dd(Cart::content());//違うメニューも追加されているような気がする
        // return redirect()->back()->with('success', 'カートに入りました。');
        return redirect()->route('carts.index')->with('success', '商品をカートに追加しました！');
        // session()->flash('success', '商品をカートに追加しました！');
        // dd(session()->all());
    }

    public function success(){
        //購入完了画面
        // dd(Auth::user());//ok
        Log::info('successメソッドが通る');
        // dd('successメソッドが通る');//ok
        $carts = Cart::instance(Auth::user()->id)->content();
        
        // dd($instance->content);
        $orderTotal = 0;
        foreach ($carts as $cart) {
            $orderTotal += $cart->qty * $cart->price;
        }
        if ($carts->isEmpty()) {
            return redirect()->route('carts.index')->with('error', 'カートが空です。');
        }
        // dd('orderTotal');//NG
        // dd($orderTotal);
        //購入処理
        foreach($carts as $cart){
            ShoppingCart::create([
                'identifier' => Str::uuid(),
                'user_id' => Auth::user()->id,
                'menu_id' => $cart->id,
                'qty' => $cart->qty,
                'price' => $cart->price,
                'total' => $cart->qty * $cart->price,
                'table_number' => 1,//仮で1を入れている
                'status' => 1,
                'instance' => 'default_instance',
                'content' => $cart->name,
                'code' => uniqid(),
            ]);
        }

        // $shoppingCart = new ShoppingCart();

        // $shoppingCart->identifier = Str::uuid(); // UUIDを使用、ユニーク制約、重複を防ぐ
        // $shoppingCart->user_id = Auth::user()->id;
        // $shoppingCart->menu_id = $cart->id;
        // // $shoppingCart->instance = Auth::user()->id;//menu name
        // $shoppingCart->qty = $cart->quantity ?? 1; // デフォルト値を 1 に設定
        // $shoppingCart->price = $cart->price;
        
        // $shoppingCart->total = $orderTotal;
        // $shoppingCart->table_number = 1;//仮で1を入れている
        // $shoppingCart->status = 1;
        // // $shoppingCart->identifier = $cart->id;//必要？

        // $shoppingCart->instance = 'default_instance';//必要？
        // // 一意な識別子を生成
        
        // $shoppingCart->content = $cart->name;

        // // $shoppingCart->request = is_object($cart->options->request) || is_array($cart->options->request)
        // // ? json_encode($cart->options->request) // オブジェクトや配列を JSON 文字列に変換
        // // : $cart->options->request; // それ以外はそのまま

        // $shoppingCart->code = uniqid(); // uniqidで一意なコードを生成。不要のためあとでカラムを削除
        // // $shoppingCart->code = $cart->id; // メニューIDをコードとして使用
        // $shoppingCart->save();
        
        // foreach ($carts as $cart) {
        //     $shoppingCart->update([
        //         'id' => $cart->id,
        //         // 'quantity' => $cart->quantity,
        //         'qty' => $cart->quantity ?? 1, // デフォルト値を 1 に設定
        //         'price' => $cart->price, 
        //         'total' => ($cart->quantity ?? 1) * $cart->price,
        //         // 'identifier' => $cart->id,//updateに必要なし？
        //         // 'request' => $cart->options->request ?? null]);
        //         // 'request' => is_object($cart->options->request) || is_array($cart->options->request)
        //         // ? json_encode($cart->options->request) // オブジェクトや配列を JSON 文字列に変換
        //         // : $cart->options->request // それ以外はそのまま

        //         // 'request' => $cart->options->request,//requestは今はクローズしているのでコメントアウト
        //         'instance' => 'default_instance',//必要？
        //     ]);
        // }
        Cart::instance(Auth::user()->id)->destroy();//カートを空にする
        // 成功メッセージと注文内容を渡してビューを返す
        return view('carts.success', [
            'message' => '注文が確定しました',
            // 'shoppingCart' => $shoppingCart,
            'shoppingCart'=>$carts,
        ]);
    }
    
    
    // public function history_index()
    // {
    //     //購入履歴を表示
    //     $carts = ShoppingCart::where('user_id', Auth::user()->id)->where('status', 1)->get();
    //     $orderTotal = 0;
    //     foreach ($carts as $cart) {
    //         $orderTotal += $cart->total;
    //     }
    //     return view('carts.history_index', compact('carts','orderTotal'));
    // }

    // public function order(){
    //     //購入履歴確認画面と購入処理
    //     $carts = ShoppingCart::where('user_id', Auth::user()->id)->where('status', 0)->get();
    //     $orderTotal = 0;
    //     foreach ($carts as $cart) {
    //         $orderTotal += $cart->total;
    //     }
    //     return view('checkouts.index', compact('carts','orderTotal'));
    // }


}
