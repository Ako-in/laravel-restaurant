<?php

namespace App\Http\Controllers;

use App\Models\ShoppingCart;
use App\Models\Menu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\DB;
use Stripe\Stripe;
use Stripe\Checkout\Session;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        //カートの中身を表示
        // dd('checkout.index表示テスト');//表示確認済
        $carts = ShoppingCart::with('menu')->where('user_id', Auth::id())->get(); 

        // dd($carts);//表示確認済 
        $orderTotal = 0;

        foreach ($carts as $cart) {
            if (isset($cart->menu)) { // menu が存在する場合のみ
                $subTotal = $cart->menu->price * $cart->qty;
                $orderTotal += $subTotal;
            }
        }
        // dd($cart->qty);
        // dd($subTotal);

        return view('checkouts.index', compact('carts', 'orderTotal','subTotal'));
    }

    public function store(Request $request)
    {
        // // Stripe APIに支払い情報を送信し、Stripeの決済ページにリダイレクトさせる。
        // $carts = ShoppingCart::with('menu')->where('user_id', Auth::id())->get();
        // $orderTotal = 0;

        // foreach ($carts as $cart) {
        //     if (isset($cart->menu)) {
        //         $orderTotal += $cart->menu->price * $cart->quantity;
        //     }
        // }

        // if ($orderTotal <= 0) {
        //     return redirect()->route('checkouts.index')->withErrors('カートが空です。購入する商品を選択してください。');
        // }

        // Stripe::setApiKey(env('STRIPE_SECRET'));

        // $lineItems = [];

        // foreach ($carts as $cart) {
        //     if (isset($cart->menu)) {
        //         $lineItems[] = [
        //             'price_data' => [
        //                 'currency' => 'jpy',
        //                 'product_data' => [
        //                     'name' => $cart->menu->name,
        //                 ],
        //                 'unit_amount' => $cart->menu->price * 100, // Stripeでは金額は最小単位（円の場合は100分の1）で扱います
        //             ],
        //             'quantity' => $cart->quantity,
        //         ];
        //     }
        // }

        // $session = Session::create([
        //     'payment_method_types' => ['card'],
        //     'line_items' => $lineItems,
        //     'mode' => 'payment',
        //     'success_url' => route('checkouts.success'),
        //     'cancel_url' => route('checkouts.index'),
        // ]);

        // return redirect($session->url);



        // Stripe APIに支払い情報を送信し、Stripeの決済ページにリダイレクトさせる。
        // $carts = ShoppingCart::with('menu')->get();
        // $carts = ShoppingCart::with('menu')->where('user_id', Auth::id())->get();
        // $orderTotal = 0;

        // Stripe::setApiKey(env('STRIPE_SECRET'));
        // $line_items = [];

        // foreach ($carts as $cart) {
        //     $line_items[] = [
        //         'price_data' => [
        //             'currency' => 'jpy',
        //             'product_data' => [
        //                 'name' => $cart->menu->name,
        //                 'images' => [$cart->menu->image],
        //             ],
        //             'unit_amount' => $cart->menu->price,
        //         ],
        //         'quantity' => $cart->quantity,
        //     ];

        //     $orderTotal += $cart->price * $cart->quantity;

        //     $checkout_session = Session::create([
        //         'payment_method_types' => ['card'],
        //         'line_items' => $line_items,
        //         'mode' => 'payment',
        //         'success_url' => route('checkouts.success'),
        //         'cancel_url' => route('checkouts.index'),
        //     ]);

        //     return redirect($checkout_session->url);
        // }
    }

    public function success()
    {
        //決済完了後の案内ページを表示
        $carts = DB::table('shoppingcart')->get();
        // $number = DB::table('shoppingcart')->where('instance',Auth::user()->id)->count();

        // $count = $user_carts->count();
        // $count+= 1;
        // $number+= 1;
        $cart = Cart::instance(Auth::user()->id)->content();
        $total = 0;
        // Cart::instance(Auth::user()->id)->store($count);
        Cart::instance(Auth::user()->id)->store($cart);
        DB::table('shoppingcart')->where('instance',Auth::user()->id)
            ->where('number',null)
            ->update(
                [
                    'code'=>substr(str_shuffle('1234567890abcdefghijklmnopqrstuvwxyz'),0,10),
                    // 'number'=>$number,
                    'price_total'=>$total,
                    'quantity'=>$quantity,
                    // 'buy_flag'=>true,
                    'updated_at'=>date("Y/m/d H:i:s")
                ]
            );

        Cart::instance(Auth::user()->id)->destroy();//カートを空にする

        return view('checkouts.success');
    }
}
