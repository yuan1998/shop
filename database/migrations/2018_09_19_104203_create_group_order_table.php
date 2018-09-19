<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_order', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('group_id');
            $table->integer('count')->default(1);
            $table->unsignedInteger('product_id');
            $table->string('status')->default('close');
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
        Schema::dropIfExists('group_order');
    }
}
