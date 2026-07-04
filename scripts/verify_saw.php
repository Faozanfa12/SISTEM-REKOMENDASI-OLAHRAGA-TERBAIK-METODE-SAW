<?php

// Bootstrap Laravel
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Http\Controllers\SAWController;
use App\Models\Penyakit;
use App\Models\SubKriteria;

$controller = new SAWController();

function runFor($namaPenyakit) {
    $pen = Penyakit::where('nama_penyakit', $namaPenyakit)->first();
    if (! $pen) {
        echo "Penyakit '$namaPenyakit' tidak ditemukan\n";
        return;
    }

    // Ambil contoh SubKriteria ids (ambil satu opsi untuk tiap kriteria C1, C3, C5).
    $kC1 = App\Models\Kriteria::where('kode_kriteria', 'C1')->first();
    $kC3 = App\Models\Kriteria::where('kode_kriteria', 'C3')->first();
    $kC5 = App\Models\Kriteria::where('kode_kriteria', 'C5')->first();

    if (! $kC1 || ! $kC3 || ! $kC5) {
        echo "Kriteria C1/C3/C5 tidak lengkap di DB\n";
        return;
    }

    $c1Opt = SubKriteria::where('kriteria_id', $kC1->id)->first();
    $c3Opt = SubKriteria::where('kriteria_id', $kC3->id)->first();
    $c5Opt = SubKriteria::where('kriteria_id', $kC5->id)->first();

    $inputs = [
        'penyakit_id' => $pen->id,
        'c1_sub_id' => $c1Opt->id,
        'c3_sub_id' => $c3Opt->id,
        'c5_sub_id' => $c5Opt->id,
    ];

    global $controller;
    $res = $controller->hitung($inputs);

    echo "\n=== Hasil SAW untuk Penyakit: $namaPenyakit (id={$pen->id}) ===\n";
    foreach ($res as $r) {
        printf("%s (%s): Vi = %s%%, Ranking = %d\n", $r['nama_alternatif'], $r['kode_alternatif'], $r['nilai_vi'], $r['ranking']);
    }
}

runFor('Sehat');
runFor('Hipertensi');

echo "\nSelesai.\n";
