<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShoppingcartTable extends Migration
{
    /**
     * Run the migrations.
     */

     public function up()
     {
         Schema::create(config('cart.database.table'), function (Blueprint $table) {
             $table->unsignedInteger('id')->autoIncrement(); // 主キー
             $table->string('identifier');
             $table->string('instance');
             $table->longText('content');
             $table->nullableTimestamps();
     
             // identifier と instance に一意制約を付与
             $table->unique(['identifier', 'instance']);
         });
     }

    // public function up()
    // {
    //     Schema::create(config('cart.database.table'), function (Blueprint $table) {
    //         // $table->unsignedInteger('id')->autoIncrement()->unique();
    //         $table->string('identifier');
    //         $table->string('instance');
    //         $table->longText('content');
    //         $table->nullableTimestamps();

    //         $table->primary(['identifier', 'instance']);
    //         // $table->primary(['id', 'identifier', 'instance']);
    //     });
    // }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop(config('cart.database.table'));
    }
}
