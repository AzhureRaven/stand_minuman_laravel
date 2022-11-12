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
        Schema::create('minuman', function (Blueprint $table) {
            $table->double("id_minuman")->autoIncrement()->primary();
            $table->string("nama",100);
            $table->string("gambar",50)->nullable();
            $table->double("harga");
            $table->double("id_category_minuman")->default(1);
            $table->timestamps();
            $table->softDeletes();
        });

        DB::statement("ALTER TABLE minuman MODIFY id_minuman DOUBLE AUTO_INCREMENT;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('minuman');
    }
};
