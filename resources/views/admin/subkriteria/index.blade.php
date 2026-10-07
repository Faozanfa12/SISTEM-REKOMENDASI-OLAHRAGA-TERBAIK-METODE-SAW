@extends('layouts.admin')

@section('title', 'Manajemen Sub-Kriteria')
@section('page_title', 'Pilihan Sub-Kriteria')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold text-dark mb-1">Manajemen Opsi Sub-Kriteria</h3>
        <p class="text-muted small mb-0">Kelola opsi skala penilaian untuk kriteria input dinamis C1 (Usia), C3 (Tujuan), dan C5 (Biaya).</p>
    </div>
    <a href="{{ route('admin.subkriteria.create') }}" class="btn btn-primary rounded-pill shadow-sm">
        <i class="fa-solid fa-plus me-1"></i> Tambah Pilihan
    </a>
</div>

<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="card-header bg-white py-3 px-4 d-flex justify-content-between align-items-center border-bottom">
        <h6 class="fw-bold text-dark mb-0">
            <i class="fa-solid fa-list-ol text-primary me-2"></i>Daftar Pilihan Skala Sub-Kriteria
        </h6>
        <span class="badge badge-primary-soft">{{ count($subkriteria) }} Opsi Terdaftar</span>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead style="background: #0f172a; color: #ffffff;">
                    <tr>
                        <th class="py-3 ps-4" style="width: 25%;">Kriteria Induk</th>
                        <th class="py-3">Teks Pilihan (Dropdown Asesmen)</th>
                        <th class="py-3 text-center" style="width: 15%;">Nilai Angka</th>
                        <th class="py-3 pe-4 text-end" style="width: 20%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($subkriteria as $sub)
                        <tr>
                            <td class="ps-4">
                                <span class="badge badge-primary-soft me-2">
                                    {{ $sub->kriteria->kode_kriteria }}
                                </span>
                                <span class="fw-bold text-dark">{{ $sub->kriteria->nama_kriteria }}</span>
                            </td>
                            <td>
                                <div class="fw-semibold text-dark">{{ $sub->pilihan }}</div>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-light text-dark border px-3 py-2 fw-bold fs-6">
                                    {{ $sub->nilai }}
                                </span>
                            </td>
                            <td class="pe-4 text-end">
                                <a href="{{ route('admin.subkriteria.edit', $sub->id) }}" class="btn btn-sm btn-outline-primary rounded-pill me-1" title="Edit">
                                    <i class="fa-solid fa-pen-to-square me-1"></i> Edit
                                </a>
                                <form action="{{ route('admin.subkriteria.destroy', $sub->id) }}" method="POST"
                                    class="d-inline" onsubmit="return confirm('Anda yakin ingin menghapus pilihan sub-kriteria ini?');">
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
                                Belum ada data sub-kriteria.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
