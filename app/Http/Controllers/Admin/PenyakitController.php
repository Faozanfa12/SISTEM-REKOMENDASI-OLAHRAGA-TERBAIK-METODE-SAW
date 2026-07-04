<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penyakit;
use Illuminate\Http\Request;

class PenyakitController extends Controller
{
    public function index()
    {
        $penyakit = Penyakit::all();
        return view('admin.penyakit.index', compact('penyakit'));
    }

    public function create()
    {
        return view('admin.penyakit.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_penyakit' => 'required|string|max:255|unique:penyakit',
            'deskripsi' => 'nullable|string',
            'larangan' => 'nullable|string',
        ]);

        Penyakit::create($request->all());

        return redirect()->route('admin.penyakit.index')
                         ->with('success', 'Data penyakit berhasil ditambahkan.');
    }

    public function edit(Penyakit $penyakit)
    {
        return view('admin.penyakit.edit', compact('penyakit'));
    }

    public function update(Request $request, Penyakit $penyakit)
    {
        $request->validate([
            'nama_penyakit' => 'required|string|max:255|unique:penyakit,nama_penyakit,'.$penyakit->id,
            'deskripsi' => 'nullable|string',
            'larangan' => 'nullable|string',
        ]);

        // Proteksi agar 'Sehat' tidak bisa diubah namanya
        if ($penyakit->nama_penyakit == 'Sehat' && $request->nama_penyakit != 'Sehat') {
             return back()->withInput()->withErrors(['nama_penyakit' => 'Nama "Sehat" tidak boleh diubah.']);
        }

        $penyakit->update($request->all());

        return redirect()->route('admin.penyakit.index')
                         ->with('success', 'Data penyakit berhasil diperbarui.');
    }

    public function destroy(Penyakit $penyakit)
    {
        try {
            $penyakit->delete();
            return redirect()->route('admin.penyakit.index')
                             ->with('success', 'Data penyakit berhasil dihapus.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('admin.penyakit.index')
                             ->with('error', 'Gagal menghapus. Data ini mungkin terkait dengan Nilai Awal atau data lain yang terkait.');
        }
    }
}