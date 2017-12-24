<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('tuan_id')->comment('出团ID');
            $table->enum('type', ['alipay', 'wechat'])->comment('支付类型');
            $table->enum('status', ['success', 'fail', 'close', 'wait'])->default('wait')->comment('订单状态');
            $table->string('remarks', 500)->nullable()->comment('用户备信息');

            $table->unsignedInteger('total_fee')->nullable()->comment('支付金额（分）');
            $table->string('out_trade_no', 32)->nullable()->comment('商家订单号');
            $table->string('transaction_id', 32)->nullable()->comment('交易号');

            $table->unsignedInteger('user_id')->index()->comment('创建会员');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->dateTime('pay_at')->nullable()->comment('支付时间');
            $table->timestamps();

            $table->index('type', 'created_at');
        });

        Schema::create('baomings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 20)->comment('姓名');
            $table->string('mobile', 20)->comment('手机号');
            $table->enum('cardType', ['ID', 'officer', 'passport'])->comment('证件类型');
            $table->string('cardID', 50)->comment('证件号');
            $table->string('nameJ', 20)->comment('紧急联系人');
            $table->string('mobileJ', 20)->comment('紧急联系人手机号');

            $table->unsignedInteger('order_id')->index()->comment('订单表');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
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
        Schema::dropIfExists('baomings');
        Schema::dropIfExists('orders');
    }
}
