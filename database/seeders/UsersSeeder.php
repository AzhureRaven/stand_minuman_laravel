<?php

namespace Database\Seeders;

use App\Models\Users;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET FOREIGN_KEY_CHECKS=0");
        DB::table("users")->truncate();
        DB::statement("SET FOREIGN_KEY_CHECKS=1");
        DB::table("users")->insert([
            [
                'username' => 'admin',
                'password' => Hash::make("admin"),
                'nama' => 'admin',
                'privilege' => 2
            ]
        ]);
        Users::factory()->count(5)->create();
    }
}
