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
        Schema::create('diskon', function (Blueprint $table) {
            $table->double("id_diskon")->autoIncrement()->primary();
            $table->string("nama",50);
            $table->double("potongan");
            $table->timestamps();
            $table->softDeletes();
        });

        DB::statement("ALTER TABLE diskon MODIFY id_diskon DOUBLE AUTO_INCREMENT;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('diskon');
    }
};
