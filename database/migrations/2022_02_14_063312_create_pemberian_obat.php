<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemberianObat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mcu_pemberian_obat', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_pegawai',20);
            $table->foreign('id_pegawai')
                ->references('id')
                ->on('users');

            $table->unsignedInteger('id_penghuni');
            $table->foreign('id_penghuni')
                ->references('id')
                ->on('penghuni');

            $table->unsignedInteger('id_obat');
            $table->foreign('id_obat')
                ->references('id')
                ->on('tb_obat');

            $table->float('dosis',5,2);
            $table->datetime('waktu')->nullable();
            $table->string('id_pegawai_cek', 20)->nullable();
            $table->foreign('id_pegawai_cek')
                ->references('id')
                ->on('users');
                
            $table->datetime('waktu_cek')->nullable();
            $table->string('efek_samping')->nullable();
            $table->enum('dikonsumsi', ['diminum', 'tidak diminum', 'jatuh', null])->nullable();
            $table->integer('deleted')->unsigned()->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mcu_pemberian_obat');
    }
}
