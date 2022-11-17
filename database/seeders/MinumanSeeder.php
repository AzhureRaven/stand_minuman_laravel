<?php

namespace Database\Seeders;

use App\Models\Minuman;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MinumanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET FOREIGN_KEY_CHECKS=0");
        DB::table("minuman")->truncate();
        DB::statement("SET FOREIGN_KEY_CHECKS=1");
        // DB::table("minuman")->insert([
        //     [
        //         'nama' => 'Es Teh Manis',
        //         'harga' => 10000,
        //         'id_category_minuman' => 2,
        //     ],
        //     [
        //         'nama' => 'Jus Jeruk',
        //         'harga' => 12000,
        //         'id_category_minuman' => 3,
        //     ],
        //     [
        //         'nama' => 'Milkshake',
        //         'harga' => 15000,
        //         'id_category_minuman' => 4,
        //     ],
        //     [
        //         'nama' => 'Chocolate Milkshake',
        //         'harga' => 16000,
        //         'id_category_minuman' => 4,
        //     ],
        // ]);
        Minuman::factory()->count(10)->create();
    }
}
