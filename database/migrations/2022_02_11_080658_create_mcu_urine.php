<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMcuUrine extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mcu_urine', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_pegawai', 20);
            $table->foreign('id_pegawai')
                ->references('id')
                ->on('users');
            $table->unsignedInteger('id_penghuni');
            $table->foreign('id_penghuni')
                ->references('id')
                ->on('penghuni');
            $table->string('pagi', 20)->nullable();
            $table->string('siang', 20)->nullable();
            $table->string('sore', 20)->nullable();
            $table->timestamp('waktu')->useCurrent();
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
        Schema::dropIfExists('mcu_urine');
    }
}
