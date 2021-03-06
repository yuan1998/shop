<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username')->nullable();
            $table->string('gender')->default(0);
            $table->string('wx_name')->nullable();
            $table->string('phone')->nullable()->unique();
            $table->string('openid')->nullable()->unique();
            $table->string('unionid')->nullable()->unique();
            $table->string('avatar')->nullable();
            $table->string('access_token')->nullable();
            $table->string('permission_id')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('password')->default('');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
