<?php

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Category::count() === 0) {
            Category::insert([
                ['title' => '遇途记', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['title' => '活动报名流程', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['title' => '预订常见问题', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['title' => '网站条款', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['title' => '付款和发票', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ]);
        }
    }
}
