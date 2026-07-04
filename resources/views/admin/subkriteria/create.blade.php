@extends('layouts.admin')
@section('content')
<h2 class="mb-4">Tambah Pilihan Sub-Kriteria</h2>
<div class="card shadow-sm">
    <div class="card-header">Formulir Pilihan</div>
    <div class="card-body">
        <form action="{{ route('admin.subkriteria.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="kriteria_id" class="form-label">Kriteria Induk</label>
                <select class="form-select @error('kriteria_id') is-invalid @enderror" id="kriteria_id" name="kriteria_id" required>
                    <option value="" disabled selected>-- Pilih Kriteria (C1, C3, atau C5) --</option>
                    @foreach($kriteria as $k)
                        <option value="{{ $k->id }}" {{ old('kriteria_id') == $k->id ? 'selected' : '' }}>
                            {{ $k->kode_kriteria }} - {{ $k->nama_kriteria }}
                        </option>
                    @endforeach
                </select>
                @error('kriteria_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
                <label for="pilihan" class="form-label">Teks Pilihan (Dropdown)</label>
                <input type="text" class="form-control @error('pilihan') is-invalid @enderror" 
                       id="pilihan" name="pilihan" value="{{ old('pilihan') }}" required>
                @error('pilihan') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
                <label for="nilai" class="form-label">Nilai Angka (Value)</label>
                <input type="number" step="0.1" class="form-control @error('nilai') is-invalid @enderror" 
                       id="nilai" name="nilai" value="{{ old('nilai') }}" required>
                @error('nilai') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <a href="{{ route('admin.subkriteria.index') }}" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>
@endsection