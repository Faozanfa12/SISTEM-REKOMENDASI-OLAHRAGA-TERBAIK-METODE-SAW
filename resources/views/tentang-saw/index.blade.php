@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/saw-style.css') }}">

    <div class="container py-5">
        {{-- Header Section --}}
        <div class="row justify-content-center mb-5">
            <div class="col-lg-10 text-center">
                <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill mb-3 fw-bold">
                    Metodologi Penelitian
                </span>
                <h1 class="fw-bold display-5 mb-3 text-dark">Metode Simple Additive Weighting (SAW)</h1>
                <p class="text-muted lead mx-auto" style="max-width: 900px;">
                    "Metode SAW bekerja dengan menjumlahkan semua nilai alternatif pada setiap kriteria setelah dilakukan
                    proses normalisasi dan pembobotan. Metode ini dipilih karena dapat memberikan penilaian berdasarkan
                    bobot dari masing-masing kriteria dan menghasilkan perankingan yang objektif."
                </p>
                <figcaption class="blockquote-footer mt-2">
                    Dikutip dari penelitian <cite title="Source Title">Firdaus [14]</cite>
                </figcaption>
            </div>
        </div>

        {{-- Feature Cards --}}
        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm saw-feature-card">
                    <div class="card-body p-4">
                        <div class="icon-square bg-blue-light text-primary mb-3">
                            <i class="fa-solid fa-bolt"></i>
                        </div>
                        <h5 class="fw-bold">Efisiensi & Objektivitas</h5>
                        <p class="text-muted small mb-0">
                            Menurut <strong>Aziz dan Sugiarto [13]</strong>, metode SAW mampu memberikan rekomendasi yang
                            objektif dan efisien karena proses perhitungannya yang terstruktur.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm saw-feature-card">
                    <div class="card-body p-4">
                        <div class="icon-square bg-green-light text-success mb-3">
                            <i class="fa-solid fa-user-doctor"></i>
                        </div>
                        <h5 class="fw-bold">Validasi Medis</h5>
                        <p class="text-muted small mb-0">
                            Kriteria dan bobot dalam sistem ini telah divalidasi oleh pakar rehabilitasi medis, <strong>Dr.
                                Darsuna Mardhiah, Sp.KFR</strong>, untuk memastikan keamanan bagi lansia.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm saw-feature-card">
                    <div class="card-body p-4">
                        <div class="icon-square bg-orange-light text-warning mb-3">
                            <i class="fa-solid fa-calculator"></i>
                        </div>
                        <h5 class="fw-bold">Perhitungan Terbobot</h5>
                        <p class="text-muted small mb-0">
                            Konsep dasar metode ini adalah mencari penjumlahan terbobot dari rating kinerja pada setiap
                            alternatif pada semua atribut <strong>(Firdaus [14])</strong>.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <hr class="my-5 text-muted opacity-25">

        {{-- Section Kriteria & Bobot --}}
        <div class="row align-items-center mb-5">
            <div class="col-lg-5 mb-4 mb-lg-0">
                <h3 class="fw-bold text-primary mb-3">Kriteria & Bobot Penilaian</h3>
                <p class="text-muted mb-4">
                    Berdasarkan wawancara pakar dan studi literatur, ditetapkan kriteria utama untuk menentukan kelayakan
                    olahraga bagi lansia.
                </p>
                <div class="alert alert-info border-0 d-flex align-items-center shadow-sm" role="alert">
                    <i class="bi bi-info-circle-fill me-2 fs-4 text-info"></i>
                    <div>
                        <strong>Catatan Penting:</strong><br>
                        <small class="fst-italic">
                            "Semakin besar nilai bobot, semakin prioritas kriteria tersebut mempengaruhi hasil akhir."
                        </small>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="table-responsive shadow-sm rounded-4">
                    <table class="table table-hover mb-0 align-middle">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th class="py-3 ps-4">Kode</th>
                                <th class="py-3">Kriteria</th>
                                <th class="py-3">Sifat (Atribut)</th>
                                <th class="py-3 pe-4 text-center">Bobot (W)</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @forelse($kriteria as $k)
                                <tr>
                                    <td class="ps-4 fw-bold text-secondary">
                                        {{ $k->kode_final }}
                                    </td>
                                    <td>
                                        {{ $k->nama_kriteria ?? ($k->nama ?? $k->name) }}
                                    </td>
                                    <td>
                                        @php
                                            $jenis = strtolower($k->jenis ?? ($k->type ?? ($k->attribute ?? '')));
                                        @endphp

                                        @if (str_contains($jenis, 'benefit'))
                                            <div class="d-flex flex-column align-items-start py-1">
                                                <span
                                                    class="badge bg-success bg-opacity-10 text-success mb-1">Benefit</span>
                                                <small class="text-success fw-bold" style="font-size: 0.75rem;">
                                                    <i class="fa-solid fa-arrow-trend-up me-1"></i>Makin Besar = Lebih Baik
                                                </small>
                                            </div>
                                        @else
                                            <div class="d-flex flex-column align-items-start py-1">
                                                <span class="badge bg-danger bg-opacity-10 text-danger mb-1">Cost</span>
                                                <small class="text-danger fw-bold" style="font-size: 0.75rem;">
                                                    <i class="fa-solid fa-arrow-trend-down me-1"></i>Makin Kecil = Lebih
                                                    Baik
                                                </small>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="text-center fw-bold">
                                        {{ $k->bobot ?? $k->weight }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-muted">Data kriteria belum tersedia.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Section Rumus Perhitungan --}}
        <div class="row mb-5">
            <div class="col-12">
                <div class="bg-light p-4 p-md-5 rounded-4 border border-light shadow-sm">
                    <div class="text-center mb-5">
                        <h3 class="fw-bold">Tahapan Perhitungan SAW</h3>
                        <p class="text-muted">Mengacu pada penelitian <strong>Aziz dan Sugiarto [13]</strong></p>
                    </div>

                    <div class="row g-4">
                        {{-- Kartu Normalisasi --}}
                        <div class="col-md-6">
                            <div class="formula-card bg-white p-4 rounded-3 h-100 border shadow-sm">
                                <h5 class="fw-bold text-primary mb-3">1. Normalisasi Matriks (R)</h5>
                                <p class="small text-muted mb-3">
                                    Melakukan normalisasi matriks keputusan $X$ ke skala yang dapat diperbandingkan.
                                </p>

                                {{-- Rumus Benefit --}}
                                <div class="mb-4">
                                    <strong class="d-block text-success small mb-1">
                                        <i class="bi bi-check-circle-fill me-1"></i>Jika Atribut Benefit (Keuntungan):
                                    </strong>
                                    <div
                                        class="math-box text-center py-2 bg-light rounded font-monospace border border-success border-opacity-25">
                                        $$r_{ij} = \frac{x_{ij}}{max(x_{ij})}$$
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mt-1">
                                        <small class="text-muted fst-italic" style="font-size: 0.8rem;">(Persamaan
                                            2.3)</small>
                                        <span class="badge bg-success text-white" style="font-size: 0.65rem;">HARAPAN: NILAI
                                            MAKSIMAL</span>
                                    </div>
                                </div>

                                {{-- Rumus Cost --}}
                                <div>
                                    <strong class="d-block text-danger small mb-1">
                                        <i class="bi bi-exclamation-circle-fill me-1"></i>Jika Atribut Cost (Biaya):
                                    </strong>
                                    <div
                                        class="math-box text-center py-2 bg-light rounded font-monospace border border-danger border-opacity-25">
                                        $$r_{ij} = \frac{min(x_{ij})}{x_{ij}}$$
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mt-1">
                                        <small class="text-muted fst-italic" style="font-size: 0.8rem;">(Persamaan
                                            2.2)</small>
                                        <span class="badge bg-danger text-white" style="font-size: 0.65rem;">HARAPAN: NILAI
                                            MINIMAL</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Kartu Perankingan --}}
                        <div class="col-md-6">
                            <div class="formula-card bg-white p-4 rounded-3 h-100 border shadow-sm">
                                <h5 class="fw-bold text-primary mb-3">2. Perankingan (Nilai Preferensi)</h5>
                                <p class="small text-muted mb-3">
                                    Nilai akhir ($V_i$) diperoleh dari penjumlahan perkalian elemen baris ternormalisasi
                                    ($r_{ij}$) dengan bobot preferensi ($w_j$).
                                </p>

                                <div class="math-box text-center py-5 bg-light rounded font-monospace my-4">
                                    $$V_i = \sum_{j=1}^{n} w_j r_{ij}$$
                                </div>
                                <small class="text-muted text-center d-block mt-1 fst-italic"
                                    style="font-size: 0.8rem;">(Persamaan 2.1)</small>

                                <div class="alert alert-warning d-flex align-items-center mt-3 mb-0 py-2">
                                    <i class="bi bi-trophy-fill me-2 text-warning fs-5"></i>
                                    <small class="mb-0 fw-bold">Nilai $V_i$ terbesar mengindikasikan alternatif
                                        terbaik/rekomendasi utama.</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <hr class="my-5 text-muted opacity-25">

        {{-- Section Simulasi Real-Time --}}
        <div class="row mb-5">
            <div class="col-12">
                <h3 class="fw-bold text-primary mb-3">Simulasi Data Real-Time</h3>
                <div class="alert alert-warning border-0 d-flex align-items-center mb-4">
                    <i class="bi bi-calculator me-2 fs-4"></i>
                    <div>
                        Perhitungan di bawah ini dilakukan secara <strong>otomatis</strong> oleh sistem berdasarkan data
                        input:
                        <strong>{{ $penyakit->nama_penyakit ?? 'Lansia Sehat' }}</strong>.
                    </div>
                </div>
            </div>
            {{-- Form pilihan SubKriteria per Kriteria (GET) --}}
            <div class="col-12 mb-4">
                <form method="GET" action="{{ route('tentang-saw') }}" class="row g-3 align-items-end">
                    @csrf
                    @foreach ($kriteria as $k)
                        <div class="col-md-4">
                            <label class="form-label fw-bold">{{ $k->kode_final }} -
                                {{ $k->nama_kriteria ?? $k->nama }}</label>
                            <select name="selected_subkriteria[{{ $k->id }}]" class="form-select">
                                <option value="">-- Biarkan data asli --</option>
                                @foreach ($k->subkriteria as $s)
                                    <option value="{{ $s->id }}"
                                        {{ request()->input('selected_subkriteria.' . $k->id) == $s->id ? 'selected' : '' }}>
                                        {{ $s->nama_subkriteria ?? ($s->nama ?? 'Sub') }} — {{ $s->nilai ?? $s->value }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="text-muted">Jika dipilih, nilai subkriteria menggantikan nilai 0 pada kriteria
                                ini.</small>
                        </div>
                    @endforeach

                    <div class="col-12 mt-3">
                        <button type="submit" class="btn btn-primary">Terapkan SubKriteria</button>
                        <a href="{{ route('tentang-saw') }}" class="btn btn-outline-secondary ms-2">Reset</a>
                    </div>
                </form>
            </div>

            {{-- Langkah 1: Matriks Keputusan --}}
            <div class="col-12 mb-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white py-3">
                        <h6 class="fw-bold mb-0 text-dark">Langkah 1: Matriks Keputusan (X)</h6>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0 text-center">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="align-middle">Alternatif</th>
                                        @foreach ($kriteria as $k)
                                            <th class="align-middle">
                                                {{ $k->kode_final }}
                                                <br>
                                                {{-- Tambahan Badge pada Header --}}
                                                @if (str_contains(strtolower($k->jenis), 'benefit'))
                                                    <span class="badge rounded-pill bg-success fw-normal mt-1"
                                                        style="font-size: 0.65rem;">
                                                        Max <i class="fa-solid fa-arrow-up"></i>
                                                    </span>
                                                @else
                                                    <span class="badge rounded-pill bg-danger fw-normal mt-1"
                                                        style="font-size: 0.65rem;">
                                                        Min <i class="fa-solid fa-arrow-down"></i>
                                                    </span>
                                                @endif
                                            </th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($hasilAkhir as $res)
                                        <tr>
                                            <td class="text-start ps-3 fw-bold">{{ $res['nama'] }}</td>
                                            @foreach ($kriteria as $k)
                                                @php $kode = $k->kode_final; @endphp
                                                <td>{{ $res['display_values'][$kode] ?? ($res['raw_data']->{$k->col_db} ?? 0) }}
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach

                                    {{-- Baris Pembagi (Min/Max) --}}
                                    <tr class="table-secondary fw-bold border-top border-dark"
                                        style="font-size: 0.85rem;">
                                        <td class="text-start ps-3">Nilai Pembagi</td>
                                        @foreach ($kriteria as $k)
                                            @if (str_contains(strtolower($k->jenis), 'benefit'))
                                                <td class="text-success bg-success bg-opacity-10">
                                                    Max: {{ $minMax[$k->kode_final]['max'] }}
                                                </td>
                                            @else
                                                <td class="text-danger bg-danger bg-opacity-10">
                                                    Min: {{ $minMax[$k->kode_final]['min'] }}
                                                </td>
                                            @endif
                                        @endforeach
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Langkah 2: Matriks Ternormalisasi --}}
            <div class="col-lg-12 mb-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white py-3">
                        <h6 class="fw-bold mb-0 text-dark">Langkah 2: Matriks Ternormalisasi (R)</h6>
                        <small class="text-muted">Menampilkan hasil pembagian (Nilai Alternatif / Nilai Max) atau (Nilai
                            Min
                            / Nilai Alternatif)</small>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0 text-center align-middle">
                                <thead class="bg-light">
                                    <tr>
                                        <th>Alternatif</th>
                                        @foreach ($kriteria as $k)
                                            <th>{{ $k->kode_final }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($hasilAkhir as $res)
                                        <tr>
                                            <td class="text-start ps-3 fw-bold">{{ $res['nama'] }}</td>
                                            @foreach ($kriteria as $k)
                                                <td>
                                                    <span class="fw-bold text-dark">
                                                        {{ number_format($res['norm_values'][$k->kode_final]['nilai'] ?? 0, 3) }}
                                                    </span>
                                                    <br>
                                                    <span class="text-muted fst-italic" style="font-size: 0.75rem;">
                                                        ({{ $res['norm_values'][$k->kode_final]['rumus'] ?? '-' }})
                                                    </span>
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Langkah 3: Hasil Perankingan --}}
            <div class="col-lg-12 mb-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white py-3">
                        <h6 class="fw-bold mb-0 text-primary">Langkah 3: Hasil Perankingan (V)</h6>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th class="ps-4" style="width: 50px;">#</th>
                                        <th style="width: 200px;">Alternatif</th>
                                        <th>Rincian Perhitungan (Bobot &times; R)</th>
                                        <th class="text-end pe-4" style="width: 150px;">Nilai Akhir</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($hasilAkhir as $index => $res)
                                        <tr class="{{ $index == 0 ? 'table-warning' : '' }}">
                                            <td class="ps-4 fw-bold">{{ $index + 1 }}</td>
                                            <td class="fw-bold">
                                                {{ $res['nama'] }}
                                                @if ($index == 0)
                                                    <i class="fa-solid fa-crown text-warning ms-1"></i>
                                                @endif
                                            </td>
                                            <td>
                                                <code class="text-primary small"
                                                    style="font-family: 'Consolas', monospace;">
                                                    {{ $res['string_v'] }}
                                                </code>
                                            </td>
                                            <td class="text-end pe-4 fw-bold fs-5 text-primary">
                                                {{ number_format($res['nilai_akhir'], 3) }}
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

    @push('scripts')
        {{-- Konfigurasi MathJax --}}
        <script>
            window.MathJax = {
                tex: {
                    inlineMath: [
                        ['$', '$'],
                        ['\\(', '\\)']
                    ],
                    displayMath: [
                        ['$$', '$$'],
                        ['\\[', '\\]']
                    ]
                }
            };
        </script>
        {{-- Script Load MathJax --}}
        <script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
    @endpush
@endsection
