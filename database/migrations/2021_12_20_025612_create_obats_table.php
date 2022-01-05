<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateObatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_obat', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode_1', 1)->comment('D = Nama Dagang, G = Generik');
            $table->string('kode_2', 1)->comment('B = Obat Bebas, T = Obat Bebas Terbatas, K = Obat Keras, P = Psikotropika, N = Narkotika');
            $table->string('kode_3', 1)->comment('L = Lokal, I = Impor');
            $table->string('kode_4', 2)->comment('Tahun registrasi BPOM');
            $table->integer('kode_5')->comment('No urut pabrik');
            $table->integer('kode_6')->comment('No urut obat yang disetujui masing-masing pabrik');
            $table->string('kode_7', 2)->comment('Bentuk sediaan obat');
            $table->string('kode_8', 1)->comment('Kekuatan sediaan obat');
            $table->integer('kode_9')->comment('Kemasan berbeda untuk tiap nama, kekuatan, dan bentuk sediaan obat');
            $table->string('kode_slug', 15)->unique()->comment('Kode full');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->string('keterangan', 255)->default(' ');
            $table->double('harga')->default(0);
            $table->string('namaobat', 255);

            $table->unique(['kode_1', 'kode_2', 'kode_3', 'kode_4', 'kode_5', 'kode_6', 'kode_7', 'kode_8', 'kode_9'], 'unique_kode');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_obat');
    }
}
