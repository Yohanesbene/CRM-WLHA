<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->string('id',20)->primary();
            // $table->string('username')->unique();

            // $table->boolean('status')->default(1);
            // $table->string('password');

            $table->string('nama');
            $table->string('NIK',16)->unique();
            $table->string('foto')->nullable();
            $table->date('tgl_lahir');
            $table->enum('gender',['pria', 'wanita']);
            $table->string('agama', 50);
            $table->string('alamat');
            $table->string('notelp');
            $table->date('mulaimasuk');
            $table->string('ijazah',150)->nullable();
            $table->string('title');
            $table->string('status_kepegawaian')->nullable(true);
            $table->text('pelatihan')->nullable(true);

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
