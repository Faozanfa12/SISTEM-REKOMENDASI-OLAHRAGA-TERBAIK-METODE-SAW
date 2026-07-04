<?php
namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Alternatif;
use App\Models\SubKriteria;
use App\Models\NilaiPenyakit; // (Model baru)
use App\Models\HasilSaw;
use App\Models\Penyakit;
use Illuminate\Support\Facades\DB;

class SAWController extends Controller {

    /**
     * Menghitung SAW berdasarkan input hybrid (dinamis + statis).
     * $inputs berisi: 'penyakit_id', 'c1_sub_id', 'c3_sub_id', 'c5_sub_id'
     */
    public function hitung($inputs) {
        
        // 1. Ambil semua data master
        $kriteria = Kriteria::all();
        $alternatifList = Alternatif::all();
        
        // 2. Ambil nilai input dinamis (C1, C3, C5) dari pengguna
        $nilai_C1 = SubKriteria::find($inputs['c1_sub_id'])->nilai;
        $nilai_C3 = SubKriteria::find($inputs['c3_sub_id'])->nilai;
        $nilai_C5 = SubKriteria::find($inputs['c5_sub_id'])->nilai;

        // 3. Ambil nilai statis (C2, C4) dari DB berdasarkan penyakit
        $nilaiStatis = NilaiPenyakit::where('penyakit_id', $inputs['penyakit_id'])->get();

        // 4. Bangun Matriks Keputusan (X) secara dinamis
        $matriksKeputusan = [];
        foreach ($alternatifList as $alt) {
            // Ambil nilai statis C2 & C4 untuk alternatif ini
            $statis = $nilaiStatis->where('alternatif_id', $alt->id)->first();
            
            if ($statis) {
                $matriksKeputusan[] = [
                    'alternatif_id' => $alt->id,
                    'C1' => $nilai_C1, // Nilai C1 dari Input User
                    'C2' => $statis->nilai_C2, // Nilai C2 dari DB (statis)
                    'C3' => $nilai_C3, // Nilai C3 dari Input User
                    'C4' => $statis->nilai_C4, // Nilai C4 dari DB (statis)
                    'C5' => $nilai_C5, // Nilai C5 dari Input User

                ];
            }
        }

        if (empty($matriksKeputusan)) {
            return []; // Tidak ada data untuk dihitung
        }
        
        // 5. Tentukan Nilai Max (benefit) dan Min (cost)
        // Untuk kriteria dinamis (input user: C1, C3, C5) gunakan nilai dari tabel `sub_kriteria`
        // Untuk kriteria statis (nilai berbeda per alternatif) gunakan nilai dari matriks keputusan
        $dynamicCodes = ['C1', 'C3', 'C5'];
        $minMax = [];
        foreach ($kriteria as $k) {
            $kode = $k->kode_kriteria;

            if (in_array($kode, $dynamicCodes)) {
                // Ambil min/max dari data sub_kriteria untuk kriteria ini
                $subQuery = SubKriteria::where('kriteria_id', $k->id);
                if ($k->jenis == 'benefit') {
                    $minMax[$kode] = $subQuery->max('nilai') ?? 0;
                } else { // cost
                    $minMax[$kode] = $subQuery->min('nilai') ?? 0;
                }
            } else {
                // Gunakan nilai dari matriks keputusan (nilai bervariasi antar alternatif)
                $columnValues = array_column($matriksKeputusan, $kode);

                // Jika semua nilai sama, ambil salah satu (agar tidak membagi dengan 0)
                if (count(array_unique($columnValues)) === 1) {
                    $minMax[$kode] = $columnValues[0];
                } else if ($k->jenis == 'benefit') {
                    $minMax[$kode] = max($columnValues);
                } else { // cost
                    $minMax[$kode] = min($columnValues);
                }
            }
        }

        // 6. Normalisasi (r_ij)
        $matriksNormalisasi = [];
        foreach ($matriksKeputusan as $nilai) {
            $normalized = ['alternatif_id' => $nilai['alternatif_id']];
            foreach ($kriteria as $k) {
                $kode = $k->kode_kriteria;
                $x_ij = $nilai[$kode];

                // Jika max/min = 0 atau x_ij = 0 (untuk cost)
                if ($minMax[$kode] == 0 || ($k->jenis == 'cost' && $x_ij == 0)) {
                    $r_ij = 0;
                } else if ($k->jenis == 'benefit') {
                    $r_ij = $x_ij / $minMax[$kode];
                } else { // cost
                    $r_ij = $minMax[$kode] / $x_ij;
                }
                $normalized[$kode] = $r_ij;
            }
            $matriksNormalisasi[] = $normalized;
        }

        // 7. Perangkingan (V_i)
        $hasilAkhir = [];
        foreach ($matriksNormalisasi as $norm) {
            $v_i = 0;
            foreach ($kriteria as $k) {
                $kode = $k->kode_kriteria;
                $bobot = $k->bobot; // Menggunakan bobot statis 
                $r_ij = $norm[$kode];
                $v_i += ($bobot * $r_ij);
            }
            
            $alternatifModel = $alternatifList->find($norm['alternatif_id']);
            
            $hasilAkhir[] = [
                'alternatif_id' => $norm['alternatif_id'],
                'nama_alternatif' => $alternatifModel->nama_alternatif,
                'kode_alternatif' => $alternatifModel->kode_alternatif,
                'nilai_vi' => round($v_i * 100, 2)
            ];
        }

        // 8. Urutkan hasil
        usort($hasilAkhir, function ($a, $b) {
            return $b['nilai_vi'] <=> $a['nilai_vi'];
        });

        // 9. Tambahkan ranking
        foreach ($hasilAkhir as $index => $hasil) {
            $hasilAkhir[$index]['ranking'] = $index + 1;
        }

        return $hasilAkhir;
    }
    
    // Fungsi ini tidak lagi relevan untuk perhitungan, 
    // tapi bisa digunakan untuk membersihkan tabel 'hasil_saw' jika ada.
    public function hitungSemuaKondisi() 
    {
        // HAPUS KODE YANG MERUJUK KE 'hasil_saw' KARENA TABELNYA SUDAH TIDAK ADA
        
        // Fungsi ini sekarang hanya mengembalikan pesan sukses
        return redirect()->route('admin.dashboard')
            ->with('success', 'Perhitungan SAW sekarang 100% dinamis berdasarkan input pengguna.');
    }
}