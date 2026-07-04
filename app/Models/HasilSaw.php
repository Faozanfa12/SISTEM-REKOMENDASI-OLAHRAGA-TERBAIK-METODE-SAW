<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilSaw extends Model
{
    use HasFactory;

    /**
     * Menentukan nama tabel yang akan digunakan oleh model ini.
     */
    protected $table = 'hasil_saw'; // <-- TAMBAHKAN BARIS INI

    // ... (sisa kode model Anda)
}