@extends('layouts.admin')

@section('title', 'Manajemen Alternatif Olahraga')
@section('page_title', 'Alternatif Olahraga')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold text-dark mb-1">Manajemen Alternatif Olahraga</h3>
        <p class="text-muted small mb-0">Kelola opsi jenis latihan fisik lansia yang dievaluasi dengan metode SAW.</p>
    </div>
    <a href="{{ route('admin.alternatif.create') }}" class="btn btn-primary rounded-pill shadow-sm">
        <i class="fa-solid fa-plus me-1"></i> Tambah Alternatif
    </a>
</div>

<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="card-header bg-white py-3 px-4 d-flex justify-content-between align-items-center border-bottom">
        <h6 class="fw-bold text-dark mb-0">
            <i class="fa-solid fa-person-walking text-primary me-2"></i>Daftar Alternatif Olahraga
        </h6>
        <span class="badge badge-primary-soft">{{ count($alternatif) }} Alternatif Terdaftar</span>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead style="background: #0f172a; color: #ffffff;">
                    <tr>
                        <th class="py-3 ps-4" style="width: 15%;">Kode</th>
                        <th class="py-3">Nama Alternatif Olahraga</th>
                        <th class="py-3 pe-4 text-end" style="width: 25%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($alternatif as $alt)
                    <tr>
                        <td class="ps-4">
                            <span class="badge badge-primary-soft fw-bold px-3 py-2">
                                {{ $alt->kode_alternatif }}
                            </span>
                        </td>
                        <td>
                            <div class="fw-bold text-dark">{{ $alt->nama_alternatif }}</div>
                        </td>
                        <td class="pe-4 text-end">
                            <a href="{{ route('admin.alternatif.edit', $alt->id) }}" class="btn btn-sm btn-outline-primary rounded-pill me-1" title="Edit Data">
                                <i class="fa-solid fa-pen-to-square me-1"></i> Edit
                            </a>
                            <form action="{{ route('admin.alternatif.destroy', $alt->id) }}" method="POST" class="d-inline" 
                                onsubmit="return confirm('Anda yakin ingin menghapus alternatif ini? Data panduan dan matriks nilai terkait juga akan terhapus.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill" title="Hapus Data">
                                    <i class="fa-solid fa-trash me-1"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center py-5 text-muted">
                            <i class="fa-solid fa-folder-open fs-1 text-muted opacity-50 mb-2 d-block"></i>
                            Belum ada data alternatif olahraga.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection