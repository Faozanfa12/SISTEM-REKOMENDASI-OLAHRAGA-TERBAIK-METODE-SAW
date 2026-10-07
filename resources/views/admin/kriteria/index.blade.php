@extends('layouts.admin')

@section('title', 'Manajemen Kriteria Penilaian')
@section('page_title', 'Kriteria SAW')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold text-dark mb-1">Manajemen Kriteria SAW</h3>
        <p class="text-muted small mb-0">Atur kriteria keputusan, jenis atribut (Benefit/Cost), dan bobot preferensi normalisasi.</p>
    </div>
    <a href="{{ route('admin.kriteria.create') }}" class="btn btn-primary rounded-pill shadow-sm">
        <i class="fa-solid fa-plus me-1"></i> Tambah Kriteria
    </a>
</div>

@php $totalBobot = $kriteria->sum('bobot'); @endphp
<div class="alert {{ abs($totalBobot - 1.0) < 0.001 ? 'alert-success bg-success bg-opacity-10 text-success border border-success border-opacity-25' : 'alert-warning bg-warning bg-opacity-10 text-dark border border-warning border-opacity-25' }} d-flex align-items-center rounded-3 p-3 mb-4 shadow-sm" role="alert">
    <i class="fa-solid {{ abs($totalBobot - 1.0) < 0.001 ? 'fa-circle-check text-success' : 'fa-triangle-exclamation text-warning' }} fs-4 me-3"></i>
    <div>
        <strong>Total Akumulasi Bobot Kriteria:</strong> <span class="fw-bold fs-6">{{ number_format($totalBobot, 2) }}</span> / 1.00
        @if (abs($totalBobot - 1.0) >= 0.001)
            <div class="small text-danger mt-1">Perhatian: Total bobot seluruh kriteria idealnya bernilai tepat 1.00 (100%) untuk normalisasi SAW yang akurat.</div>
        @else
            <div class="small text-success mt-1">Status bobot seimbang dan memenuhi standar metode SAW (ΣW = 1.00).</div>
        @endif
    </div>
</div>

<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="card-header bg-white py-3 px-4 d-flex justify-content-between align-items-center border-bottom">
        <h6 class="fw-bold text-dark mb-0">
            <i class="fa-solid fa-list-check text-primary me-2"></i>Daftar Kriteria Penilaian
        </h6>
        <span class="badge badge-primary-soft">{{ count($kriteria) }} Kriteria Aktif</span>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead style="background: #0f172a; color: #ffffff;">
                    <tr>
                        <th class="py-3 ps-4" style="width: 12%;">Kode</th>
                        <th class="py-3">Nama Kriteria</th>
                        <th class="py-3" style="width: 18%;">Sifat (Atribut)</th>
                        <th class="py-3" style="width: 15%;">Bobot (W)</th>
                        <th class="py-3 pe-4 text-end" style="width: 22%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kriteria as $k)
                        <tr>
                            <td class="ps-4">
                                <span class="badge badge-primary-soft fw-bold px-3 py-2">
                                    {{ $k->kode_kriteria }}
                                </span>
                            </td>
                            <td>
                                <div class="fw-bold text-dark">{{ $k->nama_kriteria }}</div>
                            </td>
                            <td>
                                @if (strtolower($k->jenis) == 'benefit')
                                    <span class="badge badge-success-soft">
                                        <i class="fa-solid fa-arrow-trend-up me-1"></i> Benefit (Maksimal)
                                    </span>
                                @else
                                    <span class="badge badge-danger-soft">
                                        <i class="fa-solid fa-arrow-trend-down me-1"></i> Cost (Minimal)
                                    </span>
                                @endif
                            </td>
                            <td>
                                <span class="fw-bold fs-6 text-dark">{{ $k->bobot }}</span>
                                <small class="text-muted">({{ $k->bobot * 100 }}%)</small>
                            </td>
                            <td class="pe-4 text-end">
                                <a href="{{ route('admin.kriteria.edit', $k->id) }}" class="btn btn-sm btn-outline-primary rounded-pill me-1" title="Edit Kriteria">
                                    <i class="fa-solid fa-pen-to-square me-1"></i> Edit
                                </a>
                                <form action="{{ route('admin.kriteria.destroy', $k->id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Hapus kriteria ini? Perhitungan SAW akan terpengaruh.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill" title="Hapus Kriteria">
                                        <i class="fa-solid fa-trash me-1"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
