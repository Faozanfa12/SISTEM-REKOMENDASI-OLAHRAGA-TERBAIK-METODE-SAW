<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;

    /**
     * Menentukan nama tabel database secara eksplisit.
     * Laravel default-nya mencari 'kriterias' (jamak).
     * * @var string
     */
    protected $table = 'kriteria'; // <-- INI YANG SAYA TAMBAHKAN

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'kode_kriteria', // Diperlukan untuk 'store'
        'nama_kriteria', // Untuk 'MassAssignmentException'
        'jenis',         // Pastikan namanya 'jenis' (sesuai controller Anda)
        'bobot',
    ];
}