@extends('layouts.admin')

@section('content')
    <h2 class="mb-4">Edit Alternatif: {{ $alternatif->nama_alternatif }}</h2>

    <div class="card shadow-sm">
        <div class="card-header">Formulir Edit Alternatif</div>
        <div class="card-body">
            <form action="{{ route('admin.alternatif.update', $alternatif->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label for="kode_alternatif" class="form-label">Kode Alternatif</label>
                    <input type="text" class="form-control @error('kode_alternatif') is-invalid @enderror" 
                           id="kode_alternatif" name="kode_alternatif" value="{{ old('kode_alternatif', $alternatif->kode_alternatif) }}" required>
                    @error('kode_alternatif')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="nama_alternatif" class="form-label">Nama Alternatif</label>
                    <input type="text" class="form-control @error('nama_alternatif') is-invalid @enderror" 
                           id="nama_alternatif" name="nama_alternatif" value="{{ old('nama_alternatif', $alternatif->nama_alternatif) }}" required>
                    @error('nama_alternatif')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <a href="{{ route('admin.alternatif.index') }}" class="btn btn-secondary">
                    <i class="fa-solid fa-times"></i> Batal
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-save"></i> Simpan Perubahan
                </button>
            </form>
        </div>
    </div>
@endsection