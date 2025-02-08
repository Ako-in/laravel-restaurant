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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('table_number');
            $table->string('customer_name')->nullable();
            $table->string('customer_phone');
            $table->string('customer_email');
            $table->string('payment_method');
            $table->string('menu_id');
            $table->string('menu_name');
            $table->string('menu_price');
            $table->string('quantity');
            $table->string('total_price');
            $table->string('status');
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
};
