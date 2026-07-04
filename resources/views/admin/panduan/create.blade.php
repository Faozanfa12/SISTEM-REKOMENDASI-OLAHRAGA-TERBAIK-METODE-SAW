@extends('layouts.admin')

@section('content')
    <h2 class="mb-4">Tambah Panduan Olahraga Baru</h2>

    <div class="card shadow-sm">
        <div class="card-header">Formulir Panduan</div>
        <div class="card-body">
            @if($alternatif->isEmpty())
                <div class="alert alert-warning">
                    Semua alternatif olahraga sudah memiliki panduan. Hapus panduan yang ada untuk menambah data baru.
                </div>
            @else
                <form action="{{ route('admin.panduan.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="alternatif_id" class="form-label">Olahraga</label>
                        <select class="form-select @error('alternatif_id') is-invalid @enderror" 
                                id="alternatif_id" name="alternatif_id" required>
                            <option value="" disabled selected>-- Pilih Olahraga --</option>
                            @foreach($alternatif as $id => $nama)
                                <option value="{{ $id }}" {{ old('alternatif_id') == $id ? 'selected' : '' }}>{{ $nama }}</option>
                            @endforeach
                        </select>
                        @error('alternatif_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="deskripsi_umum" class="form-label">Deskripsi Umum</label>
                        <textarea class="form-control @error('deskripsi_umum') is-invalid @enderror" 
                                  id="deskripsi_umum" name="deskripsi_umum" rows="3" required>{{ old('deskripsi_umum') }}</textarea>
                        @error('deskripsi_umum') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="manfaat" class="form-label">Manfaat</label>
                        <textarea class="form-control @error('manfaat') is-invalid @enderror" 
                                  id="manfaat" name="manfaat" rows="3" required>{{ old('manfaat') }}</textarea>
                        @error('manfaat') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="durasi_ideal" class="form-label">Durasi Ideal</label>
                        <input type="text" class="form-control @error('durasi_ideal') is-invalid @enderror" 
                               id="durasi_ideal" name="durasi_ideal" value="{{ old('durasi_ideal') }}" required>
                        @error('durasi_ideal') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="batasan_medis" class="form-label">Batasan Medis</label>
                        <textarea class="form-control @error('batasan_medis') is-invalid @enderror" 
                                  id="batasan_medis" name="batasan_medis" rows="3" required>{{ old('batasan_medis') }}</textarea>
                        @error('batasan_medis') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="peringatan" class="form-label">Peringatan</label>
                        <textarea class="form-control @error('peringatan') is-invalid @enderror" 
                                  id="peringatan" name="peringatan" rows="3" required>{{ old('peringatan') }}</textarea>
                        @error('peringatan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <a href="{{ route('admin.panduan.index') }}" class="btn btn-secondary">
                        <i class="fa-solid fa-times"></i> Batal
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-save"></i> Simpan
                    </button>
                </form>
            @endif
        </div>
    </div>
@endsection