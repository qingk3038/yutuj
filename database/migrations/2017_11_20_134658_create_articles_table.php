<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->unsignedInteger('lanmu_id')->index();
            $table->foreign('lanmu_id')->references('id')->on('lanmus')->onDelete('cascade');
            $table->unsignedInteger('user_id')->index();
            $table->foreign('user_id')->references('id')->on('admin_users')->onDelete('cascade');
            $table->string('title')->index();
            $table->string('keywords')->nullable();
            $table->string('description')->nullable();
            $table->string('thumb')->nullable();
            $table->unsignedInteger('click')->default(0);
            $table->timestamps();
        });

        Schema::create('article_datas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('article_id', false, true)->index();
            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
            $table->text('content');
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
        Schema::dropIfExists('article_datas');
        Schema::dropIfExists('articles');
    }
}
