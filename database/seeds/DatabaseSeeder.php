<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(LoclistsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(NavsTableSeeder::class);
        $this->call(TypesTableSeeder::class);
        $this->call(TagsTableSeeder::class);
        $this->call(ConfigsTableSeeder::class);
        $this->call(AdminMenuTableSeeder::class);
        $this->call(AdminRolesTableSeeder::class);
    }
}
