<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET FOREIGN_KEY_CHECKS=0");
        DB::table("htrans")->truncate();
        DB::table("dtrans")->truncate();
        DB::statement("SET FOREIGN_KEY_CHECKS=1");
        $this->call([
            UsersSeeder::class,
            ToppingSeeder::class,
            CategoryMinumanSeeder::class,
            MinumanSeeder::class,
            DiskonSeeder::class,
            MemberSeeder::class
        ]);
    }
}
