<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ShoppingCart extends Model
{
    use HasFactory;

    // テーブル名を指定
    protected $table = 'shoppingcart';

    // 一括代入を許可する属性
    protected $fillable = [
        'identifier',
        'instance',
        'content',
        'code',
        'user_id',
        'menu_id',
        'quantity',
        'price',
        'total',
        'status', // 必要に応じて追加
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }

    // public function order()
    // {
    //     return $this->hasOne(Order::class);
    // }
}
