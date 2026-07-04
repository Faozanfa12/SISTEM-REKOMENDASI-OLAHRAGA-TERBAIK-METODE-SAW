@extends('layouts.admin')

@section('content')
    <h2 class="mb-4">Edit Data Penyakit: {{ $penyakit->nama_penyakit }}</h2>

    <div class="card shadow-sm">
        <div class="card-header">Formulir Edit Data Penyakit</div>
        <div class="card-body">
            <form action="{{ route('admin.penyakit.update', $penyakit->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label for="nama_penyakit" class="form-label">Nama Penyakit</label>
                    <input type="text" class="form-control @error('nama_penyakit') is-invalid @enderror" 
                           id="nama_penyakit" name="nama_penyakit" 
                           value="{{ old('nama_penyakit', $penyakit->nama_penyakit) }}" 
                           {{ $penyakit->nama_penyakit == 'Sehat' ? 'readonly' : '' }} required>
                    @if($penyakit->nama_penyakit == 'Sehat')
                        <small class="form-text text-muted">Nama "Sehat" tidak dapat diubah.</small>
                    @endif
                    @error('nama_penyakit')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi Singkat (Opsional)</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3">{{ old('deskripsi', $penyakit->deskripsi) }}</textarea>
                </div>
                
                <div class="mb-3">
                    <label for="larangan" class="form-label">Olahraga/Aktivitas yang Dilarang (Opsional)</label>
                    <textarea class="form-control" id="larangan" name="larangan" rows="3">{{ old('larangan', $penyakit->larangan) }}</textarea>
                </div>

                <a href="{{ route('admin.penyakit.index') }}" class="btn btn-secondary">
                    <i class="fa-solid fa-times"></i> Batal
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-save"></i> Simpan Perubahan
                </button>
            </form>
        </div>
    </div>
@endsection