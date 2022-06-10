<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        // $this->call(PegawaiSeeder::class);
        // $this->call(PjSeeder::class);
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $this->call(UserSeeder::class);
        $this->call(RoleUserSeeder::class);

        $this->call(ObatSeeder::class);
        $this->call(HistoryObatSeeder::class);
        $this->call(PenanggungJawabSeeder::class);
        $this->call(PenghuniSeeder::class);
        $this->call(McuSeeder::class);
        $this->call(MobilitasSeeder::class);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
