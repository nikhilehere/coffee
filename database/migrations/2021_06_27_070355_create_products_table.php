<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->string('product_no')->nullable();
            $table->float('product_cost');
            $table->integer('quantity');
            $table->integer('active');
            $table->timestamps();
        });

        DB::table('products')->insert([
            [
                'product_name' => 'Coffee',
                'product_no' => 'CF001',
                'product_cost' => 100,
                'quantity' => 50,
                'active' => 1,
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
