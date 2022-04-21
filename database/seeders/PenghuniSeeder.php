<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

use Carbon\Carbon;

class PenghuniSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];
        for($i = 1; $i < 20; $i++){
            $tgl_lahir = Carbon::now()->subYears(random_int(30,50));
            $tgl_masuk = Carbon::now()->subYears(random_int(2,10));
            $jenis_kelamin = random_int(0,1);
            $data[] = array(
                'penanggung_jawab'=> 'Nama PJ '.$i,
                'kontak_darurat' => 'Nama Kontak '.$i,
                'notelp_darurat' => '987654321'.$i,
                'nama'=>'penghuni '.$i,
                'no_induk'=>$tgl_masuk->format('m').'.'.$tgl_masuk->format('Y').'.0'.($jenis_kelamin+1).'.'.$tgl_lahir->format('mdY'),
                'tgl_lahir'=> $tgl_lahir,
                'gender'=>'pria',
                'agama'=>'katolik',
                'alamat'=>'jalan '.$i,
                'notelp' => '0123456789'.$i,
                'asal_daerah' => 'daerah '.$i,
                'ruang' => 'ruang '.$i,
                'tgl_masuk'=> $tgl_masuk,
                'meninggal' => 0,
                'keluar' => 0
            );
        }
        DB::table('penghuni')->insert($data);
    }
}
