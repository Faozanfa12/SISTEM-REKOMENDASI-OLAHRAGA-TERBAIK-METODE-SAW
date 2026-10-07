@extends('layouts.admin')

@section('title', 'Dashboard Administrator')
@section('page_title', 'Ringkasan Sistem SPK')

@section('content')
<!-- WELCOME BANNER -->
<div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden" style="background: linear-gradient(135deg, #0284c7 0%, #0d9488 100%);">
    <div class="card-body p-4 text-white">
        <div class="row align-items-center gy-3">
            <div class="col-md-8">
                <span class="badge bg-white bg-opacity-20 text-white mb-2 px-3 py-1 rounded-pill">
                    <i class="fa-solid fa-sparkles me-1"></i> Panel Kontrol Administrasi
                </span>
                <h3 class="fw-bold mb-1">Selamat Datang, {{ Auth::user()->name }}!</h3>
                <p class="mb-0 text-white text-opacity-90">
                    Sistem Pendukung Keputusan Rekomendasi Olahraga Lansia Metode Simple Additive Weighting (SAW) aktif & siap dikelola.
                </p>
            </div>
            <div class="col-md-4 text-md-end">
                <a href="{{ route('admin.saw.hitung') }}" 
                    class="btn btn-light text-primary fw-bold shadow-sm rounded-pill px-4 py-2"
                    onclick="return confirm('Anda yakin ingin menghitung ulang semua data SAW?')">
                    <i class="fa-solid fa-calculator me-1"></i> Hitung Ulang SAW
                </a>
            </div>
        </div>
    </div>
</div>

<!-- METRIC KPI CARDS -->
<div class="row g-4 mb-4">
    <!-- Alternatif Card -->
    <div class="col-sm-6 col-xl-4">
        <div class="admin-kpi-card admin-kpi-blue">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <span class="text-white text-opacity-75 small text-uppercase fw-bold" style="letter-spacing: 0.05em;">Total Alternatif</span>
                    <h2 class="display-6 fw-bold my-2 text-white">{{ $totalAlternatif }}</h2>
                    <span class="badge bg-white bg-opacity-20 text-white small">
                        <i class="fa-solid fa-person-walking me-1"></i> Pilihan Olahraga
                    </span>
                </div>
                <div class="bg-white bg-opacity-20 rounded-3 p-3">
                    <i class="fa-solid fa-person-biking fa-2x text-white"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Kriteria Card -->
    <div class="col-sm-6 col-xl-4">
        <div class="admin-kpi-card admin-kpi-green">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <span class="text-white text-opacity-75 small text-uppercase fw-bold" style="letter-spacing: 0.05em;">Kriteria Penilaian</span>
                    <h2 class="display-6 fw-bold my-2 text-white">{{ $totalKriteria }}</h2>
                    <span class="badge bg-white bg-opacity-20 text-white small">
                        <i class="fa-solid fa-weight-hanging me-1"></i> C1 s/d C5 Terbobot
                    </span>
                </div>
                <div class="bg-white bg-opacity-20 rounded-3 p-3">
                    <i class="fa-solid fa-list-check fa-2x text-white"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Penyakit Card -->
    <div class="col-sm-6 col-xl-4">
        <div class="admin-kpi-card admin-kpi-rose">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <span class="text-white text-opacity-75 small text-uppercase fw-bold" style="letter-spacing: 0.05em;">Profil Penyakit</span>
                    <h2 class="display-6 fw-bold my-2 text-white">{{ $totalPenyakit }}</h2>
                    <span class="badge bg-white bg-opacity-20 text-white small">
                        <i class="fa-solid fa-notes-medical me-1"></i> Kondisi Kesehatan
                    </span>
                </div>
                <div class="bg-white bg-opacity-20 rounded-3 p-3">
                    <i class="fa-solid fa-virus fa-2x text-white"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CHART & VISUALIZATION CARD -->
<div class="card border-0 shadow-sm rounded-4">
    <div class="card-header bg-white py-3 px-4 d-flex flex-wrap justify-content-between align-items-center gap-3">
        <div>
            <h5 class="fw-bold text-dark mb-0">
                <i class="fa-solid fa-chart-column text-primary me-2"></i>Visualisasi Data Kriteria Statis (C2 & C4)
            </h5>
            <small class="text-muted">Perbandingan nilai Kondisi Kesehatan (C2) dan Risiko Cedera (C4) per alternatif</small>
        </div>

        <!-- Filter Kondisi Penyakit -->
        <form method="GET" action="{{ route('admin.dashboard') }}" class="d-flex align-items-center gap-2">
            <label for="penyakit_id" class="small fw-bold text-muted text-nowrap">Filter Kondisi:</label>
            <select name="penyakit_id" id="penyakit_id" class="form-select form-select-sm rounded-pill" onchange="this.form.submit()">
                @foreach ($penyakitList as $penyakit)
                    <option value="{{ $penyakit->id }}" {{ $selectedPenyakitId == $penyakit->id ? 'selected' : '' }}>
                        {{ $penyakit->nama_penyakit }}
                    </option>
                @endforeach
            </select>
        </form>
    </div>

    <div class="card-body p-4">
        <div class="text-center mb-4">
            <span class="badge badge-primary-soft fs-6 px-3 py-2">
                Menampilkan Data untuk: <strong>{{ $selectedPenyakit->nama_penyakit }}</strong>
            </span>
        </div>

        @if ($labels->isEmpty())
            <div class="alert alert-warning text-center rounded-3 p-4">
                <i class="fa-solid fa-circle-exclamation fs-3 text-warning mb-2 d-block"></i>
                Data C2/C4 untuk kondisi ini tidak ditemukan di tabel <strong>Nilai Penyakit</strong>.
                <div class="mt-2">
                    <a href="{{ route('admin.nilai.penyakit.index', ['penyakit_id' => $selectedPenyakitId]) }}" class="btn btn-warning btn-sm">
                        <i class="fa-solid fa-plus me-1"></i> Tambahkan Data Nilai
                    </a>
                </div>
            </div>
        @else
            <div style="position: relative; height: 380px;">
                <canvas id="sawChart"></canvas>
            </div>
            <div class="d-flex justify-content-center gap-4 mt-3 small text-muted">
                <span><i class="fa-solid fa-circle text-danger me-1"></i> C2 (Kondisi Kesehatan - Cost)</span>
                <span><i class="fa-solid fa-circle text-warning me-1"></i> C4 (Risiko Cedera - Cost)</span>
            </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        @if (!$labels->isEmpty())
            const ctx = document.getElementById('sawChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: @json($labels),
                    datasets: [
                        {
                            label: 'Nilai C2 (Kondisi Kesehatan)',
                            data: @json($dataC2),
                            backgroundColor: 'rgba(239, 68, 68, 0.75)',
                            borderColor: '#ef4444',
                            borderWidth: 1.5,
                            borderRadius: 8
                        },
                        {
                            label: 'Nilai C4 (Risiko Cedera)',
                            data: @json($dataC4),
                            backgroundColor: 'rgba(245, 158, 11, 0.75)',
                            borderColor: '#f59e0b',
                            borderWidth: 1.5,
                            borderRadius: 8
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(226, 232, 240, 0.8)'
                            },
                            ticks: {
                                font: {
                                    family: "'Plus Jakarta Sans', sans-serif"
                                }
                            },
                            title: {
                                display: true,
                                text: 'Nilai Kriteria Cost (Makin Kecil Makin Baik)',
                                font: {
                                    family: "'Plus Jakarta Sans', sans-serif",
                                    weight: 'bold'
                                }
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                font: {
                                    family: "'Plus Jakarta Sans', sans-serif",
                                    weight: '600'
                                }
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: {
                                font: {
                                    family: "'Plus Jakarta Sans', sans-serif",
                                    weight: '600'
                                },
                                usePointStyle: true,
                                padding: 20
                            }
                        },
                        tooltip: {
                            backgroundColor: '#0f172a',
                            titleFont: { family: "'Plus Jakarta Sans', sans-serif", weight: 'bold' },
                            bodyFont: { family: "'Plus Jakarta Sans', sans-serif" },
                            padding: 12,
                            cornerRadius: 8
                        }
                    }
                }
            });
        @endif
    });
</script>
@endpush
