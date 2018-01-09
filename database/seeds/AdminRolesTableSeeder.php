<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class AdminRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (DB::table('admin_roles')->count() === 0) {
            DB::table('admin_roles')->insert(['id' => '1', 'name' => 'Administrator', 'slug' => 'administrator', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        }

        if (DB::table('admin_role_menu')->count() === 0) {
            DB::table('admin_role_menu')->insert(['role_id' => '1', 'menu_id' => '2', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        }

        if (DB::table('admin_users')->count() === 0) {
            DB::table('admin_users')->insert([
                'id' => '1',
                'username' => 'admin',
                'password' => bcrypt('admin'),
                'name' => 'Administrator',
                'avatar' => null,
                'remember_token' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }

        if (DB::table('admin_role_users')->count() === 0) {
            DB::table('admin_role_users')->insert(['role_id' => '1', 'user_id' => '1', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        }

        if (DB::table('admin_permissions')->count() === 0) {
            DB::table('admin_permissions')->insert([
                ['id' => '1', 'name' => 'All permission', 'slug' => '*', 'http_method' => '', 'http_path' => '*', 'created_at' => NULL, 'updated_at' => NULL],
                ['id' => '2', 'name' => 'Dashboard', 'slug' => 'dashboard', 'http_method' => 'GET', 'http_path' => '/', 'created_at' => NULL, 'updated_at' => NULL],
                ['id' => '3', 'name' => 'Login', 'slug' => 'auth.login', 'http_method' => '', 'http_path' => '/auth/login\r\n/auth/logout', 'created_at' => NULL, 'updated_at' => NULL],
                ['id' => '4', 'name' => 'User setting', 'slug' => 'auth.setting', 'http_method' => 'GET,PUT', 'http_path' => '/auth/setting', 'created_at' => NULL, 'updated_at' => NULL],
                ['id' => '5', 'name' => 'Auth management', 'slug' => 'auth.management', 'http_method' => '', 'http_path' => '/auth/roles\r\n/auth/permissions\r\n/auth/menu\r\n/auth/logs', 'created_at' => NULL, 'updated_at' => NULL],
            ]);
        }

        if (DB::table('admin_role_permissions')->count() === 0) {
            DB::table('admin_role_permissions')->insert(['role_id' => '1', 'permission_id' => '1', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        }

    }
}
