<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::table('order_items', function (Blueprint $table) {
        //     //
        // });
        //テーブル名を変更
        Schema::rename('order_items', 'orders');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('order_items', function (Blueprint $table) {
        //     //
        // });
        Schema::rename('orders', 'order_items');
    }
};
