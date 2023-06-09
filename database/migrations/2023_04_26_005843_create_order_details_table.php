<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_detail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('product_id');
            $table->string('name', 255)->nullable();
            $table->string('desc', 255)->nullable();
            $table->string('image', 255)->nullable();
            $table->integer('price')->default(0);
            $table->integer('quantity')->default(1);
            $table->timestamps();
            $table->foreign('order_id')->references('id')->on('order');
            $table->foreign('product_id')->references('id')->on('product');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_detail');
    }
}
