@extends('layouts.admin')

@section('content')
    <h2 class="mb-4">Tambah Kriteria Baru</h2>

    <div class="card shadow-sm">
        <div class="card-header">Formulir Tambah Kriteria</div>
        <div class="card-body">
            <form action="{{ route('admin.kriteria.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="kode_kriteria" class="form-label">Kode Kriteria</label>
                    <input type="text" class="form-control @error('kode_kriteria') is-invalid @enderror"
                        id="kode_kriteria" name="kode_kriteria" value="{{ old('kode_kriteria') }}" required>
                    @error('kode_kriteria')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="nama_kriteria" class="form-label">Nama Kriteria</label>
                    <input type="text" class="form-control @error('nama_kriteria') is-invalid @enderror"
                        id="nama_kriteria" name="nama_kriteria" value="{{ old('nama_kriteria') }}" required>
                    @error('nama_kriteria')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="jenis" class="form-label">Jenis Kriteria</label>
                    <select class="form-select @error('jenis') is-invalid @enderror" id="jenis" name="jenis" required>
                        <option value="benefit" {{ old('jenis') == 'benefit' ? 'selected' : '' }}>Benefit</option>
                        <option value="cost" {{ old('jenis') == 'cost' ? 'selected' : '' }}>Cost</option>
                    </select>
                    @error('jenis')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="bobot" class="form-label">Bobot (Nilai 0.0 s/d 1.0)</label>
                    <input type="number" step="0.01" min="0" max="1"
                        class="form-control @error('bobot') is-invalid @enderror" id="bobot" name="bobot"
                        value="{{ old('bobot') }}" required>
                    @error('bobot')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <a href="{{ route('admin.kriteria.index') }}" class="btn btn-secondary">
                    <i class="fa-solid fa-times"></i> Batal
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-save"></i> Simpan
                </button>
            </form>
        </div>
    </div>
@endsection
