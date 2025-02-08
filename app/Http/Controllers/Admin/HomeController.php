<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class HomeController extends Controller
{
    public function index() {
        $order = Order::latest()->get();
        return view('admin.home.index',compact('order'));
    }
}
