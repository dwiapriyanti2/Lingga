<?php

namespace Database\Seeders;

use App\Models\Klasifikasi;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
        User::create([
            'name' => 'Wanda',
            'email' => 'wanda@example.com',
            'password' => Hash::make("12345678"),
            'level' => '1'
        ]);

        Klasifikasi::create([
            'kode_klasifikasi' => '01',
            'judul_klasifikasi' => 'Surat Jalan',
        ]);

        Klasifikasi::create([
            'kode_klasifikasi' => '02',
            'judul_klasifikasi' => 'Surat Cuti dan Libur',
        ]);

        Klasifikasi::create([
            'kode_klasifikasi' => '03',
            'judul_klasifikasi' => 'Surat Laporan',
        ]);

        Klasifikasi::create([
            'kode_klasifikasi' => '04',
            'judul_klasifikasi' => 'Surat Izin',
        ]);

        Klasifikasi::create([
            'kode_klasifikasi' => '05',
            'judul_klasifikasi' => 'Surat Kuasa',
        ]);
    }
}
