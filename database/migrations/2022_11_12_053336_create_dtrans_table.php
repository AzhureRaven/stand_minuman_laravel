<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
        Schema::create('dtrans', function (Blueprint $table) {
            $table->string("no_nota",50);
            $table->double('id_minuman');
            $table->double('id_topping');
            $table->double('jumlah');
            $table->double('subtotal_minuman');
            $table->double('subtotal_topping');
            $table->double('subtotal');
            $table->timestamps();
            $table->softDeletes();
            $table->primary(array('no_nota', 'id_minuman','id_topping'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dtrans');
    }
};
