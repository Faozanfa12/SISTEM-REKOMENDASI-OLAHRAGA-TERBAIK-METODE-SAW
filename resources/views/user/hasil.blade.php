@extends('layouts.app')

@section('title', 'Hasil Rekomendasi Olahraga Lansia')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">

            <!-- BREADCRUMB & STATUS BAR -->
            <div class="d-flex flex-wrap align-items-center justify-content-between mb-4 gap-3">
                <div>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-1">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Beranda</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Hasil Rekomendasi</li>
                        </ol>
                    </nav>
                    <h2 class="fw-bold text-dark mb-0">Rekomendasi Olahraga Personal Anda</h2>
                </div>
                <a href="{{ route('user.index') }}" class="btn btn-secondary btn-sm shadow-sm">
                    <i class="fa-solid fa-arrow-rotate-left me-1"></i> Hitung Ulang
                </a>
            </div>

            <!-- PROFIL KONDISI KESEHATAN INFO -->
            <div class="alert alert-info border-0 shadow-sm d-flex align-items-center rounded-4 mb-4 p-3 p-md-4">
                <div class="icon-square bg-blue-light text-primary me-3 flex-shrink-0">
                    <i class="fa-solid fa-user-doctor fs-3"></i>
                </div>
                <div>
                    <div class="text-uppercase fw-bold text-primary small" style="letter-spacing: 0.05em;">Kondisi Kesehatan Terpilih</div>
                    <h5 class="fw-bold text-dark mb-1">{{ $penyakit->nama_penyakit }}</h5>
                    <p class="mb-0 text-muted small">
                        Perhitungan dilakukan secara objektif dengan metode <strong>Simple Additive Weighting (SAW)</strong> 
                        mempertimbangkan bobot usia, kondisi medis, tujuan, risiko cedera, dan kemudahan biaya.
                    </p>
                </div>
            </div>

            @if(count($hasilRekomendasi) > 0)
                @php
                    $champion = $hasilRekomendasi[0];
                    $championScore = $champion['nilai_vi'];
                @endphp

                <!-- CHAMPION / RANK #1 SPOTLIGHT CARD -->
                <div class="champion-card">
                    <div class="champion-badge-ribbon">
                        <i class="fa-solid fa-crown"></i> Rekomendasi Terbaik Utama
                    </div>

                    <div class="row align-items-center gy-4">
                        <div class="col-md-7">
                            <span class="badge bg-warning bg-opacity-25 text-dark fw-bold mb-2">
                                <i class="fa-solid fa-medal text-warning me-1"></i> PERINGKAT #1
                            </span>
                            <h1 class="champion-title">{{ $champion['nama_alternatif'] }}</h1>
                            <p class="text-muted senior-text-lg mb-4">
                                Aktivitas olahraga ini memiliki tingkat kesesuaian tertinggi dan paling aman untuk kondisi kesehatan, usia, serta target kebugaran Anda.
                            </p>

                            <div class="d-flex flex-wrap gap-2 mb-4">
                                <span class="badge badge-success-soft fs-6 py-2 px-3">
                                    <i class="fa-solid fa-circle-check"></i> Sangat Direkomendasikan
                                </span>
                                <span class="badge badge-primary-soft fs-6 py-2 px-3">
                                    <i class="fa-solid fa-shield-heart"></i> Risiko Rendah
                                </span>
                            </div>

                            <div class="d-flex flex-wrap gap-3">
                                <button class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#panduanModal" data-id="{{ $champion['alternatif_id'] }}">
                                    <i class="fa-solid fa-book-open me-1"></i> Buka Panduan Lengkap
                                </button>
                                <button onclick="bagikanHasilWA('{{ $champion['nama_alternatif'] }}', '{{ $champion['nilai_vi'] }}')" class="btn btn-whatsapp btn-lg">
                                    <i class="fa-brands fa-whatsapp fa-lg me-1"></i> Bagikan ke WA
                                </button>
                            </div>
                        </div>

                        <div class="col-md-5">
                            <div class="score-meter-wrap flex-column text-center p-4">
                                <span class="text-muted fw-bold text-uppercase small" style="letter-spacing: 0.05em;">Skor Kesesuaian (Vi)</span>
                                <div class="score-number my-2">{{ $championScore }}%</div>
                                <div class="w-100 my-2">
                                    <div class="progress-modern">
                                        <div class="progress-bar-modern" style="width: {{ min(100, $championScore) }}%;"></div>
                                    </div>
                                </div>
                                <small class="text-muted">
                                    Dihitung dari matriks ternormalisasi terbobot SAW
                                </small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- COMPARATIVE RANKING LIST (PERINGKAT SELANJUTNYA) -->
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-header bg-white py-3 px-4 border-bottom">
                        <div class="d-flex align-items-center justify-content-between">
                            <h5 class="fw-bold text-dark mb-0">
                                <i class="fa-solid fa-list-ol text-primary me-2"></i>Daftar Peringkat Lengkap Alternatif Olahraga
                            </h5>
                            <span class="text-muted small">Total {{ count($hasilRekomendasi) }} Opsi Dianalisis</span>
                        </div>
                    </div>

                    <div class="card-body p-3 p-md-4">
                        @foreach ($hasilRekomendasi as $hasil)
                            @php
                                $score = $hasil['nilai_vi'];
                                $rank = $hasil['ranking'];

                                if ($score >= 80) {
                                    $labelText = 'Sangat Direkomendasikan';
                                    $labelBadge = 'badge-success-soft';
                                    $labelIcon = 'fa-circle-check text-success';
                                } elseif ($score >= 60) {
                                    $labelText = 'Pilihan Alternatif Baik';
                                    $labelBadge = 'badge-primary-soft';
                                    $labelIcon = 'fa-circle-check text-primary';
                                } else {
                                    $labelText = 'Perlu Pertimbangan Medis';
                                    $labelBadge = 'badge-warning-soft';
                                    $labelIcon = 'fa-triangle-exclamation text-warning';
                                }

                                $rankBadgeClass = 'rank-badge-other';
                                if ($rank == 1) $rankBadgeClass = 'rank-badge-1';
                                elseif ($rank == 2) $rankBadgeClass = 'rank-badge-2';
                                elseif ($rank == 3) $rankBadgeClass = 'rank-badge-3';
                            @endphp

                            <div class="rank-card-row">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="rank-badge {{ $rankBadgeClass }}">
                                        #{{ $rank }}
                                    </div>
                                    <div>
                                        <h5 class="fw-bold text-dark mb-1">{{ $hasil['nama_alternatif'] }}</h5>
                                        <div class="d-flex align-items-center gap-2 flex-wrap">
                                            <span class="badge {{ $labelBadge }}">
                                                <i class="fa-solid {{ $labelIcon }} me-1"></i> {{ $labelText }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex align-items-center gap-4">
                                    <div class="text-end d-none d-sm-block" style="min-width: 140px;">
                                        <div class="fw-bold fs-5 text-primary mb-1">{{ $score }}%</div>
                                        <div class="progress-modern" style="width: 140px; height: 8px;">
                                            <div class="progress-bar-modern" style="width: {{ min(100, $score) }}%;"></div>
                                        </div>
                                    </div>

                                    <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#panduanModal" data-id="{{ $hasil['alternatif_id'] }}">
                                        <i class="fa-solid fa-book-open me-1"></i> Panduan
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            @endif

            <!-- PERINGATAN MEDIS KHUSUS (JIKA MEMILIKI RIWAYAT PENYAKIT) -->
            @if ($penyakit->nama_penyakit != 'Sehat' && $penyakit->larangan)
                <div class="medical-advisory-card">
                    <div class="medical-advisory-header">
                        <i class="fa-solid fa-triangle-exclamation fs-3"></i>
                        <h4 class="fw-bold">Perhatian & Larangan Medis Khusus: {{ $penyakit->nama_penyakit }}</h4>
                    </div>
                    <div class="medical-advisory-body">
                        <p class="text-dark senior-text-lg mb-2">
                            Berdasarkan protokol medis bagi lansia dengan <strong>{{ $penyakit->nama_penyakit }}</strong>, harap perhatikan hal-hal berikut:
                        </p>

                        <div class="contraindication-box">
                            <h6 class="fw-bold text-danger mb-2">
                                <i class="fa-solid fa-ban me-1"></i> Aktivitas / Gerakan yang DILARANG / DIHINDARI:
                            </h6>
                            <p class="fw-bold text-danger mb-0 fs-5">
                                {{ $penyakit->larangan }}
                            </p>
                        </div>

                        <div class="row g-3 mt-3">
                            <div class="col-md-4">
                                <div class="p-3 bg-light rounded-3 h-100 border">
                                    <h6 class="fw-bold text-dark small mb-1">
                                        <i class="fa-solid fa-stopwatch text-primary me-1"></i> Waktu Pemanasan
                                    </h6>
                                    <small class="text-muted">Lakukan pemanasan ringan 5-10 menit sebelum mulai berolahraga.</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="p-3 bg-light rounded-3 h-100 border">
                                    <h6 class="fw-bold text-dark small mb-1">
                                        <i class="fa-solid fa-bottle-water text-primary me-1"></i> Hidrasi Teratur
                                    </h6>
                                    <small class="text-muted">Minum air putih sebelum, saat jeda, dan sesudah latihan.</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="p-3 bg-light rounded-3 h-100 border">
                                    <h6 class="fw-bold text-dark small mb-1">
                                        <i class="fa-solid fa-hand text-danger me-1"></i> Sinyal Berhenti
                                    </h6>
                                    <small class="text-muted">Segera istirahat bila merasakan nyeri dada, pusing, atau sesak napas.</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- BOTTOM ACTION NAVIGATION -->
            <div class="d-flex flex-wrap justify-content-center gap-3 mt-5">
                <a href="{{ route('user.index') }}" class="btn btn-secondary btn-lg">
                    <i class="fa-solid fa-arrow-left me-1"></i> Cek Ulang dengan Kondisi Lain
                </a>
                <a href="{{ route('panduan-olahraga.index') }}" class="btn btn-primary-soft btn-lg">
                    <i class="fa-solid fa-dumbbell me-1"></i> Lihat Semua Panduan Olahraga
                </a>
            </div>

        </div>
    </div>
</div>

<!-- MODAL POPUP PANDUAN LENGKAP -->
<div class="modal fade" id="panduanModal" tabindex="-1" aria-labelledby="panduanModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="panduanModalLabel">
                    <i class="fa-solid fa-book-open"></i> Panduan Gerakan Olahraga
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body p-4">
                <!-- Loading State -->
                <div class="text-center py-5" id="modal-loading">
                    <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                        <span class="visually-hidden">Memuat data...</span>
                    </div>
                    <p class="text-muted mt-3 mb-0">Memuat panduan gerakan dari basis data...</p>
                </div>

                <!-- Modal Content -->
                <div id="modal-content" style="display: none;">
                    <!-- Image Showcase -->
                    <div class="text-center mb-4">
                        <img id="modal-image" src="" alt="" class="img-fluid rounded-4 shadow-sm mx-auto"
                            style="max-height: 280px; width: 100%; object-fit: cover; display: none;">
                    </div>

                    <div class="d-flex flex-wrap align-items-center justify-content-between mb-3">
                        <h2 id="modal-nama-olahraga" class="fw-bold text-dark mb-0"></h2>
                        <span class="badge badge-primary-soft py-2 px-3 fs-6">
                            <i class="fa-solid fa-clock me-1"></i> <span id="modal-durasi"></span>
                        </span>
                    </div>

                    <p id="modal-deskripsi" class="senior-text-lg text-muted mb-4"></p>

                    <!-- Manfaat Utama -->
                    <div class="p-3 bg-light rounded-3 border mb-4">
                        <h6 class="fw-bold text-success mb-2">
                            <i class="fa-solid fa-heart-pulse me-1"></i> Manfaat Utama Bagi Lansia:
                        </h6>
                        <p id="modal-manfaat" class="mb-0 text-dark"></p>
                    </div>

                    <!-- Peringatan & Batasan Medis -->
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <div class="p-3 rounded-3 border border-warning bg-warning bg-opacity-10 h-100">
                                <h6 class="fw-bold text-warning mb-1">
                                    <i class="fa-solid fa-user-doctor me-1"></i> Batasan Medis:
                                </h6>
                                <p id="modal-batasan" class="small mb-0 text-dark"></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 rounded-3 border border-danger bg-danger bg-opacity-10 h-100">
                                <h6 class="fw-bold text-danger mb-1">
                                    <i class="fa-solid fa-triangle-exclamation me-1"></i> Peringatan Khusus:
                                </h6>
                                <p id="modal-peringatan" class="small mb-0 text-dark fw-bold"></p>
                            </div>
                        </div>
                    </div>

                    <!-- Tata Cara Langkah Demi Langkah -->
                    <div class="mb-3">
                        <h5 class="fw-bold text-dark mb-3">
                            <i class="fa-solid fa-list-ol text-primary me-2"></i>Tata Cara Pelaksanaan Gerakan:
                        </h5>
                        <div id="modal-tata-cara" class="senior-text-lg lh-lg"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-between">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" id="btn-modal-print" onclick="window.print()" class="btn btn-outline-primary">
                    <i class="fa-solid fa-print me-1"></i> Cetak Panduan
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // WhatsApp sharing helper
    function bagikanHasilWA(namaOlahraga, skor) {
        const url = window.location.href;
        const text = `Halo, saya telah memeriksa rekomendasi olahraga lansia berbasis metode SAW.\n\n*Rekomendasi Utama:* ${namaOlahraga}\n*Tingkat Kesesuaian:* ${skor}%\n\nCek selengkapnya di tautan berikut:\n${url}`;
        window.open(`https://wa.me/?text=${encodeURIComponent(text)}`, '_blank');
    }

    document.addEventListener('DOMContentLoaded', function() {
        const panduanModal = document.getElementById('panduanModal');
        if (!panduanModal) return;

        panduanModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const alternatifId = button.getAttribute('data-id');

            const modalLoading = document.getElementById('modal-loading');
            const modalContent = document.getElementById('modal-content');

            modalLoading.style.display = 'block';
            modalContent.style.display = 'none';

            // Safe URL resolution for local and subfolder path
            const baseUrl = "{{ url('/panduan') }}";
            const storageBase = "{{ asset('storage') }}";

            fetch(`${baseUrl}/${alternatifId}`)
                .then(response => {
                    if (!response.ok) throw new Error('Network error');
                    return response.json();
                })
                .then(data => {
                    document.getElementById('modal-nama-olahraga').textContent = data.alternatif ? data.alternatif.nama_alternatif : data.nama;
                    document.getElementById('modal-deskripsi').textContent = data.deskripsi_umum || data.deskripsi_singkat || 'Panduan olahraga lansia terarah.';
                    document.getElementById('modal-manfaat').textContent = data.manfaat || 'Meningkatkan kebugaran dan kesehatan secara keseluruhan.';
                    document.getElementById('modal-durasi').textContent = data.durasi_ideal || '15 - 30 Menit';
                    document.getElementById('modal-batasan').textContent = data.batasan_medis || 'Sesuaikan dengan kenyamanan fisik Anda.';
                    document.getElementById('modal-peringatan').textContent = data.peringatan || 'Hentikan jika merasa pusing atau tidak nyaman.';

                    // Image handling
                    const imgEl = document.getElementById('modal-image');
                    if (data.gambar) {
                        imgEl.src = `${storageBase}/${data.gambar}`;
                        imgEl.style.display = 'block';
                    } else {
                        imgEl.style.display = 'none';
                    }

                    // Format tata cara with nice step badges
                    const tataCaraContainer = document.getElementById('modal-tata-cara');
                    if (data.tata_cara) {
                        const lines = data.tata_cara.split('\n').filter(line => line.trim().length > 0);
                        let html = '';
                        lines.forEach((line, index) => {
                            html += `
                                <div class="step-guide-card">
                                    <div class="step-guide-number">${index + 1}</div>
                                    <div class="flex-grow-1">${line.trim()}</div>
                                </div>
                            `;
                        });
                        tataCaraContainer.innerHTML = html;
                    } else {
                        tataCaraContainer.innerHTML = '<p class="text-muted">Tata cara belum dimasukkan.</p>';
                    }

                    modalLoading.style.display = 'none';
                    modalContent.style.display = 'block';
                })
                .catch(err => {
                    console.error('Error fetching panduan:', err);
                    modalLoading.innerHTML = '<p class="text-danger my-3"><i class="fa-solid fa-circle-exclamation me-1"></i> Gagal memuat data panduan. Silakan coba kembali.</p>';
                });
        });
    });
</script>
@endpush
