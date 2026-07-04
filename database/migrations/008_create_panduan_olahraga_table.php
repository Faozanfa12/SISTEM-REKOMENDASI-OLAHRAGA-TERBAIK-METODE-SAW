<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('panduan_olahraga', function (Blueprint $table) {
            $table->id();
            $table->foreignId('alternatif_id')->constrained('alternatif')->onDelete('cascade');
            $table->string('nama');
            $table->text('deskripsi_singkat');
            $table->text('deskripsi_umum');
            $table->text('manfaat');
            $table->string('durasi_ideal');
            $table->text('batasan_medis');
            $table->text('peringatan');
            $table->text('tata_cara');
            $table->string('gambar')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('panduan_olahraga');
    }
};