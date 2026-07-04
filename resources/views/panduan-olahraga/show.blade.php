@extends('layouts.app')

@section('content')
    <div class="site-container">
        <div class="max-w-4xl mx-auto hero-card fade-in">
            @if ($panduan->gambar)
                <div style="background:linear-gradient(90deg, rgba(79,70,229,0.04), rgba(6,182,212,0.02));">
                    <img src="{{ asset('storage/' . $panduan->gambar) }}" alt="{{ $panduan->nama }}" class="hero-image">
                </div>
            @endif

            <div class="content-wrap">
                <h1 class="page-title text-center">{{ $panduan->nama }}</h1>
                <p class="meta text-center">Panduan olahraga lansia — dirancang untuk aman dan mudah diikuti</p>

                <div class="mt-5">
                    <h2 class="section-title">Deskripsi</h2>
                    <p class="prose">{{ $panduan->deskripsi_singkat }}</p>
                </div>

                <div class="mt-5">
                    <h2 class="section-title">Tata Cara</h2>
                    <div class="prose">
                        {!! nl2br(e($panduan->tata_cara)) !!}
                    </div>
                </div>

                <div class="mt-5">
                    <h2 class="section-title">Manfaat</h2>
                    <ul class="benefit-list">
                        @foreach (explode("\n", $panduan->manfaat) as $manfaat)
                            @if (trim($manfaat))
                                <li class="d-flex align-items-start">
                                    <span style="color:var(--color-accent); margin-right:.6rem;">
                                        <i class="fa-solid fa-heart-pulse"></i>
                                    </span>
                                    <span class="prose">{{ trim($manfaat) }}</span>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>

                <div class="mt-6 text-center">
                    <a href="{{ route('panduan-olahraga.index') }}" class="btn-cta">
                        <i class="fa-solid fa-arrow-left-long"></i>
                        Kembali ke daftar
                    </a>
                    <a href="#" onclick="bagikanKeWA(event)" class="btn-secondary-soft btn-wa-hover ms-3">
                        <i class="fa-brands fa-whatsapp fa-lg"></i>
                        Bagikan
                    </a>
                    <a href="{{ route('panduan-olahraga.download', $panduan->id) }}" class="btn-primary-soft ms-3">
                        <i class="fa-solid fa-download"></i>
                        Unduh PDF
                    </a>

                    <script>
                        function bagikanKeWA(event) {
                            // Mencegah link href="#" standar berjalan
                            event.preventDefault();

                            // 1. Tentukan Pesan Anda
                            // Kita ambil judul halaman
                            var judulHalaman = document.title;

                            // 2. Tentukan URL yang ingin dibagikan
                            // Kita ambil URL halaman saat ini
                            var urlHalaman = window.location.href;

                            // 3. Gabungkan pesan
                            var pesan = 'Hai, cek halaman keren ini: ' + judulHalaman + ' \n\n' + urlHalaman;

                            // 4. Encode pesan untuk URL
                            var pesanEncoded = encodeURIComponent(pesan);

                            // 5. Buat link WhatsApp
                            var linkWA = 'https://wa.me/?text=' + pesanEncoded;

                            // 6. Buka link di tab baru
                            window.open(linkWA, '_blank');
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>
@endsection
