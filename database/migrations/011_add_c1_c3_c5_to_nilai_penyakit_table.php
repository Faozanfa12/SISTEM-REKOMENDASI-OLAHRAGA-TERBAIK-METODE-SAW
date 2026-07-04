<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('nilai_penyakit', function (Blueprint $table) {
            // Tambahkan kolom per-alternatif untuk C1, C3, C5
            $table->float('nilai_C1')->default(0);
            $table->float('nilai_C3')->default(0);
            $table->float('nilai_C5')->default(0);
        });
    }

    public function down(): void {
        Schema::table('nilai_penyakit', function (Blueprint $table) {
            $table->dropColumn(['nilai_C1', 'nilai_C3', 'nilai_C5']);
        });
    }
};
