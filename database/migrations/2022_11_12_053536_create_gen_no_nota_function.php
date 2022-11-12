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
        $function = "
        CREATE OR REPLACE FUNCTION genNoNota()RETURNS VARCHAR(100)
        BEGIN
         DECLARE hasil VARCHAR(100) DEFAULT '';
         DECLARE counted INT;

         SELECT IFNULL(COUNT(*),0) INTO counted FROM htrans
         WHERE no_nota LIKE CONCAT('%H',DATE_FORMAT(NOW(), '%y%m%d'),'%');
         SET counted = counted + 1;

         SET hasil = CONCAT('H',DATE_FORMAT(NOW(),'%y%m%d'),LPAD(counted,4,'0'));
         RETURN hasil;
        END;";

        DB::unprepared($function);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
};
