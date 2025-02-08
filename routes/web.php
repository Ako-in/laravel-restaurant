<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AdminMenuController;
use App\Http\Controllers\Admin\OrderController;

// use App\Http\Controllers\OrderController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomerMenuController;
use App\Http\Controllers\Admin;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', function () {
    return view('customer.menus.index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//Authハズじたら通る。ログインしていないときに通る
// Route::prefix('customer')->name('customer.')->group(function () {
//     Route::resource('menus', CustomerMenuController::class)->names([
//         'index' => 'menus.index',
//         'create' => 'menus.create',
//         'store' => 'menus.store',
//         'show' => 'menus.show',
//         'edit' => 'menus.edit',
//         'update' => 'menus.update',
//         'destroy' => 'menus.destroy',
//     ]);
// });
// Route::resource('carts', CartController::class);
// Route::group(['middleware'=>['web']], function(){
//     Route::get('carts', [CartController::class, 'index'])->name('carts.index');
//     Route::post('carts/add', [CartController::class, 'add'])->name('carts.add');
//     Route::post('carts/order', [CartController::class, 'order'])->name('carts.order');
//     Route::post('carts/success', [CartController::class, 'success'])->name('carts.success');
// });
// Route::get('carts', [CartController::class, 'index'])->name('carts.index');
// Route::post('carts/add', [CartController::class, 'add'])->name('carts.add');
// Route::post('carts/order', [CartController::class, 'order'])->name('carts.order');
// Route::post('carts/success', [CartController::class, 'success'])->name('carts.success');

Route::controller(CheckoutController::class)->group(function () {
    Route::get('checkouts', 'index')->name('checkouts.index');
    Route::post('checkouts', 'store')->name('checkouts.store');
    Route::get('checkouts/success', 'success')->name('checkouts.success');
});

Route::middleware('auth:user')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('carts', CartController::class);
    Route::post('carts/add', [CartController::class, 'add'])->name('carts.add');
    Route::post('carts/order', [CartController::class, 'order'])->name('carts.order');
    Route::post('carts/success', [CartController::class, 'success'])->name('carts.success');

    // Route::resource('checkouts', CheckoutController::class);
    Route::controller(CheckoutController::class)->group(function () {
        Route::get('checkout', 'index')->name('checkout.index');
        Route::post('checkout', 'store')->name('checkout.store');
        Route::get('checkout/success', 'success')->name('checkout.success');
    });

    Route::prefix('customer')->name('customer.')->group(function () {
        Route::resource('menus', CustomerMenuController::class)->names([
            'index' => 'menus.index',
            'create' => 'menus.create',
            'store' => 'menus.store',
            'show' => 'menus.show',
            'edit' => 'menus.edit',
            'update' => 'menus.update',
            'destroy' => 'menus.destroy',
        ]);
    });

//     Route::get('checkouts', [CheckoutController::class, 'index'])->name('checkouts.index');
//     Route::post('/checkouts', [CheckoutController::class, 'store'])->name('checkouts.store');
//     Route::get('/checkouts/success', [CheckoutController::class, 'success'])->name('checkouts.success');
});

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'auth:admin'], function () {
    Route::get('home', [Admin\HomeController::class, 'index'])->name('home');
    Route::resource('categories', CategoryController::class);
    Route::resource('menus', AdminMenuController::class);
    Route::resource('orders', OrderController::class);
    Route::get('orders', [OrderController::class, 'index'])->name('admin.orders.index');
    Route::get('orders/{order}', [OrderController::class, 'show'])->name('admin.orders.show'); 

});

Route::prefix('admin')->middleware('auth')->name('admin.')->group(function () {
    // Route::resource('menus', AdminMenuController::class);
    // Route::resource('orders', OrderController::class);
    // Route::get('orders', [OrderController::class, 'index'])->name('admin.orders.index');
    // Route::get('orders/{id}', [OrderController::class, 'show'])->name('admin.orders.show');
});

// Route::prefix('admin')->middleware(['auth', 'is_admin'])->group(function () {
//     Route::get('orders', [OrderController::class, 'index'])->name('admin.orders.index');
//     Route::get('orders/{id}', [OrderController::class, 'show'])->name('admin.orders.show'); // これが必要
// });




require __DIR__.'/auth.php';

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'auth:admin'], function () {
    Route::get('home', [Admin\HomeController::class, 'index'])->name('home');
});
