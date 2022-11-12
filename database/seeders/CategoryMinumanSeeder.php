<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryMinumanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET FOREIGN_KEY_CHECKS=0");
        DB::table("category_minuman")->truncate();
        DB::statement("SET FOREIGN_KEY_CHECKS=1");
        DB::table("category_minuman")->insert([
            [
                'nama' => 'No Category'
            ],
            [
                'nama' => 'Teh'
            ],
            [
                'nama' => 'Jus'
            ],
            [
                'nama' => 'Milkshake'
            ],
        ]);
    }
}
