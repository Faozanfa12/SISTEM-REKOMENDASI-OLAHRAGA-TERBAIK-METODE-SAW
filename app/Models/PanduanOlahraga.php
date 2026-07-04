<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PanduanOlahraga extends Model
{
    use HasFactory;

    /**
     * Beri tahu Laravel nama tabel yang benar.
     */
    protected $table = 'panduan_olahraga';

    protected $fillable = [
        'alternatif_id',
        'nama',
        'deskripsi_singkat',
        'deskripsi_umum',
        'manfaat',
        'durasi_ideal',
        'batasan_medis',
        'peringatan',
        'tata_cara',
        'gambar'
    ];
    
    // Relasi ke Alternatif (sudah benar)
    public function alternatif()
    {
        return $this->belongsTo(Alternatif::class);
    }
}