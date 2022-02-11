<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMcuPemberianObatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mcu_pemberian_obat', function (Blueprint $table) {
            // $table->id();
            $table->increments('id');
            $table->string('id_pegawai',20);
            $table->foreign('id_pegawai')
                ->references('id')
                ->on('users');

            $table->unsignedInteger('id_penghuni');
            $table->foreign('id_penghuni')
                ->references('id')
                ->on('penghuni');

            // $table->string('id_obat');
            // $table->foreign('id_obat')
            //     ->references('id')
            //     ->on('obat');

            // $table->float('dosis',5,2);
            // $table->integer('id_cek_obat');
            // $table->foreign('id_cek_obat')
            //     ->references('id')
            //     ->on('cek_obat');

            $table->text('efek_samping');
            $table->datetime('waktu');
            $table->integer('deleted')->unsigned()->nullable()->default(0);

            // $table->timestamps();
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
