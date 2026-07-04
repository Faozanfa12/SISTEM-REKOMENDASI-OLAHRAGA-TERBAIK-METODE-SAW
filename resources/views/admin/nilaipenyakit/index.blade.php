@extends('layouts.admin')

@section('content')
    <h2 class="mb-4">Manajemen Nilai Penyakit (Statis C2 & C4)</h2>
    <p>Mengelola nilai faktual C2 (Kondisi Kesehatan) dan C4 (Risiko Cedera) untuk setiap olahraga berdasarkan kondisi
        penyakit.</p>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.nilai.penyakit.index') }}" class="row g-3 align-items-center">
                <div class="col-md-6">
                    <label for="penyakit_id" class="form-label fw-bold">Tampilkan Matriks untuk Kondisi:</label>
                    <select name="penyakit_id" id="penyakit_id" class="form-select" onchange="this.form.submit()">
                        @foreach ($penyakitList as $penyakit)
                            <option value="{{ $penyakit->id }}"
                                {{ $selectedPenyakitId == $penyakit->id ? 'selected' : '' }}>
                                {{ $penyakit->nama_penyakit }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>Nilai untuk: <strong>{{ $penyakitList->find($selectedPenyakitId)->nama_penyakit }}</strong></span>
            <a href="{{ route('admin.nilai.penyakit.create', ['penyakit_id' => $selectedPenyakitId]) }}"
                class="btn btn-primary btn-sm">
                <i class="fa-solid fa-plus"></i> Tambah Nilai
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>Alternatif Olahraga</th>
                            <th>Nilai C2 (Kondisi)</th>
                            <th>Nilai C4 (Risiko)</th>
                            <th style="width: 20%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($matriks as $m)
                            <tr>
                                <td>{{ $m->alternatif->nama_alternatif ?? 'N/A' }}</td>
                                <td>{{ $m->nilai_C2 }}</td>
                                <td>{{ $m->nilai_C4 }}</td>
                                <td>
                                    <a href="{{ route('admin.nilai.penyakit.edit', $m->id) }}"
                                        class="btn btn-warning btn-sm">
                                        <i class="fa-solid fa-pen-to-square"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.nilai.penyakit.destroy', $m->id) }}" method="POST"
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
                                <td colspan="4" class="text-center">
                                    Tidak ada data nilai untuk kondisi ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
