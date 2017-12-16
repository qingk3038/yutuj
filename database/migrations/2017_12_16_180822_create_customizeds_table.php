<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomizedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customizeds', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('type', ['PC', 'Mobile'])->default('PC')->comment('来源');
            $table->unsignedTinyInteger('read')->default(0)->comment('已读');
            $table->string('title')->comment('想去的目的地');
            $table->string('mobile')->comment('手机号');
            $table->unsignedInteger('user_id')->index()->nullable()->comment('登录人');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('customizeds');
    }
}
