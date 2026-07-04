<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penyakit;
use App\Models\PanduanOlahraga;
use App\Models\Kriteria;
use App\Models\SubKriteria;
use App\Http\Controllers\SAWController;

class UserController extends Controller {
    
    public function index() {
        $penyakit = Penyakit::all();
        
        // Ambil data untuk 3 dropdown dinamis
        $kriteriaC1 = Kriteria::where('kode_kriteria', 'C1')->first();
        $kriteriaC3 = Kriteria::where('kode_kriteria', 'C3')->first();
        $kriteriaC5 = Kriteria::where('kode_kriteria', 'C5')->first();
        
        $options_c1 = SubKriteria::where('kriteria_id', $kriteriaC1->id)->get();
        $options_c3 = SubKriteria::where('kriteria_id', $kriteriaC3->id)->get();
        $options_c5 = SubKriteria::where('kriteria_id', $kriteriaC5->id)->get();

        return view('user.index', compact(
            'penyakit', 'options_c1', 'options_c3', 'options_c5'
        ));
    }

    public function getRekomendasi(Request $request) {
        $request->validate([
            'kondisi' => 'required',
            'penyakit_id' => 'required_if:kondisi,sakit|exists:penyakit,id',
            'c1_sub_id' => 'required|exists:sub_kriteria,id', // C1 Usia
            'c3_sub_id' => 'required|exists:sub_kriteria,id', // C3 Tujuan
            'c5_sub_id' => 'required|exists:sub_kriteria,id', // C5 Biaya
        ]);

        $penyakitId = $request->kondisi == 'sehat' 
            ? Penyakit::where('nama_penyakit', 'Sehat')->first()->id 
            : $request->penyakit_id;

        $penyakit = Penyakit::findOrFail($penyakitId);

        // Kumpulkan semua input
        $inputs = [
            'penyakit_id' => $penyakitId,
            'c1_sub_id' => $request->c1_sub_id,
            'c3_sub_id' => $request->c3_sub_id,
            'c5_sub_id' => $request->c5_sub_id
        ];

        // Panggil SAWController untuk menghitung
        $sawController = new SAWController();
        $hasilRekomendasi = $sawController->hitung($inputs);

        return view('user.hasil', compact('hasilRekomendasi', 'penyakit'));
    }
    
    // Fungsi showPanduan (tetap sama)
    public function showPanduan($id) {
        $panduan = PanduanOlahraga::where('alternatif_id', $id)
            ->with('alternatif')
            ->firstOrFail();
            
        return response()->json($panduan);
    }
}