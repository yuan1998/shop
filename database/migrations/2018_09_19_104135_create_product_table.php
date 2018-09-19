<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('price');
            $table->string('status')->default('close');
            $table->string('cover')->nullable();
            $table->integer('buy_count')->default(0);
            $table->integer('view_count')->default(0);
            $table->integer('reply_count')->default(0);
            $table->string('flag')->nullable();
            $table->integer('rank')->default(0);
            $table->unsignedInteger('category_id');

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
        Schema::dropIfExists('product');
    }
}
