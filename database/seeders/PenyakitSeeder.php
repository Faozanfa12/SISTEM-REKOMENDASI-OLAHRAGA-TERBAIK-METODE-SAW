<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenyakitSeeder extends Seeder {
    public function run(): void {
        DB::table('penyakit')->insert([
            ['nama_penyakit' => 'Sehat', 'deskripsi' => 'Kondisi fisik normal tanpa keluhan penyakit kronis.', 'larangan' => 'Tidak ada larangan khusus, namun tetap perhatikan kemampuan tubuh.'],
            ['nama_penyakit' => 'Hipertensi', 'deskripsi' => 'Tekanan darah tinggi.', 'larangan' => 'Hindari olahraga intensitas tinggi, menahan napas, dan posisi kepala di bawah jantung (inversi).'],
            ['nama_penyakit' => 'Diabetes Mellitus', 'deskripsi' => 'Kadar gula darah tinggi.', 'larangan' => 'Periksa gula darah sebelum/sesudah olahraga. Hindari olahraga jika gula darah terlalu tinggi/rendah. Selalu bawa permen/sumber gula cepat.'],
            ['nama_penyakit' => 'Penyakit Jantung', 'deskripsi' => 'Gangguan pada fungsi jantung.', 'larangan' => 'DILARANG berolahraga berat. Hindari aktivitas yang memicu nyeri dada atau sesak napas. Selalu dalam pengawasan.'],
            ['nama_penyakit' => 'Osteoartritis', 'deskripsi' => 'Radang sendi, terutama pada lutut atau panggul.', 'larangan' => 'Hindari olahraga high-impact seperti melompat atau lari. Jangan membebani sendi yang sakit.'],
        ]);
    }
}