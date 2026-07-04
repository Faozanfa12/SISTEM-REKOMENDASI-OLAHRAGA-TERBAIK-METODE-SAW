@extends('layouts.admin')

@section('content')
    <h2 class="mb-4">Manajemen Alternatif Olahraga</h2>
    
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>Daftar Alternatif</span>
            <a href="{{ route('admin.alternatif.create') }}" class="btn btn-primary btn-sm">
                <i class="fa-solid fa-plus"></i> Tambah Alternatif
            </a>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th style="width: 10%;">Kode</th>
                        <th>Nama Alternatif</th>
                        <th style="width: 20%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($alternatif as $alt)
                    <tr>
                        <td>{{ $alt->kode_alternatif }}</td>
                        <td>{{ $alt->nama_alternatif }}</td>
                        <td>
                            <a href="{{ route('admin.alternatif.edit', $alt->id) }}" class="btn btn-warning btn-sm">
                                <i class="fa-solid fa-pen-to-square"></i> Edit
                            </a>
                            <form action="{{ route('admin.alternatif.destroy', $alt->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Anda yakin ingin menghapus ini? Data terkait (panduan & nilai) juga akan terhapus.');">
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
                        <td colspan="3" class="text-center">Tidak ada data alternatif.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection