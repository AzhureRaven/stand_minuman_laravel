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
        Schema::create('category_minuman', function (Blueprint $table) {
            $table->double("id_category_minuman")->autoIncrement()->primary();
            $table->string("nama",30);
            $table->timestamps();
            $table->softDeletes();
        });

        DB::statement("ALTER TABLE category_minuman MODIFY id_category_minuman DOUBLE AUTO_INCREMENT;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_minuman');
    }
};
