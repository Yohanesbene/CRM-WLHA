<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class McuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // pemberian obat
        if (Schema::hasTable('mcu_pemberian_obat')) {
            DB::table('mcu_pemberian_obat')->truncate();
        };

        $data = [];
        $dikonsumsi = ['diminum', 'tidak diminum', 'jatuh'];
        for($i =0; $i < 90; $i++){
            $data[] = [
                'id_pegawai' => 'APR-20211019-001',
                'id_penghuni' => 1,
                'id_obat' => rand(1,160),
                'dosis' => 1,
                'waktu' => now(),
                'id_pegawai_cek' => 'APR-20211019-001',
                'waktu_cek' => now(),
                'dikonsumsi' => $dikonsumsi[rand(0,2)]
            ];
        }
        
        DB::table('mcu_pemberian_obat')->insert($data);

        $data = [];
        for($i =0; $i < 10; $i++){
            $data[] = [
                'id_pegawai' => 'APR-20211019-001',
                'id_penghuni' => 1,
                'id_obat' => rand(1,160),
                'dosis' => 1,
                'waktu' => now(),
                'id_pegawai_cek' => null,
                'waktu_cek' => null,
                'dikonsumsi' => null
            ];
        }

        DB::table('mcu_pemberian_obat')->insert($data);

        // berat badan
        if (Schema::hasTable('mcu_berat_badan')) {
            DB::table('mcu_berat_badan')->truncate();
        };

        $data = [];
        for($i =0; $i < 100; $i++){
            $data[] = [
                'id_pegawai' => 'APR-20211019-001',
                'id_penghuni' => 1,
                'hasil' => rand(60,80),
                'waktu' => now(),
            ];
        }

        DB::table('mcu_berat_badan')->insert($data);
        
        // nadi
        if (Schema::hasTable('mcu_nadi')) {
            DB::table('mcu_nadi')->truncate();
        };
    
        $data = [];
        for($i =0; $i < 100; $i++){
            $data[] = [
                'id_pegawai' => 'APR-20211019-001',
                'id_penghuni' => 1,
                'hasil' => rand(60,80),
                'waktu' => now(),
            ];
        }
    
        DB::table('mcu_nadi')->insert($data);
        
        // suhu_badan
        if (Schema::hasTable('mcu_suhu_badan')) {
            DB::table('mcu_suhu_badan')->truncate();
        };
    
        $data = [];
        for($i =0; $i < 100; $i++){
            $data[] = [
                'id_pegawai' => 'APR-20211019-001',
                'id_penghuni' => 1,
                'hasil' => rand(36,38) + (1/rand(1,10)),
                'waktu' => now(),
            ];
        }
    
        DB::table('mcu_suhu_badan')->insert($data);
        
        // spo2
        if (Schema::hasTable('mcu_spo2')) {
            DB::table('mcu_spo2')->truncate();
        };
    
        $data = [];
        for($i =0; $i < 100; $i++){
            $data[] = [
                'id_pegawai' => 'APR-20211019-001',
                'id_penghuni' => 1,
                'hasil' => 100,
                'waktu' => now(),
            ];
        }
    
        DB::table('mcu_spo2')->insert($data);
        
        // tekanan_darah
        if (Schema::hasTable('mcu_tekanan_darah')) {
            DB::table('mcu_tekanan_darah')->truncate();
        };
    
        $data = [];
        for($i =0; $i < 100; $i++){
            $data[] = [
                'id_pegawai' => 'APR-20211019-001',
                'id_penghuni' => 1,
                'sistole' => rand(11,14) * 10,
                'diastole' => rand(5,8) * 10,
                'waktu' => now(),
            ];
        }
    
        DB::table('mcu_tekanan_darah')->insert($data);
        
        // spo2
        if (Schema::hasTable('mcu_spo2')) {
            DB::table('mcu_spo2')->truncate();
        };
    
        $data = [];
        for($i =0; $i < 100; $i++){
            $data[] = [
                'id_pegawai' => 'APR-20211019-001',
                'id_penghuni' => 1,
                'hasil' => 100,
                'waktu' => now(),
            ];
        }
    
        DB::table('mcu_spo2')->insert($data);
        
        // nutrisi
        if (Schema::hasTable('mcu_nutrisi')) {
            DB::table('mcu_nutrisi')->truncate();
        };
    
        $data = [];
        $timeframe = ['pagi', 'siang', 'sore'];
        for($i =0; $i < 100; $i++){
            $data[$i] = [
                'id_pegawai' => 'APR-20211019-001',
                'id_penghuni' => 1,
                'waktu' => now(),
            ];
            $k = $timeframe[rand(0,2)];
            $data[$i][$k] = 1;
        }
    
        DB::table('mcu_nutrisi')->insert($data);

        // cairan
        if (Schema::hasTable('mcu_cairan')) {
            DB::table('mcu_cairan')->truncate();
        };
    
        $data = [];
        $timeframe = ['pagi', 'siang', 'sore'];
        for($i = 0; $i < 100; $i++){
            $data[$i] = [
                'id_pegawai' => 'APR-20211019-001',
                'id_penghuni' => 1,
                'waktu' => now(),
            ];
            $k = $timeframe[rand(0,2)];
            $data[$i][$k] = 100;
        }
    
        DB::table('mcu_cairan')->insert($data);
    }
}
