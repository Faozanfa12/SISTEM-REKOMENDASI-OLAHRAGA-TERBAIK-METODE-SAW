@extends('layouts.app')

@section('title', 'Panduan Gerakan: ' . $panduan->nama)

@section('content')
<div class="container py-4">

    <!-- BREADCRUMB NAVIGATION -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ route('panduan-olahraga.index') }}">Panduan Olahraga</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $panduan->nama }}</li>
        </ol>
    </nav>

    <div class="row justify-content-center">
        <div class="col-lg-10">

            <!-- HERO CARD / BANNER -->
            @if ($panduan->gambar)
                <div class="detail-hero-banner">
                    <img src="{{ asset('storage/' . $panduan->gambar) }}" alt="{{ $panduan->nama }}" class="img-fluid">
                </div>
            @endif

            <!-- MAIN CONTENT ARTICLE WRAPPER -->
            <div class="detail-hero-content">
                <div class="text-center mb-4">
                    <span class="badge badge-primary-soft mb-2">Panduan Aktivitas Fisik Lansia</span>
                    <h1 class="page-title mb-2 text-dark">{{ $panduan->nama }}</h1>
                    <p class="text-muted senior-text-lg">Dirancang khusus agar aman, terukur, dan mudah dilakukan secara mandiri maupun berkelompok.</p>
                </div>

                <!-- QUICK SPECS BAR -->
                <div class="detail-quick-specs">
                    <div class="spec-item">
                        <div class="spec-icon">
                            <i class="fa-solid fa-clock"></i>
                        </div>
                        <div>
                            <div class="spec-info-title">Durasi Ideal</div>
                            <div class="spec-info-val">{{ $panduan->durasi_ideal ?? '20 - 30 Menit' }}</div>
                        </div>
                    </div>

                    <div class="spec-item">
                        <div class="spec-icon" style="color: var(--color-emerald);">
                            <i class="fa-solid fa-gauge"></i>
                        </div>
                        <div>
                            <div class="spec-info-title">Intensitas</div>
                            <div class="spec-info-val">Ringan - Sedang</div>
                        </div>
                    </div>

                    <div class="spec-item">
                        <div class="spec-icon" style="color: var(--color-accent);">
                            <i class="fa-solid fa-calendar-check"></i>
                        </div>
                        <div>
                            <div class="spec-info-title">Frekuensi</div>
                            <div class="spec-info-val">3 - 5x Seminggu</div>
                        </div>
                    </div>

                    <div class="spec-item">
                        <div class="spec-icon" style="color: var(--color-amber);">
                            <i class="fa-solid fa-shield-heart"></i>
                        </div>
                        <div>
                            <div class="spec-info-title">Keamanan</div>
                            <div class="spec-info-val">Minim Benturan</div>
                        </div>
                    </div>
                </div>

                <!-- SECTION 1: DESKRIPSI -->
                <div class="my-5">
                    <h3 class="fw-bold text-dark mb-3">
                        <i class="fa-solid fa-circle-info text-primary me-2"></i>Tentang Olahraga Ini
                    </h3>
                    <p class="senior-text-lg lh-lg text-body">
                        {{ $panduan->deskripsi_singkat ?? $panduan->deskripsi_umum }}
                    </p>
                </div>

                <!-- SECTION 2: MANFAAT KESEHATAN -->
                <div class="my-5">
                    <h3 class="fw-bold text-dark mb-3">
                        <i class="fa-solid fa-heart-pulse text-success me-2"></i>Manfaat Utama Bagi Lansia
                    </h3>
                    <div class="row g-3">
                        @foreach (explode("\n", $panduan->manfaat) as $manfaat)
                            @if (trim($manfaat))
                                <div class="col-md-6">
                                    <div class="benefit-item-modern h-100">
                                        <i class="fa-solid fa-circle-check"></i>
                                        <span class="senior-text-lg text-dark">{{ trim($manfaat) }}</span>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>

                <!-- SECTION 3: TATA CARA PELAKSANAAN -->
                <div class="my-5">
                    <h3 class="fw-bold text-dark mb-3">
                        <i class="fa-solid fa-list-ol text-primary me-2"></i>Langkah-Langkah Pelaksanaan yang Benar
                    </h3>
                    <div class="mt-4">
                        @php
                            $steps = explode("\n", $panduan->tata_cara);
                            $stepIndex = 1;
                        @endphp
                        @foreach ($steps as $step)
                            @if (trim($step))
                                <div class="step-guide-card">
                                    <div class="step-guide-number">{{ $stepIndex++ }}</div>
                                    <div class="senior-text-lg text-dark flex-grow-1">
                                        {{ trim($step) }}
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>

                <!-- SECTION 4: PERINGATAN KESELAMATAN MEDIS -->
                <div class="p-4 rounded-4 bg-light border border-warning border-opacity-50 my-5">
                    <div class="d-flex align-items-start gap-3">
                        <i class="fa-solid fa-triangle-exclamation text-warning fs-2 mt-1"></i>
                        <div>
                            <h5 class="fw-bold text-dark mb-2">Petunjuk Keselamatan Saat Latihan</h5>
                            <ul class="mb-0 text-muted senior-text-lg ps-3">
                                <li>Kenakan pakaian longgar dan sepatu dengan alas anti-slip.</li>
                                <li>Pastikan sirkulasi udara baik bila berolahraga di dalam ruangan.</li>
                                <li>Selalu siapkan air minum dan hindari menahan napas saat melakukan gerakan peregangan.</li>
                                <li>Bila timbul keluhan pusing, nyeri dada, atau napas tersengal-sengal, segera hentikan latihan dan duduk bersandar.</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- ACTION BUTTONS TOOLBAR -->
                <div class="d-flex flex-wrap justify-content-center align-items-center gap-3 pt-4 border-top">
                    <a href="{{ route('panduan-olahraga.index') }}" class="btn btn-secondary btn-lg">
                        <i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Daftar
                    </a>

                    <a href="#" onclick="bagikanKeWA(event)" class="btn btn-whatsapp btn-lg">
                        <i class="fa-brands fa-whatsapp fa-lg me-1"></i> Bagikan ke WhatsApp
                    </a>

                    <a href="{{ route('panduan-olahraga.download', $panduan->id) }}" class="btn btn-primary btn-lg">
                        <i class="fa-solid fa-file-arrow-down me-1"></i> Unduh Dokumen PDF
                    </a>
                </div>

            </div>

        </div>
    </div>
</div>

@push('scripts')
<script>
    function bagikanKeWA(event) {
        event.preventDefault();
        const judul = document.title;
        const url = window.location.href;
        const pesan = `Halo, cek panduan olahraga lansia yang sangat bermanfaat ini: *${judul}*\n\n${url}`;
        window.open(`https://wa.me/?text=${encodeURIComponent(pesan)}`, '_blank');
    }
</script>
@endpush
@endsection
