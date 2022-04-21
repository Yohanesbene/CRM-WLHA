<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenghuniTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penghuni', function (Blueprint $table) {
            // $table->id();
            // $table->string('id',)->primary();
            $table->increments('id');
            $table->string('no_induk', 40);
            $table->unique(['no_induk', 'id']);
            $table->string('nama');
            $table->string('foto')->nullable();
            $table->date('tgl_lahir');
            $table->enum('gender',['pria', 'wanita']);
            $table->string('penanggung_jawab');
            $table->string('agama', 50);
            $table->string('alamat');
            $table->string('notelp');
            $table->string('kontak_darurat');
            $table->string('notelp_darurat');
            $table->string('riwayat_sakit')->nullable();
            $table->string('asal_daerah');
            $table->string('ruang');
            $table->date('tgl_masuk');
            $table->date('tgl_keluar')->nullable();
            $table->boolean('meninggal')->nullable();
            $table->boolean('keluar')->nullable();
            $table->timestamps();
        });
    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penghuni');
    }
}
