<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::where('id','ADM-20211019-001')->delete();
        DB::table('users')->insert([
            'id' => 'ADM-20211019-001',
            'username' => 'admin',
            'id_level' => 1,
            'password' => Hash::make('admin123'),
            'nama' => 'Admin 1',
            'NIK' => '6543210987654321',
            'tgl_lahir' => '1985-01-01',
            'gender' => 'pria',
            'agama' => 'Islam',
            'alamat' => 'Wisma Lansia Harapan Asri',
            'notelp' => '081023456789',
            'mulaimasuk' => '2021-10-19',
            'ijazah' => 'ijazah_admin-20211019-001.jpg',
            'title' => 'admin',
        ]);

        //User
        User::where('id','APR-20211019-2001')->delete();
        DB::table('users')->insert([
            'id' => 'APR-20211019-001',
            'username' => 'perawat1',
            'id_level' => 2,
            'password' => Hash::make('perawat1'),
            'nama' => 'Perawat 1',
            'NIK' => '1234567890123456',
            'tgl_lahir' => '1995-10-01',
            'gender' => 'Wanita',
            'agama' => 'Islam',
            'alamat' => 'Wisma Lansia Harapan Asri',
            'notelp' => '081234567890',
            'mulaimasuk' => '2021-10-19',
            'ijazah' => 'ijazah_prw-20211019-001.jpg',
            'title' => 'perawat',

        ]);
    }
}
