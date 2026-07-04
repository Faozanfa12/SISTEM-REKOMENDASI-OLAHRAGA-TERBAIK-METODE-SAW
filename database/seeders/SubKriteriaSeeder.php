<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Kriteria;

class SubKriteriaSeeder extends Seeder {
    public function run(): void {
        // Ambil ID Kriteria C1, C3, C5
        $k1 = Kriteria::where('kode_kriteria', 'C1')->first(); // Usia
        $k3 = Kriteria::where('kode_kriteria', 'C3')->first(); // Tujuan
        $k5 = Kriteria::where('kode_kriteria', 'C5')->first(); // Biaya

        DB::table('sub_kriteria')->insert([
            // Pilihan untuk C1 (Usia) - Nilai 9-6
            ['kriteria_id' => $k1->id, 'pilihan' => '60 - 64 Tahun', 'nilai' => 9],
            ['kriteria_id' => $k1->id, 'pilihan' => '65 - 69 Tahun', 'nilai' => 8],
            ['kriteria_id' => $k1->id, 'pilihan' => '70 - 74 Tahun', 'nilai' => 7],
            ['kriteria_id' => $k1->id, 'pilihan' => '>= 75 Tahun', 'nilai' => 6],
            
            // Pilihan untuk C3 (Tujuan) - Nilai 9-5
            ['kriteria_id' => $k3->id, 'pilihan' => 'Menjaga Keseimbangan & Relaksasi (Contoh: Tai Chi)', 'nilai' => 9],
            ['kriteria_id' => $k3->id, 'pilihan' => 'Memperkuat Otot & Kebugaran (Contoh: Senam)', 'nilai' => 8],
            ['kriteria_id' => $k3->id, 'pilihan' => 'Menjaga Fleksibilitas (Contoh: Yoga)', 'nilai' => 7],
            ['kriteria_id' => $k3->id, 'pilihan' => 'Kardio Ringan (Contoh: Jalan Kaki)', 'nilai' => 6],
            ['kriteria_id' => $k3->id, 'pilihan' => 'Kardio Sedang (Contoh: Bersepeda)', 'nilai' => 5],

            // Pilihan untuk C5 (Biaya) - Nilai 3-1 (Cost)
            ['kriteria_id' => $k5->id, 'pilihan' => 'Gratis / Tanpa Biaya', 'nilai' => 1],
            ['kriteria_id' => $k5->id, 'pilihan' => 'Murah (Membutuhkan alat sederhana)', 'nilai' => 2],
            ['kriteria_id' => $k5->id, 'pilihan' => 'Sedang (Membutuhkan tempat khusus/sepatu)', 'nilai' => 3],
        ]);
    }
}