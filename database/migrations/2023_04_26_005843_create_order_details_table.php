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
            $table->string('namevi', 255)->nullable();
            $table->string('nameen', 255)->nullable();
            $table->string('nameja', 255)->nullable();
            $table->string('descvi', 255)->nullable();
            $table->string('descen', 255)->nullable();
            $table->string('descja', 255)->nullable();
            $table->string('image', 255)->nullable();
            $table->double('price', 12, 2)->default(0);
            $table->integer('quantity')->default(1);
            $table->timestamps();
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('id')->on('order');
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