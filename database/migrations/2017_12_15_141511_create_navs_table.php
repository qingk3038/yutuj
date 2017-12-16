<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNavsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('navs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('text');
            $table->timestamps();
        });

        Schema::create('comms', function (Blueprint $table) {
            $table->unsignedInteger('nav_id');
            $table->foreign('nav_id')->references('id')->on('navs')->onDelete('cascade');
            $table->unsignedInteger('comm_id'); //保存游记、活动、美食等id
            $table->string('comm_type'); // 访问关联时确定所属的模型是哪个「类型」
        });
        DB::statement('ALTER TABLE `comms` ADD INDEX index_nav(`nav_id`, `comm_id`, `comm_type`)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comms');
        Schema::dropIfExists('navs');
    }
}
