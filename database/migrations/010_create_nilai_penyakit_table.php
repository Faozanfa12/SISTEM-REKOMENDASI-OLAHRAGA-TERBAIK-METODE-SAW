<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('nilai_penyakit', function (Blueprint $table) {
            $table->id();
            $table->foreignId('penyakit_id')->constrained('penyakit')->onDelete('cascade');
            $table->foreignId('alternatif_id')->constrained('alternatif')->onDelete('cascade');
            $table->float('nilai_C2'); // Nilai C2 (Kondisi)
            $table->float('nilai_C4'); // Nilai C4 (Risiko)
            $table->unique(['penyakit_id', 'alternatif_id']);
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('nilai_penyakit');
    }
};