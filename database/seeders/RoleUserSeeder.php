<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        if (Schema::hasTable('role_users')) {
            DB::table('role_users')->truncate();
        }

        DB::table('role_users')->insert([
            [
                'id' => 1,
                'keterangan' => 'admin',
                'kode' => 'ADM'
            ],
            [
                'id' => 2,
                'keterangan' => 'Manajer (Report Reader)',
                'kode' => 'MAN'
            ],
            [
                'id' => 3,
                'keterangan' => 'PJ (Perawat penanggung Jawab shift kerja)',
                'kode' => 'PPJ'
            ],
            [
                'id' => 4,
                'keterangan' => 'Asisten Perawat',
                'kode' => 'APR'
            ],
            [
                'id' => 5,
                'keterangan' => 'Fisioterapi',
                'kode' => 'FIS'
            ],
            [
                'id' => 6,
                'keterangan' => 'Farmasi',
                'kode' => 'FAR'
            ],
        ]);
    }
}
