@extends('layouts.admin')

@section('content')
    <h1 class="h2">Dashboard</h1>
    <p>Selamat datang di Panel Admin, {{ Auth::user()->name }}.</p>

    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-white bg-primary shadow">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="fs-3 fw-bold">{{ $totalAlternatif }}</div>
                        <div>Total Alternatif</div>
                    </div>
                    <i class="fa-solid fa-person-biking fa-3x opacity-50"></i>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success shadow">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="fs-3 fw-bold">{{ $totalKriteria }}</div>
                        <div>Total Kriteria</div>
                    </div>
                    <i class="fa-solid fa-list-check fa-3x opacity-50"></i>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-danger shadow">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="fs-3 fw-bold">{{ $totalPenyakit }}</div>
                        <div>Total Penyakit</div>
                    </div>
                    <i class="fa-solid fa-virus fa-3x opacity-50"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header">
            <h5 class="mb-0">Grafik Data Statis (C2 & C4) per Penyakit</h5>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('admin.dashboard') }}" class="row g-3 align-items-center mb-3">
                <div class="col-md-4">
                    <label for="penyakit_id" class="form-label">Tampilkan Grafik untuk Kondisi:</label>
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

            <hr>

            <h5 class="text-center">Data Statis untuk: <span
                    class="text-primary">{{ $selectedPenyakit->nama_penyakit }}</span></h5>

            @if ($labels->isEmpty())
                <div class="alert alert-warning text-center">
                    Data C2/C4 untuk kondisi ini tidak ditemukan di tabel <strong>Nilai Penyakit</strong>.
                    <a href="{{ route('admin.nilai.penyakit.index', ['penyakit_id' => $selectedPenyakitId]) }}">Tambahkan
                        data.</a>
                </div>
            @else
                <canvas id="sawChart"></canvas>
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
                        datasets: [{
                                label: 'Nilai C2 (Kondisi)', // Kriteria COST
                                data: @json($dataC2),
                                backgroundColor: 'rgba(255, 99, 132, 0.6)', // Merah
                                borderColor: 'rgba(255, 99, 132, 1)',
                                borderWidth: 1
                            },
                            {
                                label: 'Nilai C4 (Risiko)', // Kriteria COST
                                data: @json($dataC4),
                                backgroundColor: 'rgba(255, 159, 64, 0.6)', // Oranye
                                borderColor: 'rgba(255, 159, 64, 1)',
                                borderWidth: 1
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Nilai (Cost - Makin kecil makin baik)'
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                position: 'top',
                            },
                            title: {
                                display: true,
                                text: 'Perbandingan Nilai C2 (Kondisi) dan C4 (Risiko)'
                            }
                        }
                    }
                });
            @endif
        });
    </script>
@endpush
