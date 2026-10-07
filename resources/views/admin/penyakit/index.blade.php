@extends('layouts.admin')

@section('title', 'Manajemen Penyakit')
@section('page_title', 'Profil Penyakit')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold text-dark mb-1">Manajemen Riwayat Penyakit Lansia</h3>
        <p class="text-muted small mb-0">Kelola daftar kondisi kesehatan dan batasan kontraindikasi olahraga medis.</p>
    </div>
    <a href="{{ route('admin.penyakit.create') }}" class="btn btn-primary rounded-pill shadow-sm">
        <i class="fa-solid fa-plus me-1"></i> Tambah Penyakit
    </a>
</div>

<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="card-header bg-white py-3 px-4 d-flex justify-content-between align-items-center border-bottom">
        <h6 class="fw-bold text-dark mb-0">
            <i class="fa-solid fa-notes-medical text-primary me-2"></i>Daftar Penyakit & Batasan Medis
        </h6>
        <span class="badge badge-primary-soft">{{ count($penyakit) }} Kondisi Terdaftar</span>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead style="background: #0f172a; color: #ffffff;">
                    <tr>
                        <th class="py-3 ps-4" style="width: 20%;">Nama Penyakit</th>
                        <th class="py-3" style="width: 35%;">Deskripsi Singkat</th>
                        <th class="py-3" style="width: 25%;">Olahraga yang Dilarang</th>
                        <th class="py-3 pe-4 text-end" style="width: 20%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($penyakit as $p)
                        <tr>
                            <td class="ps-4">
                                <div class="fw-bold text-dark fs-6">{{ $p->nama_penyakit }}</div>
                                @if($p->nama_penyakit == 'Sehat')
                                    <span class="badge badge-success-soft mt-1">Normal / Tanpa Keluhan</span>
                                @else
                                    <span class="badge badge-warning-soft mt-1">Perlu Penyesuaian</span>
                                @endif
                            </td>
                            <td>
                                <p class="text-muted small mb-0">{{ $p->deskripsi ?? 'Belum ada deskripsi.' }}</p>
                            </td>
                            <td>
                                @if($p->larangan)
                                    <div class="p-2 rounded-3 bg-danger bg-opacity-10 border border-danger border-opacity-25 small text-danger fw-semibold">
                                        <i class="fa-solid fa-ban me-1"></i>{{ $p->larangan }}
                                    </div>
                                @else
                                    <span class="text-muted small fst-italic">Tidak ada larangan khusus</span>
                                @endif
                            </td>
                            <td class="pe-4 text-end">
                                <a href="{{ route('admin.penyakit.edit', $p->id) }}" class="btn btn-sm btn-outline-primary rounded-pill me-1" title="Edit">
                                    <i class="fa-solid fa-pen-to-square me-1"></i> Edit
                                </a>
                                @if($p->nama_penyakit != 'Sehat')
                                    <form action="{{ route('admin.penyakit.destroy', $p->id) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('Anda yakin ingin menghapus kondisi ini? Data matriks nilai terkait juga akan terhapus.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill" title="Hapus">
                                            <i class="fa-solid fa-trash me-1"></i> Hapus
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-5 text-muted">
                                <i class="fa-solid fa-folder-open fs-1 opacity-50 mb-2 d-block"></i>
                                Belum ada data penyakit.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
