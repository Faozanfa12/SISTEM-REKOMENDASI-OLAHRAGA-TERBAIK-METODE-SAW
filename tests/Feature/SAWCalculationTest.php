<?php
namespace Tests\Feature;

use Tests\TestCase;
use App\Http\Controllers\SAWController;
use App\Models\Penyakit;
use App\Models\Kriteria;
use App\Models\SubKriteria;

class SAWCalculationTest extends TestCase
{
    public function test_sehat_calculation_matches_manual()
    {
        // Pastikan migrasi dan seeder dijalankan di environment testing
        $this->artisan('migrate:fresh --seed');

        $controller = new SAWController();
        $pen = Penyakit::where('nama_penyakit', 'Sehat')->first();
        $this->assertNotNull($pen, 'Penyakit Sehat harus ada di DB');

        // pick any subkriteria IDs for C1,C3,C5 (values in DB will be used)
        $kC1 = Kriteria::where('kode_kriteria', 'C1')->first();
        $kC3 = Kriteria::where('kode_kriteria', 'C3')->first();
        $kC5 = Kriteria::where('kode_kriteria', 'C5')->first();

        $c1 = SubKriteria::where('kriteria_id', $kC1->id)->first();
        $c3 = SubKriteria::where('kriteria_id', $kC3->id)->first();
        $c5 = SubKriteria::where('kriteria_id', $kC5->id)->first();

        $res = $controller->hitung([
            'penyakit_id' => $pen->id,
            'c1_sub_id' => $c1->id,
            'c3_sub_id' => $c3->id,
            'c5_sub_id' => $c5->id,
        ]);

        // Find Jalan Kaki
        $jk = collect($res)->firstWhere('nama_alternatif', 'Jalan Kaki');
        $this->assertNotNull($jk);
        $this->assertEquals(95.0, $jk['nilai_vi'], '', 0.01);
    }

    public function test_hipertensi_calculation_matches_manual()
    {
        // Pastikan migrasi dan seeder dijalankan di environment testing
        $this->artisan('migrate:fresh --seed');

        $controller = new SAWController();
        $pen = Penyakit::where('nama_penyakit', 'Hipertensi')->first();
        $this->assertNotNull($pen);

        $kC1 = Kriteria::where('kode_kriteria', 'C1')->first();
        $kC3 = Kriteria::where('kode_kriteria', 'C3')->first();
        $kC5 = Kriteria::where('kode_kriteria', 'C5')->first();

        $c1 = SubKriteria::where('kriteria_id', $kC1->id)->first();
        $c3 = SubKriteria::where('kriteria_id', $kC3->id)->first();
        $c5 = SubKriteria::where('kriteria_id', $kC5->id)->first();

        $res = $controller->hitung([
            'penyakit_id' => $pen->id,
            'c1_sub_id' => $c1->id,
            'c3_sub_id' => $c3->id,
            'c5_sub_id' => $c5->id,
        ]);

        $jk = collect($res)->firstWhere('nama_alternatif', 'Jalan Kaki');
        $this->assertNotNull($jk);
        // manual 63.75 (we stored 63.75 in SI)
        $this->assertEquals(63.75, $jk['nilai_vi'], '', 0.1);
    }
}
