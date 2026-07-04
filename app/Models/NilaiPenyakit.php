<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiPenyakit extends Model
{
    use HasFactory;

    protected $table = 'nilai_penyakit';
    protected $guarded = ['id'];

    /**
     * TAMBAHKAN FUNGSI RELASI INI
     * * Ini memberi tahu Laravel bahwa setiap data 'NilaiPenyakit'
     * "milik" (belongsTo) satu data 'Alternatif'.
     */
    public function alternatif()
    {
        // Laravel akan otomatis mencari 'alternatif_id' di tabel ini
        return $this->belongsTo(Alternatif::class);
    }

    /**
     * (Opsional tapi bagus) Tambahkan ini juga untuk relasi ke Penyakit
     */
    public function penyakit()
    {
        return $this->belongsTo(Penyakit::class);
    }
}