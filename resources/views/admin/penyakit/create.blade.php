@extends('layouts.admin')

@section('content')
    <h2 class="mb-4">Tambah Data Penyakit</h2>

    <div class="card shadow-sm">
        <div class="card-header">Formulir Data Penyakit</div>
        <div class="card-body">
            <form action="{{ route('admin.penyakit.store') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label for="nama_penyakit" class="form-label">Nama Penyakit</label>
                    <input type="text" class="form-control @error('nama_penyakit') is-invalid @enderror" 
                           id="nama_penyakit" name="nama_penyakit" value="{{ old('nama_penyakit') }}" required>
                    @error('nama_penyakit')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi Singkat (Opsional)</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3">{{ old('deskripsi') }}</textarea>
                </div>
                
                <div class="mb-3">
                    <label for="larangan" class="form-label">Olahraga/Aktivitas yang Dilarang (Opsional)</label>
                    <textarea class="form-control" id="larangan" name="larangan" rows="3">{{ old('larangan') }}</textarea>
                </div>

                <a href="{{ route('admin.penyakit.index') }}" class="btn btn-secondary">
                    <i class="fa-solid fa-times"></i> Batal
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-save"></i> Simpan
                </button>
            </form>
        </div>
    </div>
@endsection