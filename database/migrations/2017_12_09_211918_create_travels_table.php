<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTravelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('travels', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->index();
            $table->string('thumb');
            $table->string('description', 350);
            $table->longText('body');
            $table->string('province')->nullable();
            $table->string('city')->nullable();
            $table->unsignedInteger('click')->default(0);
            $table->enum('status', ['draft', 'audit', 'adopt', 'reject'])->index()->default('draft');
            $table->unsignedInteger('user_id')->index();
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
        Schema::dropIfExists('travels');
    }
}
