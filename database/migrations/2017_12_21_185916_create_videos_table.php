<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->increments('id');

            $table->enum('type', ['live', 'film'])->index()->default('film');
            $table->string('title')->index();
            $table->string('url');
            $table->string('description')->nullable()->comment('描述');
            $table->string('thumb')->nullable()->comment('缩略图');
            $table->unsignedInteger('click')->default(0)->comment('点击量');
            $table->boolean('closed')->default(false)->comment('关闭');

            $table->unsignedInteger('country_id')->index()->comment('国家');
            $table->foreign('country_id')->references('id')->on('loclists')->onDelete('cascade');

            $table->unsignedInteger('province_id')->index()->comment('省份');
            $table->foreign('province_id')->references('id')->on('loclists')->onDelete('cascade');

            $table->unsignedInteger('admin_user_id')->index()->comment('作者');
            $table->foreign('admin_user_id')->references('id')->on('admin_users')->onDelete('cascade');

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
        Schema::dropIfExists('videos');
    }
}
