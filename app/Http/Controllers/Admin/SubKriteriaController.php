<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubKriteria;
use App\Models\Kriteria;
use Illuminate\Http\Request;

class SubKriteriaController extends Controller
{
    public function index()
    {
        $subkriteria = SubKriteria::with('kriteria')->orderBy('kriteria_id')->get();
        return view('admin.subkriteria.index', compact('subkriteria'));
    }

    public function create()
    {
        // Hanya ambil kriteria dinamis (C1, C3, C5)
        $kriteria = Kriteria::whereIn('kode_kriteria', ['C1', 'C3', 'C5'])->get();
        return view('admin.subkriteria.create', compact('kriteria'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kriteria_id' => 'required|exists:kriteria,id',
            'pilihan' => 'required|string|max:255',
            'nilai' => 'required|numeric',
        ]);

        SubKriteria::create($request->all());
        return redirect()->route('admin.subkriteria.index')->with('success', 'Pilihan sub-kriteria berhasil ditambahkan.');
    }

    public function edit(SubKriteria $subkriterium)
    {
        $kriteria = Kriteria::whereIn('kode_kriteria', ['C1', 'C3', 'C5'])->get();
        return view('admin.subkriteria.edit', compact('subkriterium', 'kriteria'));
    }

    public function update(Request $request, SubKriteria $subkriterium)
    {
        $request->validate([
            'kriteria_id' => 'required|exists:kriteria,id',
            'pilihan' => 'required|string|max:255',
            'nilai' => 'required|numeric',
        ]);

        $subkriterium->update($request->all());
        return redirect()->route('admin.subkriteria.index')->with('success', 'Pilihan sub-kriteria berhasil diperbarui.');
    }

    public function destroy(SubKriteria $subkriterium)
    {
        $subkriterium->delete();
        return redirect()->route('admin.subkriteria.index')->with('success', 'Pilihan sub-kriteria berhasil dihapus.');
    }
}