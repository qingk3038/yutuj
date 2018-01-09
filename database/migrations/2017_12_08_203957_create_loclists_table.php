<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoclistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loclists', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 10);
            $table->string('name', 10);
            $table->unsignedSmallInteger('parent_id')->default(0)->index();
            $table->unsignedTinyInteger('type')->index();
            $table->index(['parent_id', 'type']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loclists');
    }
}
