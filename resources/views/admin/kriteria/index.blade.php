@extends('layouts.admin')

@section('content')
    <h2 class="mb-4">Manajemen Kriteria</h2>

    @php $totalBobot = $kriteria->sum('bobot'); @endphp
    <div class="alert {{ $totalBobot == 1 ? 'alert-success' : 'alert-warning' }}" role="alert">
        <strong>Total Bobot Saat Ini:</strong> {{ number_format($totalBobot, 2) }} / 1.00
        @if ($totalBobot != 1)
            (Total bobot harus tepat 1 agar perhitungan akurat)
        @endif
    </div>

    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>Daftar Kriteria</span>

            <!-- PERUBAHAN DI SINI: Teks 'dinonaktifkan' diganti dengan tombol ini -->
            <a href="{{ route('admin.kriteria.create') }}" class="btn btn-primary btn-sm">
                <i class="fa-solid fa-plus"></i> Tambah Kriteria
            </a>

            <!-- Baris ini yang kita nonaktifkan/hapus -->
            <!-- <small>Penambahan/penghapusan kriteria dinonaktifkan untuk menjaga struktur data C1-C5.</small> -->
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Kode</th>
                        <th>Nama Kriteria</th>
                        <th>Jenis</th>
                        <th>Bobot</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kriteria as $k)
                        <tr>
                            <td>{{ $k->kode_kriteria }}</td>
                            <td>{{ $k->nama_kriteria }}</td>
                            <td>
                                <span class="badge {{ $k->jenis == 'benefit' ? 'bg-success' : 'bg-danger' }}">
                                    {{ ucfirst($k->jenis) }}
                                </span>
                            </td>
                            <td>{{ $k->bobot }}</td>
                            <td>
                                <a href="{{ route('admin.kriteria.edit', $k->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fa-solid fa-pen-to-square"></i> Edit
                                </a>
                                <form action="{{ route('admin.kriteria.destroy', $k->id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Hapus kriteria ini? Aksi tidak dapat dibatalkan.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fa-solid fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
