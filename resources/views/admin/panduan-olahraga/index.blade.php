@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>{{ __('Manajemen Panduan Olahraga') }}</span>
                        <a href="{{ route('admin.panduan-olahraga.create') }}" class="btn btn-primary">Tambah Panduan</a>
                    </div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Gambar</th>
                                        <th>Nama</th>
                                        <th>Alternatif</th>
                                        <th>Deskripsi Singkat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($panduanOlahraga as $key => $panduan)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>
                                                @if ($panduan->gambar)
                                                    <img src="{{ asset('storage/' . $panduan->gambar) }}"
                                                        alt="{{ $panduan->nama }}" class="img-thumbnail"
                                                        style="max-width: 100px;">
                                                @else
                                                    <span class="text-muted">No image</span>
                                                @endif
                                            </td>
                                            <td>{{ $panduan->nama }}</td>
                                            <td>{{ $panduan->alternatif->nama_alternatif }}</td>
                                            <td>{{ Str::limit($panduan->deskripsi_singkat, 100) }}</td>
                                            <td>
                                                <a href="{{ route('admin.panduan-olahraga.edit', $panduan->id) }}"
                                                    class="btn btn-sm btn-warning">Edit</a>
                                                <form action="{{ route('admin.panduan-olahraga.destroy', $panduan->id) }}"
                                                    method="POST" class="d-inline"
                                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
