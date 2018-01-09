<?php

use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Tag::count() === 0) {
            Tag::insert([
                ['text' => '自由', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['text' => '定制', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['text' => '纯玩', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['text' => '优惠', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ]);
        }
    }
}
