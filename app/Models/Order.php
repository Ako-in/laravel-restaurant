<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total_price',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeTotal($query)
    // $queryはwhereで取得されるのと同じBuilderインスタンスが渡される
    {
        $orderTotal = 0;
        foreach ($query as $order) {
            $orderTotal += $order->total_price;
        }
        return $orderTotal;
    }
}
