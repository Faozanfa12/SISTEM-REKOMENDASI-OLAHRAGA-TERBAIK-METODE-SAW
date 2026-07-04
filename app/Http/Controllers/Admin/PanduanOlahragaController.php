<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PanduanOlahraga;
use App\Models\Alternatif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PanduanOlahragaController extends Controller
{
    public function index()
    {
        $panduanOlahraga = PanduanOlahraga::with('alternatif')->get();
        return view('admin.panduan-olahraga.index', compact('panduanOlahraga'));
    }

    public function create()
    {
        $alternatifs = Alternatif::all();
        return view('admin.panduan-olahraga.create', compact('alternatifs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'alternatif_id' => 'required|exists:alternatif,id',
            'nama' => 'required|string|max:255',
            'deskripsi_singkat' => 'required|string',
            'deskripsi_umum' => 'required|string',
            'manfaat' => 'required|string',
            'durasi_ideal' => 'required|string',
            'batasan_medis' => 'required|string',
            'peringatan' => 'required|string',
            'tata_cara' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $path = $gambar->store('olahraga', 'public');
            $data['gambar'] = $path;
        }

        PanduanOlahraga::create($data);

        return redirect()->route('admin.panduan-olahraga.index')
            ->with('success', 'Panduan olahraga berhasil ditambahkan.');
    }

    public function edit(PanduanOlahraga $panduanOlahraga)
    {
        $alternatifs = Alternatif::all();
        return view('admin.panduan-olahraga.edit', compact('panduanOlahraga', 'alternatifs'));
    }

    public function update(Request $request, PanduanOlahraga $panduanOlahraga)
    {
        $request->validate([
            'alternatif_id' => 'required|exists:alternatif,id',
            'nama' => 'required|string|max:255',
            'deskripsi_singkat' => 'required|string',
            'deskripsi_umum' => 'required|string',
            'manfaat' => 'required|string',
            'durasi_ideal' => 'required|string',
            'batasan_medis' => 'required|string',
            'peringatan' => 'required|string',
            'tata_cara' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            // Delete old image
            if ($panduanOlahraga->gambar) {
                Storage::disk('public')->delete($panduanOlahraga->gambar);
            }
            
            $gambar = $request->file('gambar');
            $path = $gambar->store('olahraga', 'public');
            $data['gambar'] = $path;
        }

        $panduanOlahraga->update($data);

        return redirect()->route('admin.panduan-olahraga.index')
            ->with('success', 'Panduan olahraga berhasil diperbarui.');
    }

    public function destroy(PanduanOlahraga $panduanOlahraga)
    {
        if ($panduanOlahraga->gambar) {
            Storage::disk('public')->delete($panduanOlahraga->gambar);
        }
        
        $panduanOlahraga->delete();

        return redirect()->route('admin.panduan-olahraga.index')
            ->with('success', 'Panduan olahraga berhasil dihapus.');
    }
}