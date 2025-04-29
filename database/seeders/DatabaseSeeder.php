<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            PosyanduSeeder::class,
            // ArtikelSeeder::class,
            // DataAnakSeeder::class,
            // DataOrangtuaSeeder::class,
            // ImunisasiSeeder::class,
            // JadwalSeeder::class,
            // PenggunaSeeder::class,
            // PerkembanganAnakSeeder::class,
            // PetugasSeeder::class,
            // StuntingSeeder::class,
            // VitaminSeeder::class,
        ]);
    }
}
