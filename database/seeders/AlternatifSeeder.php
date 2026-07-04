<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlternatifSeeder extends Seeder {
    public function run(): void {
        DB::table('alternatif')->insert([
            ['kode_alternatif' => 'A1', 'nama_alternatif' => 'Jalan Kaki'],
            ['kode_alternatif' => 'A2', 'nama_alternatif' => 'Senam Lansia'],
            ['kode_alternatif' => 'A3', 'nama_alternatif' => 'Yoga Ringan'],
            ['kode_alternatif' => 'A4', 'nama_alternatif' => 'Bersepeda Pelan'],
            ['kode_alternatif' => 'A5', 'nama_alternatif' => 'Tai Chi'],
        ]);
    }
}