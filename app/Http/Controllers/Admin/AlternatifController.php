<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alternatif;
use Illuminate\Http\Request;

class AlternatifController extends Controller
{
    public function index()
    {
        $alternatif = Alternatif::all();
        return view('admin.alternatif.index', compact('alternatif'));
    }

    public function create()
    {
        return view('admin.alternatif.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_alternatif' => 'required|string|max:10|unique:alternatif',
            'nama_alternatif' => 'required|string|max:255|unique:alternatif',
        ]);

        Alternatif::create($request->all());

        return redirect()->route('admin.alternatif.index')
                         ->with('success', 'Alternatif berhasil ditambahkan.');
    }

    public function edit(Alternatif $alternatif)
    {
        return view('admin.alternatif.edit', compact('alternatif'));
    }

    public function update(Request $request, Alternatif $alternatif)
    {
        $request->validate([
            'kode_alternatif' => 'required|string|max:10|unique:alternatif,kode_alternatif,'.$alternatif->id,
            'nama_alternatif' => 'required|string|max:255|unique:alternatif,nama_alternatif,'.$alternatif->id,
        ]);

        $alternatif->update($request->all());

        return redirect()->route('admin.alternatif.index')
                         ->with('success', 'Alternatif berhasil diperbarui.');
    }

    public function destroy(Alternatif $alternatif)
    {
        // Migrasi sudah di-set 'onDelete('cascade')'
        // jadi panduan dan nilai_awal akan ikut terhapus.
        try {
            $alternatif->delete();
            return redirect()->route('admin.alternatif.index')
                             ->with('success', 'Alternatif berhasil dihapus.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('admin.alternatif.index')
                             ->with('error', 'Gagal menghapus alternatif. Pastikan data terkait sudah dihapus.');
        }
    }
}