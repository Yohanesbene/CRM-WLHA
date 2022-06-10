<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Schema;

class MobilitasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        if (Schema::hasTable('mobilitas')) {
            DB::table('mobilitas')->truncate();
        }

        $data = array();

        for($i=0; $i<10; $i++){
            $row['id_penghuni'] = 1;
            $row['tujuan'] = "Tujuan tujuan ".$i;
            $row['petugas_keluar'] = 'APR-20211019-001';

            $data[] = $row;
        }

        DB::table('mobilitas')->insert($data);
    }
}
