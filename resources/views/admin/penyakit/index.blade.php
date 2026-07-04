@extends('layouts.admin')

@section('content')
    <h2 class="mb-4">Manajemen Penyakit</h2>

    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>Daftar Penyakit</span>
            <a href="{{ route('admin.penyakit.create') }}" class="btn btn-primary btn-sm">
                <i class="fa-solid fa-plus"></i> Tambah Penyakit
            </a>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Nama Penyakit</th>
                        <th>Deskripsi</th>
                        <th>Olahraga Dilarang</th>
                        <th style="width: 20%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($penyakit as $p)
                        <tr>
                            <td>{{ $p->nama_penyakit }}</td>
                            <td>{{ $p->deskripsi ?? '-' }}</td>
                            <td>{{ $p->larangan ?? '-' }}</td>
                            <td>
                                <a href="{{ route('admin.penyakit.edit', $p->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fa-solid fa-pen-to-square"></i> Edit
                                </a>
                                <form action="{{ route('admin.penyakit.destroy', $p->id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Anda yakin ingin menghapus ini? Data nilai awal terkait juga akan terhapus.');">
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
                            <td colspan="4" class="text-center">Tidak ada data penyakit.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
