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

        // 活动
        Schema::create('activities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('short')->comment('短标题');
            $table->string('number')->nullable()->comment('产品编号');
            $table->string('cfd')->nullable()->comment('出发地');
            $table->string('xc')->nullable()->comment('行程');
            $table->string('description')->nullable()->comment('描述');

            $table->string('thumb')->comment('缩略图');
            $table->text('photos')->nullable()->comment('展示图');

            $table->integer('price')->default(1000)->index()->comment('价格');

            $table->text('ts')->nullable()->comment('行程特色');
            $table->text('tps')->nullable()->comment('特色图片');

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

            $table->unsignedInteger('admin_user_id')->index()->nullable()->comment('作者');
            $table->foreign('admin_user_id')->references('id')->on('admin_users')->onDelete('cascade');

            $table->unsignedTinyInteger('closed')->index()->default(0)->comment('关闭');

            $table->timestamps();
        });

        // 行程
        Schema::create('trips', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->comment('行程地址');
            $table->text('body')->comment('行程简介');
            $table->text('pictures')->nullable()->comment('行程照片');
            $table->string('zaocan', 20)->comment('早餐');
            $table->string('wucan', 20)->comment('午餐');
            $table->string('wancan', 20)->comment('晚餐');
            $table->string('zhusu', 20)->comment('住宿');

            $table->unsignedInteger('activity_id')->index()->comment('活动ID');
            $table->foreign('activity_id')->references('id')->on('activities')->onDelete('cascade');
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

            $table->unsignedInteger('activity_id')->index()->comment('活动ID');
            $table->foreign('activity_id')->references('id')->on('activities')->onDelete('cascade');
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

        Schema::dropIfExists('trips');
        Schema::dropIfExists('tuans');
        Schema::dropIfExists('activities');

        Schema::dropIfExists('tags');
        Schema::dropIfExists('types');
    }
}
