<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLanmusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Lanmus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->tinyInteger('hide', false, true)->default(0);
            $table->tinyInteger('parent_id', false, true)->default(0);
            $table->tinyInteger('order', false, true)->default(0);
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
        Schema::dropIfExists('Lanmus');
    }
}
