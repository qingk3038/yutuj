<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 标签
        Schema::create('tags', function (Blueprint $table) {
            $table->increments('id');
            $table->string('text', 20);
            $table->timestamps();
        });

        // 类别
        Schema::create('types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('text', 20);
            $table->timestamps();
        });

        // 行程
        Schema::create('trips', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->comment('行程地址');
            $table->text('body')->comment('行程简介');
            $table->text('photos')->nullable()->comment('行程照片');
            $table->string('zaocan', 20)->comment('早餐');
            $table->string('wucan', 20)->comment('午餐');
            $table->string('wancan', 20)->comment('晚餐');
            $table->string('zhusu', 20)->comment('住宿');
            $table->timestamps();
        });

        // 发团日期
        Schema::create('tuans', function (Blueprint $table) {
            $table->increments('id');
            $table->date('start_time')->comment('开始日期');
            $table->date('end_time')->comment('结束日期');
            $table->unsignedSmallInteger('start_num')->comment('开始人数');
            $table->unsignedSmallInteger('end_num')->comment('截止人数');
            $table->unsignedSmallInteger('price')->comment('每人价格');
            $table->timestamps();
        });

        // 活动
        Schema::create('activities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('short')->nullable()->comment('短标题');
            $table->string('thumb')->comment('缩略图');
            $table->text('photos')->nullable()->comment('展示图');

            $table->integer('price')->default(0)->index()->comment('价格');
            $table->unsignedTinyInteger('play')->index()->comment('游玩天数');

            $table->json('tese')->nullable()->comment('行程特色');
            $table->text('baohan')->nullable()->comment('不含说明');
            $table->text('buhan')->nullable()->comment('包含说明');
            $table->text('zhuyi')->nullable()->comment('注意事项');
            $table->text('qianyue')->nullable()->comment('签约条款');

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

        // 标签活动关系
        Schema::create('activity_tag', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('activity_id')->index()->comment('活动ID');
            $table->foreign('activity_id')->references('id')->on('activities')->onDelete('cascade');

            $table->unsignedInteger('tag_id')->index()->comment('标签ID');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');

            $table->timestamps();
        });

        // 类别活动关系
        Schema::create('activity_type', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('activity_id')->index()->comment('活动ID');
            $table->foreign('activity_id')->references('id')->on('activities')->onDelete('cascade');

            $table->unsignedInteger('type_id')->index()->comment('类别ID');
            $table->foreign('type_id')->references('id')->on('types')->onDelete('cascade');

            $table->timestamps();
        });

        // 行程活动关系
        Schema::create('activity_trip', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('activity_id')->index()->comment('活动ID');
            $table->foreign('activity_id')->references('id')->on('activities')->onDelete('cascade');

            $table->unsignedInteger('trip_id')->index()->comment('行程ID');
            $table->foreign('trip_id')->references('id')->on('trips')->onDelete('cascade');

            $table->timestamps();
        });

        // 发团活动关系
        Schema::create('activity_tuan', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('activity_id')->index()->comment('活动ID');
            $table->foreign('activity_id')->references('id')->on('activities')->onDelete('cascade');

            $table->unsignedInteger('tuan_id')->index()->comment('发团ID');
            $table->foreign('tuan_id')->references('id')->on('tuans')->onDelete('cascade');

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
        Schema::dropIfExists('activity_tag');
        Schema::dropIfExists('activity_type');
        Schema::dropIfExists('activity_trip');
        Schema::dropIfExists('activity_tuan');

        Schema::dropIfExists('activities');

        Schema::dropIfExists('tuans');
        Schema::dropIfExists('trips');
        Schema::dropIfExists('tags');
        Schema::dropIfExists('types');
    }
}
