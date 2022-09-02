<?php

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
        // $this->call(UserSeeder::class);
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
            'foto' => 'default.jpg',
            'username' => 'admin',
            'password' => bcrypt('admin123'),
        ]);

        DB::table('acces')->insert([
            'user' => 1,
            'kelola_akun' => 1,
            'kelola_produk' => 1,
            'transaksi' => 1,
            'kelola_laporan' => 1,
        ]);
    }
}
