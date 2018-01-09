<?php

use Illuminate\Database\Seeder;

class LoclistsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = database_path('loclists.sql');
        if (\App\Models\LocList::count() === 0 && file_exists($file)) {

            $fh = fopen($file, 'r');
            while (!feof($fh)) {
                $line = fgets($fh);
                if (empty($line)) {
                    continue;
                }
                DB::statement($line);
            }
            fclose($fh);
        }
    }
}
