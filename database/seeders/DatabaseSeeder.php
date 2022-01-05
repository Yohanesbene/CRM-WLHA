<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

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
        $this->call(RoleUserSeeder::class);
        // $this->call(PegawaiSeeder::class);
        // $this->call(PjSeeder::class);
        // $this->call(PenghuniSeeder::class);
        $this->call(UserSeeder::class);

        $this->call(ObatSeeder::class);
        $this->call(HistoryObatSeeder::class);
    }
}
