<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,           // 1. Akun Admin
            PenyakitSeeder::class,       // 2. Data Penyakit (Sehat, Hipertensi, dll)
            KriteriaSeeder::class,       // 3. Kriteria (C1-C5) & Bobot Statis
            SubKriteriaSeeder::class,    // 4. Pilihan dropdown C1, C3, C5
            AlternatifSeeder::class,     // 5. Daftar Olahraga
            PanduanOlahragaSeeder::class,  // 6. Panduan untuk olahraga
            NilaiPenyakitSeeder::class,    // 7. Nilai statis C2 & C4
        ]);
    }
}