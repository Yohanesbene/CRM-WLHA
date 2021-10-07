<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RelationIdPemberianObat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mcu_cek_obat', function (Blueprint $table) {
            $table->integer('id_pemberian_obat')
                ->after('id');
            $table->foreign('id_pemberian_obat')
                ->references('id')
                ->on('mcu_pemberian_obat');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mcu_cek_obat', function (Blueprint $table) {
            //
        });
    }
}
