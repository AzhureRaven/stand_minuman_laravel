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
        Schema::create('topping', function (Blueprint $table) {
            $table->double("id_topping")->autoIncrement()->primary();
            $table->string("nama",100);
            $table->string("gambar",50)->nullable();
            $table->double("harga");
            $table->timestamps();
            $table->softDeletes();
        });

        DB::statement("ALTER TABLE topping MODIFY id_topping DOUBLE AUTO_INCREMENT;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('topping');
    }
};
