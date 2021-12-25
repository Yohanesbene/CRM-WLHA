<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

class HistoryObatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data = array();

        for ($i = 0; $i < 1000; $i++) {
            $data[$i]['id_obat'] = rand(1, 134);
            $data[$i]['keterangan'] = Arr::random(['Pembelian', 'Pemakaian']);
            if ($data[$i]['keterangan'] == 'Pemakaian') {
                $data[$i]['stokobat'] = rand(10, 100) * -1;
            } else {
                $data[$i]['stokobat'] = rand(10, 1000);
            }
        }

        DB::table('tb_history_obat')->insert($data);
    }
}
