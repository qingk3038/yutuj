<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRaidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('raiders', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('type', ['default', 'line', 'food', 'hospital', 'scenic'])->index()->default('default');
            $table->string('title');
            $table->string('short')->comment('短标题');
            $table->string('description')->nullable()->comment('描述');
            $table->string('thumb')->nullable()->comment('缩略图');
            $table->unsignedInteger('click')->default(0)->comment('点击量');

            $table->text('body')->comment('描述');

            $table->unsignedInteger('country_id')->index()->comment('国家');
            $table->foreign('country_id')->references('id')->on('loclists')->onDelete('cascade');

            $table->unsignedInteger('province_id')->index()->comment('省份');
            $table->foreign('province_id')->references('id')->on('loclists')->onDelete('cascade');

            $table->unsignedInteger('city_id')->index()->nullable()->comment('城市');
            $table->foreign('city_id')->references('id')->on('loclists')->onDelete('cascade');

            $table->unsignedInteger('district_id')->index()->nullable()->comment('地区');
            $table->foreign('district_id')->references('id')->on('loclists')->onDelete('cascade');

            $table->unsignedInteger('admin_user_id')->index()->comment('作者');
            $table->foreign('admin_user_id')->references('id')->on('admin_users')->onDelete('cascade');

            $table->timestamps();
        });

        DB::statement('ALTER TABLE `raiders` ADD FULLTEXT(`title`, `description`) WITH PARSER ngram');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('raiders');
    }
}
