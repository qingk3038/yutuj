<?php

use App\Models\Type;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Type::count() === 0) {
            Type::insert([
                ['text' => '包团游', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['text' => '跟团游', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['text' => '豪华包团', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['text' => '经济小包团', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ]);
        }
    }
}
