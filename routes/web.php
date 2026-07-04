<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SAWController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KriteriaController;
use App\Http\Controllers\Admin\AlternatifController;
use App\Http\Controllers\Admin\PenyakitController;
use App\Http\Controllers\Admin\NilaiAwalController;
use App\Http\Controllers\Admin\PanduanController;
use App\Http\Controllers\Admin\PanduanOlahragaController;
use App\Models\Kriteria;
use App\Models\Penyakit;
use App\Models\NilaiPenyakit;
use App\Models\SubKriteria;
use Illuminate\Http\Request;


// Rute Bawaan Auth
Auth::routes();

// ========================
// RUTE USER (LANSIA)
// ========================
Route::get('/', [UserController::class, 'index'])->name('user.index');
Route::post('/rekomendasi', [UserController::class, 'getRekomendasi'])->name('user.rekomendasi');
Route::get('/panduan/{id}', [UserController::class, 'showPanduan'])->name('user.panduan');

// Panduan Olahraga Routes
Route::get('/panduan-olahraga', [App\Http\Controllers\PanduanOlahragaController::class, 'index'])->name('panduan-olahraga.index');
Route::get('/panduan-olahraga/{id}', [App\Http\Controllers\PanduanOlahragaController::class, 'show'])->name('panduan-olahraga.show');

// TAMBAHKAN BARIS INI:
// Route BARU untuk menangani download PDF
Route::get('/panduan-olahraga/{panduan}/download', [PanduanController::class, 'downloadPDF'])
    ->name('panduan-olahraga.download');

// ========================
// RUTE ADMIN (DIPERBARUI)
// ========================
use App\Http\Controllers\Admin\SubKriteriaController; // <-- TAMBAHKAN
use App\Http\Controllers\Admin\NilaiPenyakitController; // <-- TAMBAHKAN

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // CRUD
    Route::resource('kriteria', KriteriaController::class);
    Route::resource('alternatif', AlternatifController::class);
    Route::resource('penyakit', PenyakitController::class);
    Route::resource('panduan', PanduanController::class);
    Route::resource('panduan-olahraga', PanduanOlahragaController::class);
    
    // HAPUS INI:
    // Route::resource('nilai', NilaiAwalController::class); 
    
    // TAMBAHKAN DUA INI:
    Route::resource('subkriteria', SubKriteriaController::class);
    Route::resource('nilaipenyakit', NilaiPenyakitController::class)->names([
        'index' => 'nilai.penyakit.index',
        'create' => 'nilai.penyakit.create',
        'store' => 'nilai.penyakit.store',
        'show' => 'nilai.penyakit.show',
        'edit' => 'nilai.penyakit.edit',
        'update' => 'nilai.penyakit.update',
        'destroy' => 'nilai.penyakit.destroy',
    ]);

    // TAMBAHKAN BARIS INI UNTUK TOMBOL "HITUNG ULANG"
    Route::get('saw/hitung', [SAWController::class, 'hitungSemuaKondisi'])->name('saw.hitung');
});

use Illuminate\Support\Facades\Schema;

Route::get('/tentang-saw', function (Request $request) {
    // 1. AMBIL DATA
    $kriteria = Kriteria::orderBy('id', 'asc')->get();

    // Mapping Kode & Kolom DB Manual
    foreach ($kriteria as $k) {
        $k->kode_final = 'C' . $k->id; 
        $k->col_db = 'nilai_c' . $k->id; 
    }

    $penyakit = Penyakit::where('nama_penyakit', 'like', '%Sehat%')->first();
    if (!$penyakit) $penyakit = Penyakit::first(); 

    // ambil data nilai alternatif untuk penyakit yang dipilih
    $dataNilai = NilaiPenyakit::with('alternatif')
        ->where('penyakit_id', $penyakit->id)
        ->get();

    // Ambil pilihan SubKriteria per-kriteria untuk ditampilkan di view
    foreach ($kriteria as $k) {
        $k->subkriteria = SubKriteria::where('kriteria_id', $k->id)->orderBy('id')->get();
    }

    // Baca pilihan user (GET) -> selected_subkriteria[k_id] = subkriteria_id
    $selected = $request->input('selected_subkriteria', []);
    $selectedValues = [];
    foreach ($selected as $k_id => $sub_id) {
        if ($sub_id) {
            $s = SubKriteria::find($sub_id);
            if ($s) $selectedValues[$k_id] = floatval($s->nilai ?? $s->value ?? 0);
        }
    }

    // 2. LOGIKA SAW (Cari Min/Max)
    // Perhatian: jika user memilih SubKriteria untuk suatu kriteria, gunakan nilai tersebut
    // sebagai pengganti nilai 0 pada setiap alternatif sebelum menghitung min/max.
    $minMax = [];
    foreach ($kriteria as $k) {
        $col = $k->col_db; 
        $sample = $dataNilai->first();
        if ($sample && !isset($sample->$col)) {
             $col = 'nilai_C' . $k->id;
             $k->col_db = $col;
        }

        // Jika subkriteria tersedia di DB untuk kriteria ini, gunakan min/max dari subkriteria
        $subVals = $k->subkriteria->pluck('nilai')->map(fn($v) => floatval($v))->filter()->values()->toArray();
        if (count($subVals) > 0) {
            $minMax[$k->kode_final] = ['min' => min($subVals), 'max' => max($subVals)];
            continue;
        }

        // Otherwise compute from alternatif values (with substitution of selected subkriteria)
        $vals = [];
        foreach ($dataNilai as $row) {
            $raw = $row->$col ?? 0;
            $useVal = $raw;
            if ($raw == 0 && isset($selectedValues[$k->id])) {
                $useVal = $selectedValues[$k->id];
            }
            $vals[] = $useVal;
        }

        if (count($vals) > 0) {
            $minMax[$k->kode_final] = ['min' => min($vals), 'max' => max($vals)];
        } else {
            $minMax[$k->kode_final] = ['min' => 0, 'max' => 1];
        }
    }

    // 3. HITUNG & BUAT STRING PERHITUNGAN
    $hasilAkhir = [];
    foreach ($dataNilai as $row) {
        $totalNilaiV = 0;
        $normValues = [];
        $rumusPerhitunganV = []; // Array untuk menyimpan string "(0.15 x 1)"
        $displayValues = []; // values to show in decision matrix (after substitution)

        foreach ($kriteria as $k) {
            $col = $k->col_db;
            $kode = $k->kode_final;
            // Ambil nilai asli; jika 0 dan user memilih subkriteria, ganti dengan nilai sub
            $orig = $row->$col ?? 0;
            $val = $orig;
            if ($orig == 0 && isset($selectedValues[$k->id])) {
                $val = $selectedValues[$k->id];
            }

            // display value: show substituted value if replacement occurred, else show original
            $displayValues[$kode] = $val;

            $bobot = $k->bobot;
            $jenis = strtolower($k->jenis);
            $mm = $minMax[$kode];

            // --- PERHITUNGAN NORMALISASI (STEP 2) ---
            $r = 0;
            $rumusR = ""; // String "9 / 9"

            if (str_contains($jenis, 'benefit') && $mm['max'] > 0) {
                $r = $val / $mm['max'];
                // Buat string rumus: Nilai / Max
                $rumusR = "$val ÷ {$mm['max']}"; 
            } elseif (str_contains($jenis, 'cost') && $val > 0) {
                $r = $mm['min'] / $val;
                // Buat string rumus: Min / Nilai
                $rumusR = "{$mm['min']} ÷ $val";
            }

            // Simpan data lengkap untuk View
            $normValues[$kode] = [
                'nilai' => $r,
                'rumus' => $rumusR // Ini yang akan ditampilkan (9 ÷ 9)
            ];

            // --- PERHITUNGAN PREFERENSI (STEP 3) ---
            $hasilKali = $r * $bobot;
            $totalNilaiV += $hasilKali;
            
            // Buat string rumus: (Bobot x R)
            // Contoh: (0.15 x 1)
            $r_rounded = number_format($r, 2); // Dibulatkan biar rapi di string
            $rumusPerhitunganV[] = "($bobot × $r_rounded)";
        }

        // Gabungkan array rumus V menjadi string panjang
        // Contoh: "(0.15 × 1) + (0.3 × 1) + ..."
        $stringV = implode(' + ', $rumusPerhitunganV);

        $hasilAkhir[] = [
            'nama' => $row->alternatif->nama_alternatif ?? $row->alternatif->nama ?? 'Alt-' . $row->id,
            'raw_data' => $row,
            'display_values' => $displayValues,
            'norm_values' => $normValues,
            'nilai_akhir' => $totalNilaiV,
            'string_v' => $stringV // <--- Ini string lengkap perhitungannya
        ];
    }

    usort($hasilAkhir, function ($a, $b) {
        return $b['nilai_akhir'] <=> $a['nilai_akhir'];
    });

    return view('tentang-saw.index', compact('kriteria', 'penyakit', 'hasilAkhir', 'minMax'));
})->name('tentang-saw');