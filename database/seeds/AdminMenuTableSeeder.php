<?php

use Illuminate\Database\Seeder;

class AdminMenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (DB::table('admin_menu')->count() === 0) {
            DB::table('admin_menu')->insert([
                ['id' => '1', 'parent_id' => '0', 'order' => '1', 'title' => 'Index', 'icon' => 'fa-bar-chart', 'uri' => '/', 'created_at' => null, 'updated_at' => null],
                ['id' => '2', 'parent_id' => '0', 'order' => '2', 'title' => 'Admin', 'icon' => 'fa-tasks', 'uri' => '', 'created_at' => null, 'updated_at' => null],
                ['id' => '3', 'parent_id' => '2', 'order' => '3', 'title' => 'Users', 'icon' => 'fa-users', 'uri' => 'auth/users', 'created_at' => null, 'updated_at' => null],
                ['id' => '4', 'parent_id' => '2', 'order' => '4', 'title' => 'Roles', 'icon' => 'fa-user', 'uri' => 'auth/roles', 'created_at' => null, 'updated_at' => null],
                ['id' => '5', 'parent_id' => '2', 'order' => '5', 'title' => 'Permission', 'icon' => 'fa-ban', 'uri' => 'auth/permissions', 'created_at' => null, 'updated_at' => null],
                ['id' => '6', 'parent_id' => '2', 'order' => '6', 'title' => 'Menu', 'icon' => 'fa-bars', 'uri' => 'auth/menu', 'created_at' => null, 'updated_at' => null],
                ['id' => '7', 'parent_id' => '2', 'order' => '7', 'title' => 'Operation log', 'icon' => 'fa-history', 'uri' => 'auth/logs', 'created_at' => null, 'updated_at' => null],
            ]);
        }

        if (DB::table('admin_menu')->count() < 8) {
            DB::table('admin_menu')->insert([
                ['id' => '8', 'parent_id' => '0', 'order' => '8', 'title' => 'Helpers', 'icon' => 'fa-gears', 'uri' => '', 'created_at' => '2017-11-20 04:36:36', 'updated_at' => '2017-12-13 14:56:45'],
                ['id' => '9', 'parent_id' => '8', 'order' => '9', 'title' => 'Scaffold', 'icon' => 'fa-keyboard-o', 'uri' => 'helpers/scaffold', 'created_at' => '2017-11-20 04:36:36', 'updated_at' => '2017-12-13 14:56:45'],
                ['id' => '10', 'parent_id' => '8', 'order' => '10', 'title' => 'Database terminal', 'icon' => 'fa-database', 'uri' => 'helpers/terminal/database', 'created_at' => '2017-11-20 04:36:36', 'updated_at' => '2017-12-13 14:56:45'],
                ['id' => '11', 'parent_id' => '8', 'order' => '11', 'title' => 'Laravel artisan', 'icon' => 'fa-terminal', 'uri' => 'helpers/terminal/artisan', 'created_at' => '2017-11-20 04:36:36', 'updated_at' => '2017-12-13 14:56:45'],
                ['id' => '12', 'parent_id' => '8', 'order' => '12', 'title' => 'Routes', 'icon' => 'fa-list-alt', 'uri' => 'helpers/routes', 'created_at' => '2017-11-20 04:36:36', 'updated_at' => '2017-12-13 14:56:45'],
                ['id' => '13', 'parent_id' => '0', 'order' => '13', 'title' => '文件管理', 'icon' => 'fa-file', 'uri' => 'media', 'created_at' => '2017-11-20 04:42:17', 'updated_at' => '2017-12-13 14:56:45'],
                ['id' => '14', 'parent_id' => '0', 'order' => '14', 'title' => 'Api 测试', 'icon' => 'fa-sliders', 'uri' => 'api-tester', 'created_at' => '2017-11-20 04:45:25', 'updated_at' => '2017-12-13 14:56:45'],
                ['id' => '16', 'parent_id' => '0', 'order' => '18', 'title' => '配置', 'icon' => 'fa-toggle-on', 'uri' => 'config', 'created_at' => '2017-11-20 05:12:36', 'updated_at' => '2017-12-13 14:56:45'],
                ['id' => '17', 'parent_id' => '0', 'order' => '15', 'title' => '定时任务', 'icon' => 'fa-clock-o', 'uri' => 'scheduling', 'created_at' => '2017-11-20 05:13:52', 'updated_at' => '2017-12-13 14:56:45'],
                ['id' => '18', 'parent_id' => '0', 'order' => '16', 'title' => '错误日志', 'icon' => 'fa-database', 'uri' => 'logs', 'created_at' => '2017-11-20 05:20:21', 'updated_at' => '2017-12-13 14:56:45'],
                ['id' => '19', 'parent_id' => '0', 'order' => '17', 'title' => '备份', 'icon' => 'fa-copy', 'uri' => 'backup', 'created_at' => '2017-11-20 05:24:33', 'updated_at' => '2017-12-13 14:56:45'],
                ['id' => '20', 'parent_id' => '0', 'order' => '20', 'title' => '网站', 'icon' => 'fa-wordpress', 'uri' => '', 'created_at' => '2017-11-20 05:49:44', 'updated_at' => '2017-12-16 14:49:29'],
                ['id' => '21', 'parent_id' => '20', 'order' => '21', 'title' => '注册会员', 'icon' => 'fa-users', 'uri' => 'web/user', 'created_at' => '2017-12-13 15:02:25', 'updated_at' => '2017-12-16 14:49:29'],
                ['id' => '22', 'parent_id' => '20', 'order' => '22', 'title' => '审核游记', 'icon' => 'fa-book', 'uri' => 'web/travel', 'created_at' => '2017-12-13 16:24:30', 'updated_at' => '2017-12-16 14:49:29'],
                ['id' => '23', 'parent_id' => '0', 'order' => '25', 'title' => '领队', 'icon' => 'fa-slideshare', 'uri' => 'leader', 'created_at' => '2017-12-14 19:51:54', 'updated_at' => '2017-12-16 14:49:29'],
                ['id' => '24', 'parent_id' => '20', 'order' => '23', 'title' => '栏目', 'icon' => 'fa-drupal', 'uri' => 'web/category', 'created_at' => '2017-12-15 14:22:34', 'updated_at' => '2017-12-16 14:49:29'],
                ['id' => '25', 'parent_id' => '20', 'order' => '24', 'title' => '文章', 'icon' => 'fa-krw', 'uri' => 'web/article', 'created_at' => '2017-12-15 14:23:15', 'updated_at' => '2017-12-16 14:49:29'],
                ['id' => '26', 'parent_id' => '0', 'order' => '26', 'title' => '活动', 'icon' => 'fa-adn', 'uri' => '', 'created_at' => '2017-12-15 15:39:03', 'updated_at' => '2017-12-16 14:49:29'],
                ['id' => '27', 'parent_id' => '26', 'order' => '27', 'title' => '类型', 'icon' => 'fa-bitcoin', 'uri' => 'type', 'created_at' => '2017-12-15 15:39:54', 'updated_at' => '2017-12-16 14:49:29'],
                ['id' => '28', 'parent_id' => '26', 'order' => '28', 'title' => '标签', 'icon' => 'fa-tags', 'uri' => 'tag', 'created_at' => '2017-12-15 16:20:32', 'updated_at' => '2017-12-16 14:49:29'],
                ['id' => '29', 'parent_id' => '26', 'order' => '29', 'title' => '活动', 'icon' => 'fa-contao', 'uri' => 'activity', 'created_at' => '2017-12-15 16:21:03', 'updated_at' => '2017-12-16 14:49:29'],
                ['id' => '30', 'parent_id' => '0', 'order' => '19', 'title' => '导航', 'icon' => 'fa-vimeo', 'uri' => 'nav', 'created_at' => '2017-12-16 14:49:07', 'updated_at' => '2017-12-16 14:49:29'],
                ['id' => '31', 'parent_id' => '0', 'order' => '0', 'title' => '攻略', 'icon' => 'fa-ra', 'uri' => 'raider', 'created_at' => '2017-12-16 15:19:26', 'updated_at' => '2017-12-16 15:19:26'],
                ['id' => '32', 'parent_id' => '0', 'order' => '0', 'title' => '定制游', 'icon' => 'fa-leaf', 'uri' => 'customized', 'created_at' => '2017-12-16 18:17:58', 'updated_at' => '2017-12-16 18:17:58'],
                ['id' => '33', 'parent_id' => '0', 'order' => '0', 'title' => '订单', 'icon' => 'fa-calculator', 'uri' => 'order', 'created_at' => '2017-12-16 18:18:13', 'updated_at' => '2017-12-16 18:18:42'],
            ]);
        }
    }
}
