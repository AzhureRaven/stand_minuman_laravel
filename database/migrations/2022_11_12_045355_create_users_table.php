<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->double("id_users")->autoIncrement()->primary();
            $table->string("username",30)->unique();
            $table->string("password",255);
            $table->string("nama",100);
            $table->tinyInteger("privilege")->default(1)->comment("2 = Admin, 1 = Kasir");
            $table->timestamps();
            $table->softDeletes();
        });

        DB::statement("ALTER TABLE users MODIFY id_users DOUBLE AUTO_INCREMENT;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
