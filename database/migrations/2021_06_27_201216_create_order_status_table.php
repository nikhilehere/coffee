<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_status', function (Blueprint $table) {
            $table->id();
            $table->string('status');
        });

        DB::table('order_status')->insert([
            ['status' => 'NEW'],
            ['status' => 'PROCESSED'],
            ['status' => 'PREPARING'],
            ['status' => 'SERVING'],
            ['status' => 'SERVED'],
            ['status' => 'CANCELLED'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_status');
    }
}
