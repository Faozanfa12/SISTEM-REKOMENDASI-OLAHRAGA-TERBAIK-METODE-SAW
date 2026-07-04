@extends('layouts.admin')

@section('content')
    <h2 class="mb-4">Manajemen Panduan Olahraga</h2>

    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>Daftar Panduan</span>
            <a href="{{ route('admin.panduan.create') }}" class="btn btn-primary btn-sm">
                <i class="fa-solid fa-plus"></i> Tambah Panduan
            </a>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Nama Olahraga</th>
                        <th>Deskripsi Singkat</th>
                        <th>Durasi Ideal</th>
                        <th style="width: 20%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($panduan as $p)
                        <tr>
                            <td>{{ $p->alternatif->nama_alternatif ?? 'N/A' }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($p->deskripsi_umum, 70) }}</td>
                            <td>{{ $p->durasi_ideal }}</td>
                            <td>
                                <a href="{{ route('admin.panduan.edit', $p->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fa-solid fa-pen-to-square"></i> Edit
                                </a>
                                <form action="{{ route('admin.panduan.destroy', $p->id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Anda yakin ingin menghapus panduan ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fa-solid fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">Tidak ada data panduan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
