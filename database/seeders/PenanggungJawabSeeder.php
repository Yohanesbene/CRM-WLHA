<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;


class PenanggungJawabSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];
        for($i = 0; $i <5; $i++){
            $data[] = array(
                'nama' => 'pj'.$i,
                'alamat' => 'jalan '.$i,
                'notelp' => '0123456789'.$i
            );
        }
        DB::table('penanggung_jawab')->insert($data);
    }
}
