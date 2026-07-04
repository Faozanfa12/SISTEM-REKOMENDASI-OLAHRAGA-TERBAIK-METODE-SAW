<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NilaiPenyakit;
use App\Models\Penyakit;
use App\Models\Alternatif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class NilaiPenyakitController extends Controller
{
    public function index(Request $request)
    {
        $penyakitList = Penyakit::all();
        $selectedPenyakitId = $request->input('penyakit_id', $penyakitList->first()->id);
        
        $matriks = NilaiPenyakit::where('penyakit_id', $selectedPenyakitId)
            ->with('alternatif')
            ->get();
            
        return view('admin.nilaipenyakit.index', compact('penyakitList', 'selectedPenyakitId', 'matriks'));
    }

    public function create(Request $request)
    {
        $penyakit = Penyakit::all();
        // Ambil alternatif yg belum punya nilai di penyakit_id yg dipilih
        $penyakitId = $request->get('penyakit_id', Penyakit::first()->id);
        $existingAlternatifIds = NilaiPenyakit::where('penyakit_id', $penyakitId)->pluck('alternatif_id');
        $alternatif = Alternatif::whereNotIn('id', $existingAlternatifIds)->get();
        
        return view('admin.nilaipenyakit.create', compact('penyakit', 'alternatif', 'penyakitId'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'penyakit_id' => [
                'required', 'exists:penyakit,id',
                Rule::unique('nilai_penyakit')->where(function ($query) use ($request) {
                    return $query->where('alternatif_id', $request->alternatif_id);
                }),
            ],
            'alternatif_id' => 'required|exists:alternatif,id',
            'nilai_C2' => 'required|numeric|min:0',
            'nilai_C4' => 'required|numeric|min:0',
        ],[
            'penyakit_id.unique' => 'Kombinasi Penyakit dan Alternatif ini sudah memiliki nilai.'
        ]);

        NilaiPenyakit::create($request->only(['penyakit_id','alternatif_id','nilai_C2','nilai_C4']));

        return redirect()->route('admin.nilai.penyakit.index', ['penyakit_id' => $request->penyakit_id])
                         ->with('success', 'Nilai C2/C4 berhasil ditambahkan.');
    }

    public function edit(NilaiPenyakit $nilaipenyakit)
    {
        $nilaipenyakit->load('penyakit', 'alternatif');
        return view('admin.nilaipenyakit.edit', compact('nilaipenyakit'));
    }

    public function update(Request $request, NilaiPenyakit $nilaipenyakit)
    {
        Log::info('NilaiPenyakitController@update called', ['id' => $nilaipenyakit->id, 'input' => $request->only(['nilai_C1','nilai_C2','nilai_C3','nilai_C4','nilai_C5'])]);
        // Form edit hanya mengizinkan perubahan untuk C2 dan C4,
        // jadi validasi dan update difokuskan pada dua field tersebut.
        $request->validate([
            'nilai_C2' => 'required|numeric|min:0',
            'nilai_C4' => 'required|numeric|min:0',
        ]);

        $nilaipenyakit->update($request->only(['nilai_C2','nilai_C4']));

        return redirect()->route('admin.nilai.penyakit.index', ['penyakit_id' => $nilaipenyakit->penyakit_id])
                         ->with('success', 'Nilai C1/C2/C3/C4/C5 berhasil diperbarui.');
    }

    public function destroy(NilaiPenyakit $nilaipenyakit)
    {
        $penyakitId = $nilaipenyakit->penyakit_id;
        $nilaipenyakit->delete();
        return redirect()->route('admin.nilai.penyakit.index', ['penyakit_id' => $penyakitId])
                         ->with('success', 'Nilai C2/C4 berhasil dihapus.');
    }
}