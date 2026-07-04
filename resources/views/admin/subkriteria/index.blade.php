@extends('layouts.admin')

@section('content')
    <h2 class="mb-4">Manajemen Pilihan (Sub-Kriteria)</h2>
    <p>Mengelola isi dropdown untuk input C1 (Usia), C3 (Tujuan), dan C5 (Biaya).</p>

    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>Daftar Pilihan</span>
            <a href="{{ route('admin.subkriteria.create') }}" class="btn btn-primary btn-sm">
                <i class="fa-solid fa-plus"></i> Tambah Pilihan
            </a>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Kriteria Induk</th>
                        <th>Teks Pilihan (Dropdown)</th>
                        <th>Nilai Angka</th>
                        <th style="width: 20%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($subkriteria as $sub)
                        <tr>
                            <td><strong>{{ $sub->kriteria->kode_kriteria }}</strong> ({{ $sub->kriteria->nama_kriteria }})
                            </td>
                            <td>{{ $sub->pilihan }}</td>
                            <td>{{ $sub->nilai }}</td>
                            <td>
                                <a href="{{ route('admin.subkriteria.edit', $sub->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fa-solid fa-pen-to-square"></i> Edit
                                </a>
                                <form action="{{ route('admin.subkriteria.destroy', $sub->id) }}" method="POST"
                                    class="d-inline" onsubmit="return confirm('Anda yakin?');">
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
                            <td colspan="4" class="text-center">Tidak ada data sub-kriteria.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
