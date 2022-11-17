<?php

namespace Database\Seeders;

use App\Models\Member;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET FOREIGN_KEY_CHECKS=0");
        DB::table("member")->truncate();
        DB::statement("SET FOREIGN_KEY_CHECKS=1");
        // DB::table("member")->insert([
        //     [
        //         'nama' => 'Arthur Fendy',
        //         'email' => 'abrahamarthurfendy@gmail.com'
        //     ],
        // ]);
        Member::factory()->count(10)->create();
    }
}
