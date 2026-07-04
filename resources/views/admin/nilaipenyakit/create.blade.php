@extends('layouts.admin')
@section('content')
    <h2 class="mb-4">Tambah Data Nilai C2/C4</h2>
    <div class="card shadow-sm">
        <div class="card-header">Formulir Nilai Penyakit</div>
        <div class="card-body">
            <form action="{{ route('admin.nilai.penyakit.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="penyakit_id" class="form-label">Kondisi Penyakit</label>
                        <select class="form-select @error('penyakit_id') is-invalid @enderror" id="penyakit_id"
                            name="penyakit_id" required>
                            @foreach ($penyakit as $p)
                                <option value="{{ $p->id }}"
                                    {{ old('penyakit_id', $penyakitId) == $p->id ? 'selected' : '' }}>
                                    {{ $p->nama_penyakit }}
                                </option>
                            @endforeach
                        </select>
                        @error('penyakit_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="alternatif_id" class="form-label">Alternatif Olahraga</label>
                        <select class="form-select @error('alternatif_id') is-invalid @enderror" id="alternatif_id"
                            name="alternatif_id" required>
                            <option value="" disabled selected>-- Pilih Alternatif --</option>
                            @forelse($alternatif as $alt)
                                <option value="{{ $alt->id }}"
                                    {{ old('alternatif_id') == $alt->id ? 'selected' : '' }}>
                                    {{ $alt->nama_alternatif }}
                                </option>
                            @empty
                                <option value="" disabled>Semua alternatif sudah punya nilai untuk penyakit ini.
                                </option>
                            @endforelse
                        </select>
                        @error('alternatif_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nilai_C2" class="form-label">Nilai C2 (Kondisi Kesehatan)</label>
                        <input type="number" step="0.1" class="form-control @error('nilai_C2') is-invalid @enderror"
                            id="nilai_C2" name="nilai_C2" value="{{ old('nilai_C2') }}" required>
                        @error('nilai_C2')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="nilai_C4" class="form-label">Nilai C4 (Risiko Cedera)</label>
                        <input type="number" step="0.1" class="form-control @error('nilai_C4') is-invalid @enderror"
                            id="nilai_C4" name="nilai_C4" value="{{ old('nilai_C4') }}" required>
                        @error('nilai_C4')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="mt-3">
                    <a href="{{ route('admin.nilai.penyakit.index', ['penyakit_id' => $penyakitId]) }}"
                        class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
