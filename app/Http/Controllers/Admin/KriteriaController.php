<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kriteria;
use App\Models\SubKriteria;
use App\Models\NilaiPenyakit;
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    public function index()
    {
        $kriteria = Kriteria::all();
        return view('admin.kriteria.index', compact('kriteria'));
    }

    public function create()
    {
        return view('admin.kriteria.create');
    }

    public function store(Request $request)
    {
        // <-- PERUBAHAN: Simpan hasil validasi ke variabel
        $validatedData = $request->validate([
            'kode_kriteria' => 'required|string|max:10|unique:kriteria',
            'nama_kriteria' => 'required|string|max:255',
            'jenis'         => 'required|in:benefit,cost',
            'bobot'         => 'required|numeric|min:0|max:1',
        ]);

        // Validasi total bobot tidak lebih dari 1
        // <-- PERUBAHAN: Gunakan data dari $validatedData
        $totalBobot = Kriteria::sum('bobot') + $validatedData['bobot'];
        if ($totalBobot > 1) {
            return back()->withInput()->withErrors(['bobot' => 'Total bobot semua kriteria tidak boleh melebihi 1.']);
        }

        // <-- PERUBAHAN: Gunakan $validatedData, bukan $request->all()
        Kriteria::create($validatedData);
        return redirect()->route('admin.kriteria.index')->with('success', 'Kriteria berhasil ditambahkan.');
    }

    public function edit(Kriteria $kriterium)
    {
        return view('admin.kriteria.edit', ['kriteria' => $kriterium]);
    }

    public function update(Request $request, Kriteria $kriterium)
    {
        // <-- PERUBAHAN: Simpan hasil validasi ke variabel
        $validatedData = $request->validate([
            'nama_kriteria' => 'required|string|max:255',
            'jenis'         => 'required|in:benefit,cost',
            'bobot'         => 'required|numeric|min:0|max:1',
        ]);

        // Validasi total bobot
        $totalBobotLain = Kriteria::where('id', '!=', $kriterium->id)->sum('bobot');
        
        // <-- PERUBAHAN: Gunakan data dari $validatedData
        if (($totalBobotLain + $validatedData['bobot']) > 1) {
            return back()->withInput()->withErrors(['bobot' => 'Total bobot semua kriteria tidak boleh melebihi 1.']);
        }

        // <-- PERUBAHAN: Gunakan $validatedData, bukan $request->all()
        $kriterium->update($validatedData);
        return redirect()->route('admin.kriteria.index')->with('success', 'Kriteria berhasil diperbarui.');
    }

    public function destroy(Kriteria $kriterium)
    {
        // Cek apakah masih ada SubKriteria terkait
        if (SubKriteria::where('kriteria_id', $kriterium->id)->exists()) {
            return redirect()->route('admin.kriteria.index')
                ->with('error', 'Kriteria tidak dapat dihapus karena masih memiliki Pilihan (Sub-Kriteria).');
        }

        // Cek apakah kolom nilai_C{n} ada dan dipakai di tabel nilai_penyakit
        $col = 'nilai_C' . $kriterium->id;
        if (Schema::hasColumn('nilai_penyakit', $col)) {
            if (NilaiPenyakit::whereNotNull($col)->where($col, '!=', 0)->exists()) {
                return redirect()->route('admin.kriteria.index')
                    ->with('error', 'Kriteria tidak dapat dihapus karena masih digunakan pada data nilai penyakit.');
            }
        }

        $kriterium->delete();
        return redirect()->route('admin.kriteria.index')->with('success', 'Kriteria berhasil dihapus.');
    }
}