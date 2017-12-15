<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeadersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leaders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 20);;
            $table->enum('sex', ['F', 'M'])->comment('性别');
            $table->string('avatar')->comment('头像');
            $table->string('bg_home')->comment('背景图');
            $table->string('brief')->comment('简介');
            $table->string('description', 350)->comment('描述');
            $table->string('introduction', 2000)->comment('介绍');
            $table->text('photos')->nullable()->comment('轮播图');

            $table->unsignedInteger('country_id')->index()->comment('国家');
            $table->foreign('country_id')->references('id')->on('loclists')->onDelete('cascade');

            $table->unsignedInteger('province_id')->index()->comment('省份');
            $table->foreign('province_id')->references('id')->on('loclists')->onDelete('cascade');

            $table->unsignedInteger('city_id')->index()->nullable()->comment('城市');
            $table->foreign('city_id')->references('id')->on('loclists')->onDelete('cascade');

            $table->unsignedInteger('district_id')->index()->nullable()->comment('地区');
            $table->foreign('district_id')->references('id')->on('loclists')->onDelete('cascade');

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
        Schema::dropIfExists('leaders');
    }
}
