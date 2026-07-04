<?php

namespace App\Http\Controllers;

use App\Models\PanduanOlahraga;
use Illuminate\Http\Request;

class PanduanOlahragaController extends Controller
{
    public function index()
    {
        $panduanOlahraga = PanduanOlahraga::all();
        return view('panduan-olahraga.index', compact('panduanOlahraga'));
    }

    public function show($id)
    {
        $panduan = PanduanOlahraga::findOrFail($id);
        return view('panduan-olahraga.show', compact('panduan'));
    }

    // Method BARU
    public function downloadPDF(Panduan $panduan)
    {
        // 1. Muat view PDF yang kita buat tadi
        $pdf = Pdf::loadView('panduan.pdf', ['panduan' => $panduan]);

        // 2. Tentukan nama file
        $namaFile = $panduan->nama . '.pdf';

        // 3. Download file
        return $pdf->download($namaFile);
    }
}