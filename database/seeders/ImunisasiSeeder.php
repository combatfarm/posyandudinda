<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class ImunisasiSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('imunisasi')->insert([
            'nama_anak' => 'Adinda Widya Putri',
            'tanggal_imunisasi' => '2025-03-08',
            'imunisasi' => 'Vaksin Rubela',
            'status' => 'Tidak Selesai',
            'created_at' => Carbon::parse('2025-03-07 15:21:47'),
            'updated_at' => Carbon::parse('2025-03-07 15:21:47'),
        ]);
    }
}
