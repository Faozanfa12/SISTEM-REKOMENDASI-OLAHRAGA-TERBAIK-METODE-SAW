<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('hasil_saw', function (Blueprint $table) {
            $table->id();
            $table->foreignId('penyakit_id')->constrained('penyakit')->onDelete('cascade');
            $table->foreignId('alternatif_id')->constrained('alternatif')->onDelete('cascade');
            $table->float('nilai_vi');
            $table->integer('ranking');
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('hasil_saw');
    }
};