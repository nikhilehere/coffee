<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_no');
            $table->integer('product_id');
            $table->integer('nos')->comment('item quantity');
            $table->integer('customer_id');
            $table->float('amount');
            $table->tinyInteger('is_paid')->comment('1 is paid, 0 is not paid');
            $table->tinyInteger('is_admin')->comment('1 is yes, 0 is no');
            $table->integer('pay_mode')->comment('1 is wallet, 0 COD');
            $table->integer('order_status');
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
        Schema::dropIfExists('orders');
    }
}
