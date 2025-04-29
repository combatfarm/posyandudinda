<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class PenggunaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('pengguna')->insert([
            'nik' => '3509101901230007',
            'nama_ibu' => 'Elly Nur Azizah',
            'nama_anak' => 'Mohammad Iqbal Abdillah',
            'no_telp' => '081216530913',
            'alamat' => 'Karang Semanding',
            'tanggal_lahir' => '2005-05-19',
            'usia' => '20',
            'tempat_lahir' => 'Jember',
            'jenis_kelamin' => 'Laki-laki',
            'password' => Hash::make('password'),
            'created_at' => Carbon::parse('2025-03-12 10:09:37'),
            'updated_at' => Carbon::parse('2025-03-12 10:09:37'),
        ]);
    }
}
