<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (User::where('mobile', '18613233254')->count() === 0) {
            User::create([
                'mobile' => '18613233254',
                'password' => bcrypt('bing8u'),
                'name' => '阳光灿烂',
                'sex' => 'M',
                'province' => '四川',
                'city' => '成都',
                'birthday' => '1990-03-01',
                'description' => '我是个好人，紫霞仙子最了解了。',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        };
    }
}
