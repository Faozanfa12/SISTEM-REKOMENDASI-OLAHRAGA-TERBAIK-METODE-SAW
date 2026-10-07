@extends('layouts.app')

@section('title', 'Rekomendasi Olahraga Terbaik untuk Lansia')

@section('content')
<div class="container py-2">

    <!-- HERO SECTION -->
    <div class="hero-wrapper">
        <div class="row align-items-center gy-5">
            <div class="col-lg-7">
                <div class="hero-pill-badge">
                    <span class="pulse-dot"></span>
                    <span>Sistem Rekomendasi Terverifikasi Medis</span>
                </div>
                <h1 class="hero-title">
                    Temukan Olahraga <span class="text-gradient">Terbaik & Aman</span> Sesuai Kondisi Lansia
                </h1>
                <p class="hero-subtitle">
                    Panduan aktivitas fisik terarah yang disesuaikan secara ilmiah menggunakan metode 
                    <strong>Simple Additive Weighting (SAW)</strong> berdasarkan riwayat kesehatan, rentang usia, 
                    dan preferensi Anda.
                </p>

                <div class="hero-features">
                    <div class="hero-feature-item">
                        <i class="fa-solid fa-circle-check"></i>
                        <span>Aman Bagi Jantung & Sendi</span>
                    </div>
                    <div class="hero-feature-item">
                        <i class="fa-solid fa-circle-check"></i>
                        <span>Validasi Pakar Medis Sp.KFR</span>
                    </div>
                    <div class="hero-feature-item">
                        <i class="fa-solid fa-circle-check"></i>
                        <span>Dilengkapi Panduan Gerakan</span>
                    </div>
                </div>

                <div class="d-flex flex-wrap gap-3">
                    <a href="#form-asesmen" class="btn btn-primary btn-lg shadow-sm">
                        <i class="fa-solid fa-stethoscope me-1"></i> Mulai Asesmen Sekarang
                    </a>
                    <a href="{{ route('panduan-olahraga.index') }}" class="btn btn-secondary btn-lg">
                        <i class="fa-solid fa-book-open me-1"></i> Lihat Panduan Olahraga
                    </a>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="hero-preview-card">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h6 class="fw-bold text-dark mb-0">
                            <i class="fa-solid fa-medal text-warning me-2"></i>Olahraga Lansia Teruji
                        </h6>
                        <span class="badge badge-success-soft">Rekomendasi SAW</span>
                    </div>

                    <div class="hero-stat-card">
                        <div class="hero-stat-icon bg-blue-light text-primary">
                            <i class="fa-solid fa-person-walking"></i>
                        </div>
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="fw-bold text-dark mb-0">Jalan Kaki</h6>
                                <span class="badge bg-primary bg-opacity-10 text-primary">Kardio Ringan</span>
                            </div>
                            <small class="text-muted">Aman untuk hipertensi, diabetes & sendi</small>
                        </div>
                    </div>

                    <div class="hero-stat-card">
                        <div class="hero-stat-icon bg-green-light text-success">
                            <i class="fa-solid fa-child-reaching"></i>
                        </div>
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="fw-bold text-dark mb-0">Senam Lansia</h6>
                                <span class="badge bg-success bg-opacity-10 text-success">Fleksibilitas</span>
                            </div>
                            <small class="text-muted">Melatih koordinasi & peredaran darah</small>
                        </div>
                    </div>

                    <div class="hero-stat-card">
                        <div class="hero-stat-icon bg-orange-light text-warning">
                            <i class="fa-solid fa-spa"></i>
                        </div>
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="fw-bold text-dark mb-0">Tai Chi & Yoga Ringan</h6>
                                <span class="badge bg-warning bg-opacity-10 text-dark">Keseimbangan</span>
                            </div>
                            <small class="text-muted">Cegah risiko jatuh & relaksasi pikiran</small>
                        </div>
                    </div>

                    <div class="p-3 bg-light rounded-3 text-center mt-3 border">
                        <small class="text-muted">
                            <i class="fa-solid fa-shield-halved text-primary me-1"></i>
                            Bekerjasama dengan <strong>BKKBN DIY</strong> untuk lansia sehat, mandiri, dan bermartabat.
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ASSESSMENT FORM WIZARD -->
    <div id="form-asesmen" class="my-5 pt-3">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="assessment-container">
                    <!-- Header -->
                    <div class="assessment-header">
                        <h2>Formulir Rekomendasi Olahraga Lansia</h2>
                        <p>
                            Isi 4 pertanyaan sederhana berikut. Sistem akan menghitung preferensi olahraga teraman dan paling cocok untuk kondisi Anda secara instan.
                        </p>
                    </div>

                    <!-- Progress Stepper Bar -->
                    <div class="stepper-nav">
                        <div class="stepper-item active" id="step-nav-1">
                            <div class="stepper-number">1</div>
                            <span>Kondisi Kesehatan</span>
                        </div>
                        <div class="stepper-item active" id="step-nav-2">
                            <div class="stepper-number">2</div>
                            <span>Rentang Usia</span>
                        </div>
                        <div class="stepper-item active" id="step-nav-3">
                            <div class="stepper-number">3</div>
                            <span>Tujuan Olahraga</span>
                        </div>
                        <div class="stepper-item active" id="step-nav-4">
                            <div class="stepper-number">4</div>
                            <span>Preferensi Biaya</span>
                        </div>
                    </div>

                    <!-- Form Body -->
                    <div class="p-4 p-md-5">
                        <form action="{{ route('user.rekomendasi') }}" method="POST" id="form-rekomendasi">
                            @csrf

                            <!-- LANGKAH 1: KONDISI KESEHATAN -->
                            <div class="step-section">
                                <label class="step-label">
                                    <span class="step-badge">1</span>
                                    <span>Bagaimana Kondisi Kesehatan Fisik Anda Saat Ini?</span>
                                </label>

                                <div class="choice-grid choice-grid-2 mb-3">
                                    <!-- Card Sehat -->
                                    <label class="choice-card" for="kondisi-sehat">
                                        <input type="radio" name="kondisi" id="kondisi-sehat" value="sehat" checked>
                                        <div class="choice-card-header">
                                            <div class="choice-card-icon bg-green-light text-success">
                                                <i class="fa-solid fa-heart-pulse"></i>
                                            </div>
                                            <div class="choice-card-check">
                                                <i class="fa-solid fa-check"></i>
                                            </div>
                                        </div>
                                        <div class="choice-card-title">Sehat & Normal</div>
                                        <p class="choice-card-desc">
                                            Tidak memiliki riwayat penyakit berat kronis atau keluhan sendi yang membatasi gerak.
                                        </p>
                                    </label>

                                    <!-- Card Sakit -->
                                    <label class="choice-card" for="kondisi-sakit">
                                        <input type="radio" name="kondisi" id="kondisi-sakit" value="sakit">
                                        <div class="choice-card-header">
                                            <div class="choice-card-icon bg-orange-light text-warning">
                                                <i class="fa-solid fa-notes-medical"></i>
                                            </div>
                                            <div class="choice-card-check">
                                                <i class="fa-solid fa-check"></i>
                                            </div>
                                        </div>
                                        <div class="choice-card-title">Memiliki Riwayat Penyakit</div>
                                        <p class="choice-card-desc">
                                            Memiliki diagnosis medis tertentu (Hipertensi, Jantung, Sendi, Diabetes) yang memerlukan penyesuaian khusus.
                                        </p>
                                    </label>
                                </div>

                                <!-- Sub-pilihan Penyakit (Smooth Appearance) -->
                                <div id="dropdown-penyakit" class="mt-4 p-4 rounded-4 bg-light border border-primary border-opacity-25" style="display: none;">
                                    <label for="penyakit_id" class="form-label fw-bold fs-6 text-primary mb-2">
                                        <i class="fa-solid fa-stethoscope me-1"></i> Pilih Diagnosis Riwayat Penyakit Utama Anda:
                                    </label>
                                    <select class="form-select form-select-lg @error('penyakit_id') is-invalid @enderror"
                                        name="penyakit_id" id="penyakit_id">
                                        <option value="" disabled selected>-- Klik di sini untuk memilih riwayat penyakit --</option>
                                        @foreach ($penyakit->where('nama_penyakit', '!=', 'Sehat') as $p)
                                            <option value="{{ $p->id }}" {{ old('penyakit_id') == $p->id ? 'selected' : '' }}>
                                                {{ $p->nama_penyakit }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('penyakit_id')
                                        <div class="text-danger small mt-2">
                                            <i class="fa-solid fa-circle-exclamation me-1"></i>{{ $message }}
                                        </div>
                                    @enderror
                                    <small class="text-muted d-block mt-2">
                                        *Sistem akan menyaring olahraga berisiko dan memberikan rekomendasi yang aman untuk kondisi ini.
                                    </small>
                                </div>
                            </div>

                            <!-- LANGKAH 2: RENTANG USIA -->
                            <div class="step-section">
                                <label class="step-label">
                                    <span class="step-badge">2</span>
                                    <span>Pilih Rentang Usia Anda (Tahun):</span>
                                </label>

                                <div class="choice-grid choice-grid-4">
                                    @foreach ($options_c1 as $opt)
                                        <label class="choice-card" for="c1_sub_{{ $opt->id }}">
                                            <input type="radio" name="c1_sub_id" id="c1_sub_{{ $opt->id }}" value="{{ $opt->id }}" required {{ $loop->first ? 'checked' : '' }}>
                                            <div class="choice-card-header">
                                                <div class="choice-card-icon bg-blue-light text-primary">
                                                    <i class="fa-solid fa-calendar-days"></i>
                                                </div>
                                                <div class="choice-card-check">
                                                    <i class="fa-solid fa-check"></i>
                                                </div>
                                            </div>
                                            <div class="choice-card-title">{{ $opt->pilihan }}</div>
                                            <p class="choice-card-desc">
                                                @if(str_contains($opt->pilihan, '60'))
                                                    Lansia Muda
                                                @elseif(str_contains($opt->pilihan, '65'))
                                                    Lansia Menengah
                                                @elseif(str_contains($opt->pilihan, '70'))
                                                    Lansia Madya
                                                @else
                                                    Lansia Lanjut (Gerakan Ringan)
                                                @endif
                                            </p>
                                        </label>
                                    @endforeach
                                </div>
                                @error('c1_sub_id')
                                    <div class="text-danger small mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- LANGKAH 3: TUJUAN OLAHRAGA -->
                            <div class="step-section">
                                <label class="step-label">
                                    <span class="step-badge">3</span>
                                    <span>Apa Tujuan Utama Anda Berolahraga?</span>
                                </label>

                                <div class="choice-grid choice-grid-3">
                                    @foreach ($options_c3 as $opt)
                                        @php
                                            $icon = 'fa-dumbbell';
                                            $iconBg = 'bg-blue-light text-primary';
                                            $desc = 'Meningkatkan kebugaran umum';
                                            if (stripos($opt->pilihan, 'keseimbangan') !== false || stripos($opt->pilihan, 'relaksasi') !== false) {
                                                $icon = 'fa-spa';
                                                $iconBg = 'bg-green-light text-success';
                                                $desc = 'Relaksasi & pencegahan jatuh';
                                            } elseif (stripos($opt->pilihan, 'fleksibilitas') !== false) {
                                                $icon = 'fa-person-walking';
                                                $iconBg = 'bg-orange-light text-warning';
                                                $desc = 'Kelenturan sendi & otot kaku';
                                            } elseif (stripos($opt->pilihan, 'ringan') !== false) {
                                                $icon = 'fa-heart-pulse';
                                                $iconBg = 'bg-blue-light text-primary';
                                                $desc = 'Daya tahan jantung santai';
                                            } elseif (stripos($opt->pilihan, 'sedang') !== false) {
                                                $icon = 'fa-person-biking';
                                                $iconBg = 'bg-blue-light text-primary';
                                                $desc = 'Aktivitas fisik aktif & teratur';
                                            }
                                        @endphp
                                        <label class="choice-card" for="c3_sub_{{ $opt->id }}">
                                            <input type="radio" name="c3_sub_id" id="c3_sub_{{ $opt->id }}" value="{{ $opt->id }}" required {{ $loop->first ? 'checked' : '' }}>
                                            <div class="choice-card-header">
                                                <div class="choice-card-icon {{ $iconBg }}">
                                                    <i class="fa-solid {{ $icon }}"></i>
                                                </div>
                                                <div class="choice-card-check">
                                                    <i class="fa-solid fa-check"></i>
                                                </div>
                                            </div>
                                            <div class="choice-card-title">{{ $opt->pilihan }}</div>
                                            <p class="choice-card-desc">{{ $desc }}</p>
                                        </label>
                                    @endforeach
                                </div>
                                @error('c3_sub_id')
                                    <div class="text-danger small mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- LANGKAH 4: PREFERENSI BIAYA & FASILITAS -->
                            <div class="step-section">
                                <label class="step-label">
                                    <span class="step-badge">4</span>
                                    <span>Preferensi Biaya & Fasilitas Latihan:</span>
                                </label>

                                <div class="choice-grid choice-grid-3">
                                    @foreach ($options_c5 as $opt)
                                        @php
                                            $icon = 'fa-hand-holding-dollar';
                                            $iconBg = 'bg-blue-light text-primary';
                                            $desc = 'Fasilitas terjangkau';
                                            if (stripos($opt->pilihan, 'gratis') !== false || stripos($opt->pilihan, 'tanpa biaya') !== false) {
                                                $icon = 'fa-house';
                                                $iconBg = 'bg-green-light text-success';
                                                $desc = 'Di rumah / lingkungan sekitar';
                                            } elseif (stripos($opt->pilihan, 'murah') !== false) {
                                                $icon = 'fa-wallet';
                                                $iconBg = 'bg-blue-light text-primary';
                                                $desc = 'Hanya alat sederhana seperti matras/kursi';
                                            } elseif (stripos($opt->pilihan, 'sedang') !== false) {
                                                $icon = 'fa-map-location-dot';
                                                $iconBg = 'bg-orange-light text-warning';
                                                $desc = 'Taman khusus, sepatu atau perlengkapan';
                                            }
                                        @endphp
                                        <label class="choice-card" for="c5_sub_{{ $opt->id }}">
                                            <input type="radio" name="c5_sub_id" id="c5_sub_{{ $opt->id }}" value="{{ $opt->id }}" required {{ $loop->first ? 'checked' : '' }}>
                                            <div class="choice-card-header">
                                                <div class="choice-card-icon {{ $iconBg }}">
                                                    <i class="fa-solid {{ $icon }}"></i>
                                                </div>
                                                <div class="choice-card-check">
                                                    <i class="fa-solid fa-check"></i>
                                                </div>
                                            </div>
                                            <div class="choice-card-title">{{ $opt->pilihan }}</div>
                                            <p class="choice-card-desc">{{ $desc }}</p>
                                        </label>
                                    @endforeach
                                </div>
                                @error('c5_sub_id')
                                    <div class="text-danger small mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- SUBMIT BUTTON ACTION -->
                            <div class="submit-action-card">
                                <h5 class="fw-bold text-dark mb-2">Semua Data Sudah Terisi Lengkap?</h5>
                                <p class="text-muted small mb-4">
                                    Algoritma SAW akan menghitung nilai preferensi (Vi) untuk seluruh opsi olahraga dan menampilkan rekomendasi terbaik Anda.
                                </p>
                                <button type="submit" class="btn-submit-wizard" id="btn-submit">
                                    <i class="fa-solid fa-calculator fa-lg"></i>
                                    <span>Hitung Rekomendasi Olahraga Saya</span>
                                    <i class="fa-solid fa-arrow-right"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- SECTION EDUKASI KESEHATAN LANSIA -->
    <div class="my-5 py-4">
        <div class="text-center mb-5">
            <span class="badge badge-primary-soft mb-2">Manfaat Nyata</span>
            <h2 class="fw-bold">Mengapa Lansia Tetap Perlu Bergerak Aktif?</h2>
            <p class="text-muted mx-auto" style="max-width: 650px;">
                Penelitian membuktikan aktivitas fisik teratur dengan intensitas yang tepat memperlambat penurunan fungsi fisik dan menjaga kemandirian di usia lanjut.
            </p>
        </div>

        <div class="row g-4">
            <div class="col-md-6 col-lg-3">
                <div class="card card-hover-lift h-100 p-4 border-0 shadow-sm">
                    <div class="icon-square bg-blue-light text-primary mb-3">
                        <i class="fa-solid fa-heart-pulse"></i>
                    </div>
                    <h5 class="fw-bold">Kesehatan Jantung</h5>
                    <p class="text-muted small mb-0">
                        Membantu menstabilkan tekanan darah, melancarkan peredaran oksigen, dan mencegah kekakuan arteri pembuluh darah.
                    </p>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card card-hover-lift h-100 p-4 border-0 shadow-sm">
                    <div class="icon-square bg-green-light text-success mb-3">
                        <i class="fa-solid fa-bone"></i>
                    </div>
                    <h5 class="fw-bold">Kepadatan Tulang & Sendi</h5>
                    <p class="text-muted small mb-0">
                        Mempertahankan massa otot, melumasi persendian, dan mencegah pengeroposan tulang (osteoporosis).
                    </p>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card card-hover-lift h-100 p-4 border-0 shadow-sm">
                    <div class="icon-square bg-orange-light text-warning mb-3">
                        <i class="fa-solid fa-person-walking-arrow-loop-left"></i>
                    </div>
                    <h5 class="fw-bold">Keseimbangan & Refleks</h5>
                    <p class="text-muted small mb-0">
                        Melatih koordinasi motorik sehingga secara signifikan menurunkan risiko terpeleset atau cedera jatuh pada lansia.
                    </p>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card card-hover-lift h-100 p-4 border-0 shadow-sm">
                    <div class="icon-square bg-purple-light text-purple mb-3">
                        <i class="fa-solid fa-face-smile-beam"></i>
                    </div>
                    <h5 class="fw-bold">Kebugaran Mental & Tidur</h5>
                    <p class="text-muted small mb-0">
                        Memicu pelepasan hormon endorfin yang mengurangi stres, memperbaiki kualitas tidur nyenyak, dan mencerahkan suasana hati.
                    </p>
                </div>
            </div>
        </div>
    </div>

</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const radioSehat = document.getElementById('kondisi-sehat');
        const radioSakit = document.getElementById('kondisi-sakit');
        const dropdownPenyakit = document.getElementById('dropdown-penyakit');
        const selectPenyakit = document.getElementById('penyakit_id');
        const formRekomendasi = document.getElementById('form-rekomendasi');
        const btnSubmit = document.getElementById('btn-submit');

        // Toggle dropdown penyakit with smooth display
        function togglePenyakitDropdown() {
            if (radioSakit.checked) {
                dropdownPenyakit.style.display = 'block';
                selectPenyakit.setAttribute('required', 'required');
            } else {
                dropdownPenyakit.style.display = 'none';
                selectPenyakit.removeAttribute('required');
                selectPenyakit.value = '';
            }
        }

        radioSehat.addEventListener('change', togglePenyakitDropdown);
        radioSakit.addEventListener('change', togglePenyakitDropdown);
        togglePenyakitDropdown();

        // Update selected style on all radio choice cards
        document.querySelectorAll('.choice-card input[type="radio"]').forEach(radio => {
            radio.addEventListener('change', function() {
                const name = this.getAttribute('name');
                document.querySelectorAll(`.choice-card input[name="${name}"]`).forEach(r => {
                    const card = r.closest('.choice-card');
                    if (card) {
                        card.classList.toggle('selected', r.checked);
                    }
                });
            });

            // Initial check state
            if (radio.checked) {
                const card = radio.closest('.choice-card');
                if (card) card.classList.add('selected');
            }
        });

        // Submit button loading feedback
        formRekomendasi.addEventListener('submit', function() {
            btnSubmit.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span> Sedang Menganalisis...';
            btnSubmit.disabled = true;
        });
    });
</script>
@endpush
@endsection
