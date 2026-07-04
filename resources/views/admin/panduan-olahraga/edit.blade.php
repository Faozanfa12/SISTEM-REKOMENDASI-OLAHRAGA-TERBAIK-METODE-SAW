@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Edit Panduan Olahraga') }}</div>

                    <div class="card-body">
                        <form action="{{ route('admin.panduan-olahraga.update', $panduanOlahraga->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row mb-3">
                                <label class="col-md-2 col-form-label">Alternatif</label>
                                <div class="col-md-10">
                                    <select name="alternatif_id"
                                        class="form-control @error('alternatif_id') is-invalid @enderror" required>
                                        <option value="">Pilih Alternatif</option>
                                        @foreach ($alternatifs as $alternatif)
                                            <option value="{{ $alternatif->id }}"
                                                {{ old('alternatif_id', $panduanOlahraga->alternatif_id) == $alternatif->id ? 'selected' : '' }}>
                                                {{ $alternatif->nama_alternatif }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('alternatif_id')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-md-2 col-form-label">Nama</label>
                                <div class="col-md-10">
                                    <input type="text" name="nama"
                                        class="form-control @error('nama') is-invalid @enderror"
                                        value="{{ old('nama', $panduanOlahraga->nama) }}" required>
                                    @error('nama')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-md-2 col-form-label">Deskripsi Singkat</label>
                                <div class="col-md-10">
                                    <textarea name="deskripsi_singkat" class="form-control @error('deskripsi_singkat') is-invalid @enderror" rows="2"
                                        required>{{ old('deskripsi_singkat', $panduanOlahraga->deskripsi_singkat) }}</textarea>
                                    @error('deskripsi_singkat')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-md-2 col-form-label">Deskripsi Umum</label>
                                <div class="col-md-10">
                                    <textarea name="deskripsi_umum" class="form-control @error('deskripsi_umum') is-invalid @enderror" rows="3"
                                        required>{{ old('deskripsi_umum', $panduanOlahraga->deskripsi_umum) }}</textarea>
                                    @error('deskripsi_umum')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-md-2 col-form-label">Manfaat</label>
                                <div class="col-md-10">
                                    <textarea name="manfaat" class="form-control @error('manfaat') is-invalid @enderror" rows="4" required>{{ old('manfaat', $panduanOlahraga->manfaat) }}</textarea>
                                    <small class="text-muted">Pisahkan setiap manfaat dengan baris baru</small>
                                    @error('manfaat')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-md-2 col-form-label">Durasi Ideal</label>
                                <div class="col-md-10">
                                    <input type="text" name="durasi_ideal"
                                        class="form-control @error('durasi_ideal') is-invalid @enderror"
                                        value="{{ old('durasi_ideal', $panduanOlahraga->durasi_ideal) }}" required>
                                    @error('durasi_ideal')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-md-2 col-form-label">Batasan Medis</label>
                                <div class="col-md-10">
                                    <textarea name="batasan_medis" class="form-control @error('batasan_medis') is-invalid @enderror" rows="3"
                                        required>{{ old('batasan_medis', $panduanOlahraga->batasan_medis) }}</textarea>
                                    @error('batasan_medis')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-md-2 col-form-label">Peringatan</label>
                                <div class="col-md-10">
                                    <textarea name="peringatan" class="form-control @error('peringatan') is-invalid @enderror" rows="3" required>{{ old('peringatan', $panduanOlahraga->peringatan) }}</textarea>
                                    @error('peringatan')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-md-2 col-form-label">Tata Cara</label>
                                <div class="col-md-10">
                                    <textarea name="tata_cara" class="form-control @error('tata_cara') is-invalid @enderror" rows="7" required>{{ old('tata_cara', $panduanOlahraga->tata_cara) }}</textarea>
                                    <small class="text-muted">Tuliskan langkah-langkah dengan format: 1. Langkah pertama 2.
                                        Langkah kedua, dst</small>
                                    @error('tata_cara')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-md-2 col-form-label">Gambar</label>
                                <div class="col-md-10">
                                    @if ($panduanOlahraga->gambar)
                                        <div class="mb-2">
                                            <img src="{{ asset('storage/' . $panduanOlahraga->gambar) }}"
                                                alt="{{ $panduanOlahraga->nama }}" class="img-thumbnail"
                                                style="max-width: 200px;">
                                        </div>
                                    @endif
                                    <input type="file" name="gambar"
                                        class="form-control @error('gambar') is-invalid @enderror" accept="image/*">
                                    <small class="text-muted">Format: JPG, PNG, JPEG. Maksimal 2MB. Biarkan kosong jika
                                        tidak ingin mengubah gambar.</small>
                                    @error('gambar')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-10 offset-md-2">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <a href="{{ route('admin.panduan-olahraga.index') }}"
                                        class="btn btn-secondary">Kembali</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
