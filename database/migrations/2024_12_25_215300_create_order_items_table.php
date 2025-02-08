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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id(); // 自動インクリメントID
            $table->unsignedBigInteger('menu_id'); // メニューID
            $table->integer('quantity');          // 数量
            $table->decimal('price', 8, 2);       // 価格
            $table->text('request')->nullable();  // 任意リクエスト
            $table->timestamps();                 // 作成日時と更新日時

            // 外部キー制約
            $table->foreign('menu_id')->references('id')->on('menus')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_items', function (Blueprint $table) {
            //
        });
    }
};
