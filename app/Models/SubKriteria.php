<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubKriteria extends Model
{
    use HasFactory;
    
    // Memberi tahu Laravel nama tabel yang benar
    protected $table = 'sub_kriteria';

    // (Opsional, tapi praktik yang baik)
    protected $guarded = ['id'];

    // (Opsional) Relasi ke Kriteria Induknya
    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class);
    }
}