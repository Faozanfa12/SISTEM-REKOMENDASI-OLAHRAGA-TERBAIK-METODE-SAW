<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('alternatif', function (Blueprint $table) {
            $table->id();
            $table->string('kode_alternatif', 10);
            $table->string('nama_alternatif');
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('alternatif');
    }
};