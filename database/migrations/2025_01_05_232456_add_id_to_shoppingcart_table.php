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
        Schema::table('shoppingcart', function (Blueprint $table) {
            $table->string('code')->default('')->unique();//注文コード
            $table->unsignedInteger('table_number');//テーブル番号
            $table->unsignedBigInteger('user_id'); // ユーザーID
            $table->unsignedBigInteger('menu_id'); // メニューID
            $table->integer('quantity')->default(1); // 数量
            $table->decimal('price', 10, 2); // 価格
            $table->decimal('total', 10, 2); // 合計
            $table->text('request')->nullable(); // ユーザーのリクエストを文字列で保存する場合
            $table->string('status')->default('pending'); // ステータス
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shoppingcart', function (Blueprint $table) {
            $table->dropColumn(['id','code', 'table_number', 'user_id', 'menu_id', 'quantity', 'price', 'total', 'request', 'status']);
        });
    }
};
