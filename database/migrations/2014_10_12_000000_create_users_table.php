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
            $table->string('mobile')->unique();
            $table->string('password');
            $table->string('name')->nullable();
            $table->enum('sex', ['F', 'M'])->default('F');
            $table->string('province')->nullable();
            $table->string('city')->nullable();
            $table->date('birthday')->nullable();
            $table->string('description', 250)->nullable();
            $table->string('avatar', 250)->nullable();
            $table->string('bg_home', 250)->nullable();
            $table->unsignedInteger('disable')->default(0);
            $table->string('api_token', 64)->unique()->nullable();
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
