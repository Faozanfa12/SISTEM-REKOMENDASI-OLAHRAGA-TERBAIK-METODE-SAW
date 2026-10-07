@extends('layouts.admin')

@section('title', 'Manajemen Panduan Olahraga')
@section('page_title', 'Panduan Olahraga')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold text-dark mb-1">Manajemen Panduan Gerakan Olahraga</h3>
        <p class="text-muted small mb-0">Kelola konten tata cara, foto panduan, manfaat medis, dan durasi tiap olahraga lansia.</p>
    </div>
    <a href="{{ route('admin.panduan-olahraga.create') }}" class="btn btn-primary rounded-pill shadow-sm">
        <i class="fa-solid fa-plus me-1"></i> Tambah Panduan
    </a>
</div>

<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="card-header bg-white py-3 px-4 d-flex justify-content-between align-items-center border-bottom">
        <h6 class="fw-bold text-dark mb-0">
            <i class="fa-solid fa-dumbbell text-primary me-2"></i>Daftar Panduan Olahraga
        </h6>
        <span class="badge badge-primary-soft">{{ count($panduanOlahraga) }} Panduan Aktif</span>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead style="background: #0f172a; color: #ffffff;">
                    <tr>
                        <th class="py-3 ps-4" style="width: 5%;">No</th>
                        <th class="py-3" style="width: 12%;">Foto</th>
                        <th class="py-3" style="width: 20%;">Nama Panduan</th>
                        <th class="py-3" style="width: 18%;">Terkait Alternatif</th>
                        <th class="py-3" style="width: 25%;">Deskripsi Singkat</th>
                        <th class="py-3 pe-4 text-end" style="width: 20%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($panduanOlahraga as $key => $panduan)
                        <tr>
                            <td class="ps-4 fw-bold text-muted">{{ $key + 1 }}</td>
                            <td>
                                @if ($panduan->gambar)
                                    <img src="{{ asset('storage/' . $panduan->gambar) }}"
                                        alt="{{ $panduan->nama }}" class="rounded-3 shadow-sm border"
                                        style="width: 70px; height: 50px; object-fit: cover;">
                                @else
                                    <div class="bg-light rounded-3 d-flex align-items-center justify-content-center text-muted border"
                                        style="width: 70px; height: 50px;">
                                        <i class="fa-solid fa-image"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <div class="fw-bold text-dark fs-6">{{ $panduan->nama }}</div>
                            </td>
                            <td>
                                <span class="badge badge-primary-soft">
                                    <i class="fa-solid fa-person-walking me-1"></i>
                                    {{ $panduan->alternatif->nama_alternatif ?? '-' }}
                                </span>
                            </td>
                            <td>
                                <p class="text-muted small mb-0">{{ Str::limit($panduan->deskripsi_singkat, 90) }}</p>
                            </td>
                            <td class="pe-4 text-end">
                                <a href="{{ route('admin.panduan-olahraga.edit', $panduan->id) }}"
                                    class="btn btn-sm btn-outline-primary rounded-pill me-1" title="Edit">
                                    <i class="fa-solid fa-pen-to-square me-1"></i> Edit
                                </a>
                                <form action="{{ route('admin.panduan-olahraga.destroy', $panduan->id) }}"
                                    method="POST" class="d-inline"
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus panduan ini?')">
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
                            <td colspan="6" class="text-center py-5 text-muted">
                                <i class="fa-solid fa-folder-open fs-1 opacity-50 mb-2 d-block"></i>
                                Belum ada data panduan olahraga.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
