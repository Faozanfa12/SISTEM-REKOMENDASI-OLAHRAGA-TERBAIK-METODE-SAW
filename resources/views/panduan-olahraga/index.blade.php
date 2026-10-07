@extends('layouts.app')

@section('title', 'Katalog Panduan Olahraga Lansia')

@section('content')
<div class="container py-4">

    <!-- PAGE HEADER -->
    <div class="text-center mb-5">
        <span class="badge badge-primary-soft mb-2">
            <i class="fa-solid fa-dumbbell me-1"></i> Ensiklopedia Latihan Lansia
        </span>
        <h1 class="fw-bold display-5 text-dark mb-3">Panduan Olahraga Aman untuk Lansia</h1>
        <p class="text-muted mx-auto senior-text-lg" style="max-width: 680px;">
            Setiap olahraga dirancang khusus dengan gerakan berintensitas aman, minim risiko cedera, 
            dan mendukung kebugaran fisik serta psikologis di masa emas.
        </p>

        <!-- LIVE SEARCH & FILTER INPUT -->
        <div class="row justify-content-center mt-4">
            <div class="col-md-6 col-lg-5">
                <div class="input-group shadow-sm" style="border-radius: var(--radius-full); overflow: hidden; border: 1px solid var(--color-border);">
                    <span class="input-group-text bg-white border-0 ps-4">
                        <i class="fa-solid fa-magnifying-glass text-muted"></i>
                    </span>
                    <input type="text" id="searchPanduan" class="form-control border-0 py-3 ps-2" 
                        placeholder="Cari olahraga (misal: Jalan Kaki, Senam, Yoga)..." 
                        aria-label="Cari panduan olahraga">
                </div>
            </div>
        </div>
    </div>

    <!-- PANDUAN CARDS GRID -->
    <div class="panduan-grid" id="panduanGrid">
        @forelse ($panduanOlahraga as $panduan)
            <div class="panduan-card-modern panduan-item" data-nama="{{ strtolower($panduan->nama) }}">
                <div class="panduan-card-img-wrap">
                    @if ($panduan->gambar)
                        <img src="{{ asset('storage/' . $panduan->gambar) }}" alt="{{ $panduan->nama }}" loading="lazy">
                    @else
                        <div class="img-placeholder">
                            <i class="fa-solid fa-dumbbell"></i>
                        </div>
                    @endif
                    <div class="panduan-badge-overlay">
                        <span class="badge bg-dark bg-opacity-75 text-white">
                            <i class="fa-solid fa-shield-heart text-warning me-1"></i> Ramah Lansia
                        </span>
                    </div>
                </div>

                <div class="panduan-card-content">
                    <div class="d-flex align-items-center mb-2">
                        <span class="badge badge-primary-soft text-wrap text-start lh-base py-1 px-2" style="font-size: 0.8rem;">
                            <i class="fa-solid fa-clock me-1 text-primary"></i> {{ $panduan->durasi_ideal ?? '15 - 30 Menit' }}
                        </span>
                    </div>

                    <h3 class="panduan-card-title mb-2">{{ $panduan->nama }}</h3>
                    <p class="panduan-card-desc mb-3">
                        {{ Str::limit($panduan->deskripsi_singkat ?? $panduan->deskripsi_umum, 120) }}
                    </p>

                    <div class="pt-3 border-top mt-auto">
                        <a href="{{ route('panduan-olahraga.show', $panduan->id) }}" class="btn btn-primary w-100 py-2 justify-content-center">
                            <span>Buka Panduan Gerakan</span>
                            <i class="fa-solid fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <div class="icon-square bg-blue-light text-primary mx-auto mb-3">
                    <i class="fa-solid fa-folder-open"></i>
                </div>
                <h5 class="fw-bold text-dark">Belum Ada Data Panduan</h5>
                <p class="text-muted">Data panduan olahraga akan segera ditambahkan oleh administrator.</p>
            </div>
        @endforelse
    </div>

    <!-- NO SEARCH RESULTS FALLBACK -->
    <div id="noResults" class="text-center py-5" style="display: none;">
        <i class="fa-solid fa-magnifying-glass fs-1 text-muted mb-3 d-block"></i>
        <h5 class="fw-bold text-dark">Tidak Ditemukan Olahraga yang Cocok</h5>
        <p class="text-muted">Coba gunakan kata kunci pencarian yang lain.</p>
    </div>

</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchPanduan');
        const items = document.querySelectorAll('.panduan-item');
        const noResults = document.getElementById('noResults');

        if (!searchInput) return;

        searchInput.addEventListener('input', function() {
            const query = this.value.toLowerCase().trim();
            let visibleCount = 0;

            items.forEach(item => {
                const name = item.getAttribute('data-nama');
                if (name.includes(query)) {
                    item.style.display = 'flex';
                    visibleCount++;
                } else {
                    item.style.display = 'none';
                }
            });

            if (visibleCount === 0 && items.length > 0) {
                noResults.style.display = 'block';
            } else {
                noResults.style.display = 'none';
            }
        });
    });
</script>
@endpush
@endsection
