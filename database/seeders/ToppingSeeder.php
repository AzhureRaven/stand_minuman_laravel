<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ToppingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET FOREIGN_KEY_CHECKS=0");
        DB::table("topping")->truncate();
        DB::statement("SET FOREIGN_KEY_CHECKS=1");
        DB::table("topping")->insert([
            [
                'nama' => 'No Topping',
                'harga' => 0,
            ],
            [
                'nama' => 'Gula',
                'harga' => 2000,
            ],
            [
                'nama' => 'Chocolate Chip',
                'harga' => 3000,
            ],
            [
                'nama' => 'Jeruk Nipis',
                'harga' => 2500,
            ],
        ]);
    }
}
