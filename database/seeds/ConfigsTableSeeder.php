<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class ConfigsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (DB::table('admin_config')->count() === 0) {
            DB::table('admin_config')->insert([
                ['name' => 'web_title', 'value' => '遇途记', 'description' => '网站标题', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['name' => 'web_keywords', 'value' => '体验式旅游,自由行,定制旅游', 'description' => '网站关键词', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['name' => 'web_description', 'value' => '遇途记是首家推出体验式旅游这一概念的商家，我们为你提供众多品类的定制旅游产品。游客更多的会体验到吃、喝、玩、乐的乐趣，与传统旅游不同的是我们的自由行是真正的体验式旅游产品。', 'description' => '网站描述', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['name' => 'tel_400', 'value' => '400-0190-857', 'description' => '400电话', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['name' => 'web_footer', 'value' => '蜀ICP备16031541号-3', 'description' => '网站底部', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['name' => 'js_pc', 'value' => '<script src="http://dat.zoosnet.net/JS/LsJS.aspx?siteid=DAT65653302&lng=cn"></script>', 'description' => '电脑端js', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['name' => 'js_mobile', 'value' => '<script src="http://dat.zoosnet.net/JS/LsJS.aspx?siteid=DAT65653302&float=1&lng=cn"></script>', 'description' => '移动端js', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['name' => 'sms_register', 'value' => 'SMS_94550039', 'description' => '注册短信', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['name' => 'sms_forgot', 'value' => 'SMS_100925095', 'description' => '找回密码短信', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['name' => 'sms_update', 'value' => 'SMS_100725128', 'description' => '更新号码短信', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['name' => 'sms_pay', 'value' => 'SMS_94415034', 'description' => '支付后发送短信', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['name' => 'sms_max', 'value' => '20', 'description' => '短信每天发送（每个号码）的最多次', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ]);
        }
    }
}
