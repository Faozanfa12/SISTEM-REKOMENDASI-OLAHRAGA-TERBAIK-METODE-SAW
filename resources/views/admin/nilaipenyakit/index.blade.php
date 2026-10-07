@extends('layouts.admin')

@section('title', 'Manajemen Matriks Nilai Penyakit')
@section('page_title', 'Matriks Nilai Penyakit')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold text-dark mb-1">Manajemen Nilai Faktual (C2 & C4)</h3>
        <p class="text-muted small mb-0">Kelola matriks data statis kriteria C2 (Kondisi Kesehatan) dan C4 (Risiko Cedera) per penyakit.</p>
    </div>
    <a href="{{ route('admin.nilai.penyakit.create', ['penyakit_id' => $selectedPenyakitId]) }}"
        class="btn btn-primary rounded-pill shadow-sm">
        <i class="fa-solid fa-plus me-1"></i> Tambah Nilai Baru
    </a>
</div>

<!-- FILTER CONDITION CARD -->
<div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-body p-4">
        <form method="GET" action="{{ route('admin.nilai.penyakit.index') }}" class="row g-3 align-items-center">
            <div class="col-md-6 col-lg-5">
                <label for="penyakit_id" class="form-label fw-bold text-dark small">Pilih Profil Kondisi Kesehatan / Penyakit:</label>
                <div class="input-group">
                    <span class="input-group-text bg-light text-primary border-end-0">
                        <i class="fa-solid fa-stethoscope"></i>
                    </span>
                    <select name="penyakit_id" id="penyakit_id" class="form-select form-select-lg border-start-0 ps-0" onchange="this.form.submit()">
                        @foreach ($penyakitList as $penyakit)
                            <option value="{{ $penyakit->id }}"
                                {{ $selectedPenyakitId == $penyakit->id ? 'selected' : '' }}>
                                {{ $penyakit->nama_penyakit }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- MATRIKS TABLE CARD -->
<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="card-header bg-white py-3 px-4 d-flex justify-content-between align-items-center border-bottom">
        <h6 class="fw-bold text-dark mb-0">
            <i class="fa-solid fa-table-cells text-primary me-2"></i>Matriks untuk Kondisi: 
            <span class="text-primary">{{ $penyakitList->find($selectedPenyakitId)->nama_penyakit }}</span>
        </h6>
        <span class="badge badge-primary-soft">{{ count($matriks) }} Alternatif Terbobot</span>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0 text-center">
                <thead style="background: #0f172a; color: #ffffff;">
                    <tr>
                        <th class="py-3 ps-4 text-start">Alternatif Olahraga</th>
                        <th class="py-3">Nilai C2 (Kondisi Kesehatan - Cost)</th>
                        <th class="py-3">Nilai C4 (Risiko Cedera - Cost)</th>
                        <th class="py-3 pe-4 text-end" style="width: 20%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($matriks as $m)
                        <tr>
                            <td class="ps-4 text-start">
                                <div class="fw-bold text-dark fs-6">{{ $m->alternatif->nama_alternatif ?? 'N/A' }}</div>
                                <small class="text-muted">{{ $m->alternatif->kode_alternatif ?? '' }}</small>
                            </td>
                            <td>
                                <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25 px-3 py-2 fs-6 fw-bold">
                                    {{ $m->nilai_C2 }}
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-warning bg-opacity-10 text-dark border border-warning border-opacity-25 px-3 py-2 fs-6 fw-bold">
                                    {{ $m->nilai_C4 }}
                                </span>
                            </td>
                            <td class="pe-4 text-end">
                                <a href="{{ route('admin.nilai.penyakit.edit', $m->id) }}"
                                    class="btn btn-sm btn-outline-primary rounded-pill me-1" title="Edit">
                                    <i class="fa-solid fa-pen-to-square me-1"></i> Edit
                                </a>
                                <form action="{{ route('admin.nilai.penyakit.destroy', $m->id) }}" method="POST"
                                    class="d-inline" onsubmit="return confirm('Anda yakin ingin menghapus data nilai ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill" title="Hapus">
                                        <i class="fa-solid fa-trash me-1"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-5 text-muted">
                                <i class="fa-solid fa-folder-open fs-1 opacity-50 mb-2 d-block"></i>
                                Belum ada data nilai untuk kondisi penyakit ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
