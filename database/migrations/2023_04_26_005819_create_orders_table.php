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
        Schema::create('order', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('payment_id');
            $table->unsignedBigInteger('order_status_id');
            $table->string('token_id');
            $table->string('user_name')->nullable();
            $table->string('phone_number')->nullable();
            $table->double('total', 12, 2)->nullable();
            $table->smallInteger('status_payment')->default(0);
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('payment_id')->references('id')->on('payment');
            $table->foreign('order_status_id')->references('id')->on('order_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order');
    }
}
