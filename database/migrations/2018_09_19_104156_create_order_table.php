<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->json('snapshot');
            $table->string('order_number');
            $table->string('price');
            $table->string('status')->default('close');
            $table->string('code')->nullable();
            $table->string('type');
            $table->unsignedInteger('group_id')->nullable();
            $table->unsignedInteger('product_id')->nullable();
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
        Schema::dropIfExists('order');
    }
}
