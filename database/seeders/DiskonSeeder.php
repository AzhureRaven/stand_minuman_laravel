<?php

namespace Database\Seeders;

use App\Models\Diskon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DiskonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET FOREIGN_KEY_CHECKS=0");
        DB::table("diskon")->truncate();
        DB::statement("SET FOREIGN_KEY_CHECKS=1");
        // DB::table("diskon")->insert([
        //     [
        //         'nama' => 'Diskon Kilat',
        //         'potongan' => 20
        //     ],
        // ]);
        Diskon::factory()->count(5)->create();
    }
}
