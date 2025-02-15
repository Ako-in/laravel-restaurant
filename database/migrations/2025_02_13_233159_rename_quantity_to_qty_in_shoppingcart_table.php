<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
            $table->integer('qty')->default(1)->nullable(false)->after('menu_id'); // Not Null, `quantity`と同じ型で新カラムを追加
        });
        DB::table('shoppingcart')->update(['qty' => DB::raw('quantity')]); // `quantity`の値を`qty`にコピー

        Schema::table('shoppingcart', function (Blueprint $table) {
            $table->dropColumn('quantity'); // `quantity`カラムを削除
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
            $table->integer('quantity')->after('menu_id'); // `qty`と同じ型で再追加
        });
        DB::table('shoppingcart')->update(['quantity' => DB::raw('qty')]); // `qty`の値を`quantity`にコピー

        Schema::table('shoppingcart', function (Blueprint $table) {
            $table->dropColumn('qty'); // `qty`カラムを削除
        });
    }
};
