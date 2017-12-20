<?php

use App\Models\Nav;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class NavsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Nav::count() === 0) {
            Nav::insert([
                ['text' => '活动线路', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['text' => '纵横西部', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['text' => '微上西部', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['text' => '超级周末', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['text' => '最6旅行', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ]);
        }
    }
}
