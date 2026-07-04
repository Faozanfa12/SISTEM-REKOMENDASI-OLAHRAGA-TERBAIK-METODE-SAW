<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Rekomendasi Olahraga Lansia (Metode SAW)</title>

    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />

    <!-- Bootstrap CSS (CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Custom stylesheet (overrides must come after Bootstrap) -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}?v={{ filemtime(public_path('css/style.css')) }}">
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg fixed-top">
            <div class="container">

                <a class="navbar-brand" href="{{ url('/') }}">
                    <div class="brand-icon-box">
                        <i class="fa-solid fa-person-walking"></i>
                    </div>
                    <div class="brand-text">
                        <span class="brand-title">Rekomendasi</span>
                        <span class="brand-subtitle">Lansia Sehat</span>
                    </div>
                </a>

                <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto ms-lg-5">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('panduan-olahraga.index') ? 'active' : '' }}"
                                href="{{ route('panduan-olahraga.index') }}">
                                <i class="fa-solid fa-dumbbell me-1"></i> Panduan Olahraga
                            </a>
                        </li>
                    </ul>

                    <ul class="navbar-nav ms-auto align-items-center">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link btn-login-nav" href="{{ route('login') }}">
                                        {{ __('Login Admin') }}
                                    </a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end shadow-lg border-0 mt-3"
                                    style="border-radius: 15px; overflow: hidden;" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item py-2" href="{{ route('admin.dashboard') }}">Dashboard</a>
                                    <div class="dropdown-divider my-0"></div>
                                    <a class="dropdown-item py-2 text-danger" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>

        <footer class="footer-modern">
            <div class="footer-glow-point left"></div>
            <div class="footer-glow-point right"></div>

            <div class="footer-container container py-5">
                <div class="row gy-4">

                    <div class="col-lg-5 col-md-12">
                        <div class="d-flex align-items-center mb-3">
                            <img src="{{ asset('images/bkkbn.png') }}" alt="Logo BKKBN" class="footer-logo-large">
                            <div class="ms-3">
                                <h5 class="fw-bold text-primary mb-0">Badan Kependudukan dan Keluarga Berencana
                                    Nasional(DIY)
                                </h5>
                                <div
                                    class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 mt-2 px-3 py-2 rounded-pill">
                                    <i class="bi bi-shield-check me-1"></i> Medically Reviewed
                                </div>
                            </div>
                        </div>

                        <p class="text-muted small lh-lg mb-3">
                            Sistem rekomendasi berbasis metode <strong>SAW (Simple Additive Weighting)</strong>
                            untuk menentukan aktivitas fisik yang aman bagi lansia.
                        </p>

                        {{-- <div class="d-flex align-items-start p-3 bg-white rounded-3 shadow-sm border border-light">
                            <i class="bi bi-person-fill-add text-primary fs-4 me-3"></i>
                            <div>
                                <p class="mb-0 small text-muted">Data & Rekomendasi divalidasi oleh:</p>
                                <strong class="text-dark small">Dokter Spesialis Rehabilitasi Medis</strong>
                            </div>
                        </div> --}}
                    </div>

                    <div class="col-lg-3 col-md-6 ps-lg-5">
                        <h6 class="fw-bold text-primary mb-3">Menu Utama</h6>
                        <ul class="list-unstyled footer-links">
                            <li><a href="{{ url('/') }}"><i class="bi bi-chevron-right small me-1"></i>
                                    Beranda</a></li>
                            <li><a href="{{ url('/panduan-olahraga') }}"><i class="bi bi-chevron-right small me-1"></i>
                                    Panduan Olahraga</a>
                            </li>
                            <li><a href="{{ url('/tentang-saw') }}"><i class="bi bi-chevron-right small me-1"></i>
                                    Tentang SAW</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <h6 class="fw-bold text-primary mb-3">Informasi Proyek</h6>
                        <ul class="list-unstyled text-muted small mb-4">
                            <li class="mb-2"><i class="bi bi-diagram-3-fill me-2 text-primary"></i> Data Science</li>
                            <li class="mb-2"><i class="bi bi-geo-alt-fill me-2 text-primary"></i> Yogyakarta,
                                Indonesia</li>
                        </ul>

                        <div class="d-flex gap-2">
                            <a href="https://www.instagram.com/otannn._?igsh=bXZ6emNxdzUwcW43&utm_source=qr"
                                class="social-btn"><i class="bi bi-instagram"></i></a>
                            <a href="https://id.linkedin.com/in/faozan-fahmi-ardhana-754828245" class="social-btn"><i
                                    class="bi bi-linkedin"></i></a>
                            <a href="https://github.com/Ardhana10" class="social-btn"><i
                                    class="bi bi-github"></i></a>
                        </div>
                    </div>
                </div>

                <hr class="footer-divider">

                <div class="row mb-3">
                    <div class="col-12 text-center">
                        <small class="text-muted fst-italic" style="font-size: 0.75rem;">
                            *Disclaimer: Aplikasi ini adalah alat bantu rekomendasi. Selalu konsultasikan kondisi
                            kesehatan spesifik Anda dengan tenaga medis profesional.
                        </small>
                    </div>
                </div>

                <div
                    class="footer-bottom d-flex justify-content-between flex-wrap align-items-center bg-white bg-opacity-50 p-3 rounded-3">
                    <p class="mb-0 text-muted small">
                        &copy; {{ date('Y') }} All Rights Reserved
                    </p>
                    <p class="mb-0 text-muted small">
                        Developed by <a href="#" class="fw-bold text-decoration-none text-primary">(FFA)</a>
                    </p>
                </div>

            </div>
        </footer>
    </div>

    <!-- Bootstrap JS bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')
</body>

</html>
