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
        Schema::create('htrans', function (Blueprint $table) {
            $table->string("no_nota",50)->primary();
            $table->double('id_users');
            $table->double('id_diskon')->nullable();
            $table->double('id_member')->nullable();
            $table->double('subtotal');
            $table->double('potongan')->default(0);
            $table->double('total');
            $table->dateTime("tanggal")->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('htrans');
    }
};
