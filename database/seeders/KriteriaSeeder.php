<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KriteriaSeeder extends Seeder {
    public function run(): void {
        DB::table('kriteria')->insert([
            ['kode_kriteria' => 'C1', 'nama_kriteria' => 'Usia', 'jenis' => 'benefit', 'bobot' => 0.15, 'deskripsi' => 'Kesesuaian olahraga dengan umur lansia'],
            ['kode_kriteria' => 'C2', 'nama_kriteria' => 'Kondisi Kesehatan', 'jenis' => 'cost', 'bobot' => 0.30, 'deskripsi' => 'Tingkat kesesuaian dengan kondisi medis lansia'],
            ['kode_kriteria' => 'C3', 'nama_kriteria' => 'Tujuan Olahraga', 'jenis' => 'benefit', 'bobot' => 0.15, 'deskripsi' => 'Kecocokan terhadap tujuan olahraga'],
            ['kode_kriteria' => 'C4', 'nama_kriteria' => 'Risiko Cedera', 'jenis' => 'cost', 'bobot' => 0.25, 'deskripsi' => 'Semakin tinggi risiko, semakin rendah nilai'],
            ['kode_kriteria' => 'C5', 'nama_kriteria' => 'Biaya', 'jenis' => 'cost', 'bobot' => 0.15, 'deskripsi' => 'Keterjangkauan biaya atau peralatan'],
        ]);
    }
}