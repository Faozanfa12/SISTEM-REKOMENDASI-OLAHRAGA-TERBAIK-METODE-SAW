<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PanduanOlahraga;
use App\Models\Alternatif;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PanduanController extends Controller
{
    public function index()
    {
        $panduan = PanduanOlahraga::with('alternatif')->get();
        return view('admin.panduan.index', compact('panduan'));
    }

    public function create()
    {
        // Ambil alternatif yang BELUM punya panduan
        $alternatif = Alternatif::whereDoesntHave('panduan')->pluck('nama_alternatif', 'id');
        return view('admin.panduan.create', compact('alternatif'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'alternatif_id' => 'required|exists:alternatif,id|unique:panduan_olahraga',
            'deskripsi_umum' => 'required|string',
            'manfaat' => 'required|string',
            'durasi_ideal' => 'required|string',
            'batasan_medis' => 'required|string',
            'peringatan' => 'required|string',
        ]);

        PanduanOlahraga::create($request->all());

        return redirect()->route('admin.panduan.index')
                         ->with('success', 'Panduan olahraga berhasil ditambahkan.');
    }

    public function edit(PanduanOlahraga $panduan)
    {
        // Load relasi alternatif untuk ditampilkan di form edit
        $panduan->load('alternatif');
        return view('admin.panduan.edit', compact('panduan'));
    }

    public function update(Request $request, PanduanOlahraga $panduan)
    {
        $request->validate([
            'deskripsi_umum' => 'required|string',
            'manfaat' => 'required|string',
            'durasi_ideal' => 'required|string',
            'batasan_medis' => 'required|string',
            'peringatan' => 'required|string',
        ]);

        $panduan->update($request->all());

        return redirect()->route('admin.panduan.index')
                         ->with('success', 'Panduan olahraga berhasil diperbarui.');
    }

    public function destroy(PanduanOlahraga $panduan)
    {
        $panduan->delete();
        return redirect()->route('admin.panduan.index')
                         ->with('success', 'Panduan olahraga berhasil dihapus.');
    }

    // BENAR
    public function show(PanduanOlahraga $panduan) 
    {
        return view('panduan-olahraga.show', compact('panduan'));
    }

    public function downloadPDF(PanduanOlahraga $panduan)
    {
        // Load relasi alternatif
        $panduan->load('alternatif');
        
        // Gunakan tanda titik (.) untuk navigasi folder di dalam 'views'
        $pdf = Pdf::loadView('panduan-olahraga.pdf', ['panduan' => $panduan]);
        $namaFile = $panduan->alternatif->nama_alternatif . '.pdf';
        return $pdf->download($namaFile);
    }

    
}