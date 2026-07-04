<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\Penyakit;
use App\Models\NilaiPenyakit; // <-- GANTI DARI HasilSaw
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Data untuk Stat Cards
        $totalAlternatif = Alternatif::count();
        $totalKriteria = Kriteria::count();
        $totalPenyakit = Penyakit::where('nama_penyakit', '!=', 'Sehat')->count();
        
        // --- LOGIKA BARU UNTUK GRAFIK ---
        $penyakitList = Penyakit::all();
        $selectedPenyakitId = $request->input('penyakit_id', $penyakitList->first()->id);
        $selectedPenyakit = $penyakitList->find($selectedPenyakitId); // Ambil model lengkapnya
        
        // Ambil data C2/C4 statis dari tabel nilai_penyakit
        $dataStatis = NilaiPenyakit::where('penyakit_id', $selectedPenyakitId)
            ->with('alternatif')
            ->get();
            
        $labels = $dataStatis->pluck('alternatif.nama_alternatif');
        $dataC2 = $dataStatis->pluck('nilai_C2'); // Data untuk C2
        $dataC4 = $dataStatis->pluck('nilai_C4'); // Data untuk C4

        return view('admin.dashboard', compact(
            'totalAlternatif', 
            'totalKriteria', 
            'totalPenyakit',
            'penyakitList',
            'selectedPenyakitId',
            'selectedPenyakit', // <-- Kirim data ini
            'labels',
            'dataC2', // <-- Kirim data C2
            'dataC4'  // <-- Kirim data C4
        ));
    }
}