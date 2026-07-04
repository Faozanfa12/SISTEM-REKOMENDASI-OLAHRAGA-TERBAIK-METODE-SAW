<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Alternatif;
use App\Models\Penyakit;

class NilaiPenyakitSeeder extends Seeder {
    public function run(): void {
        $alt = Alternatif::pluck('id', 'nama_alternatif');
        $pen = Penyakit::pluck('id', 'nama_penyakit');

        $data = [
            // ===== SEHAT (C2, C4) - Data dari Tabel 2.4 [cite: 308] =====
            // SEHAT (mengikut tabel manual)
            ['penyakit_id' => $pen['Sehat'], 'alternatif_id' => $alt['Jalan Kaki'], 'nilai_C1' => 9, 'nilai_C2' => 2, 'nilai_C3' => 6, 'nilai_C4' => 2, 'nilai_C5' => 1],
            ['penyakit_id' => $pen['Sehat'], 'alternatif_id' => $alt['Senam Lansia'], 'nilai_C1' => 8, 'nilai_C2' => 3, 'nilai_C3' => 8, 'nilai_C4' => 3, 'nilai_C5' => 2],
            ['penyakit_id' => $pen['Sehat'], 'alternatif_id' => $alt['Yoga Ringan'], 'nilai_C1' => 8, 'nilai_C2' => 2, 'nilai_C3' => 7, 'nilai_C4' => 2, 'nilai_C5' => 2],
            ['penyakit_id' => $pen['Sehat'], 'alternatif_id' => $alt['Bersepeda Pelan'], 'nilai_C1' => 7, 'nilai_C2' => 4, 'nilai_C3' => 5, 'nilai_C4' => 4, 'nilai_C5' => 3],
            ['penyakit_id' => $pen['Sehat'], 'alternatif_id' => $alt['Tai Chi'], 'nilai_C1' => 8, 'nilai_C2' => 3, 'nilai_C3' => 9, 'nilai_C4' => 2, 'nilai_C5' => 2],
            
            // ===== HIPERTENSI (C2, C4) - Data dari Tabel 2.5 [cite: 349] =====
            // HIPERTENSI (mengikut tabel manual)
            ['penyakit_id' => $pen['Hipertensi'], 'alternatif_id' => $alt['Jalan Kaki'], 'nilai_C1' => 6, 'nilai_C2' => 4, 'nilai_C3' => 6, 'nilai_C4' => 4, 'nilai_C5' => 1],
            ['penyakit_id' => $pen['Hipertensi'], 'alternatif_id' => $alt['Senam Lansia'], 'nilai_C1' => 8, 'nilai_C2' => 3, 'nilai_C3' => 8, 'nilai_C4' => 3, 'nilai_C5' => 2],
            ['penyakit_id' => $pen['Hipertensi'], 'alternatif_id' => $alt['Yoga Ringan'], 'nilai_C1' => 7, 'nilai_C2' => 2, 'nilai_C3' => 7, 'nilai_C4' => 2, 'nilai_C5' => 2],
            ['penyakit_id' => $pen['Hipertensi'], 'alternatif_id' => $alt['Bersepeda Pelan'], 'nilai_C1' => 4, 'nilai_C2' => 5, 'nilai_C3' => 4, 'nilai_C4' => 5, 'nilai_C5' => 3],
            ['penyakit_id' => $pen['Hipertensi'], 'alternatif_id' => $alt['Tai Chi'], 'nilai_C1' => 8, 'nilai_C2' => 3, 'nilai_C3' => 9, 'nilai_C4' => 2, 'nilai_C5' => 2],
            
            // (Data lain bisa ditambahkan oleh Admin)
        ];
        DB::table('nilai_penyakit')->insert($data);
    }
}