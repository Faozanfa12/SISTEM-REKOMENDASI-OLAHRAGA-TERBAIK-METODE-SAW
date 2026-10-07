<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Rekomendasi Olahraga Lansia') — Sistem Pendukung Keputusan Metode SAW</title>

    <!-- Google Fonts & Font Awesome -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />

    <!-- Bootstrap CSS (CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Custom Modern Stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}?v={{ filemtime(public_path('css/style.css')) }}">
    @stack('styles')
</head>

<body>
    <div id="app">
        <!-- Floating Glassmorphic Navigation Bar -->
        <nav class="navbar navbar-expand-lg fixed-top" id="mainNavbar">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}" title="Beranda Rekomendasi Olahraga Lansia">
                    <div class="brand-icon-box">
                        <i class="fa-solid fa-person-walking"></i>
                    </div>
                    <div class="brand-text">
                        <span class="brand-title">LansiaSehat</span>
                        <span class="brand-subtitle">Rekomendasi SAW</span>
                    </div>
                </a>

                <button class="navbar-toggler border-0 shadow-none px-2" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <i class="fa-solid fa-bars text-dark fs-4"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto ms-lg-4">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">
                                <i class="fa-solid fa-house me-1"></i> Beranda
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('panduan-olahraga.*') ? 'active' : '' }}"
                                href="{{ route('panduan-olahraga.index') }}">
                                <i class="fa-solid fa-dumbbell me-1"></i> Panduan Olahraga
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('tentang-saw*') ? 'active' : '' }}"
                                href="{{ url('/tentang-saw') }}">
                                <i class="fa-solid fa-calculator me-1"></i> Metode SAW
                            </a>
                        </li>
                    </ul>

                    <ul class="navbar-nav ms-auto align-items-center gap-2">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link btn-login-nav" href="{{ route('login') }}">
                                        <i class="fa-solid fa-shield-halved"></i> {{ __('Masuk Admin') }}
                                    </a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle btn btn-light border py-2 px-3 rounded-pill" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="fa-solid fa-circle-user text-primary me-1"></i> {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end shadow-lg border-0 mt-2 p-2"
                                    style="border-radius: 16px;" aria-labelledby="navbarDropdown">
                                    <div class="px-3 py-2 text-muted small border-bottom mb-1">
                                        Masuk sebagai <strong>{{ Auth::user()->name }}</strong>
                                    </div>
                                    <a class="dropdown-item py-2 rounded-2" href="{{ route('admin.dashboard') }}">
                                        <i class="fa-solid fa-chart-line text-primary me-2"></i> Dashboard Admin
                                    </a>
                                    <div class="dropdown-divider my-1"></div>
                                    <a class="dropdown-item py-2 text-danger rounded-2" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fa-solid fa-right-from-bracket me-2"></i> {{ __('Keluar') }}
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

        <main class="py-3">
            @yield('content')
        </main>

        <!-- Modern Footer with Partnership & Medical Credentials -->
        <footer class="footer-modern">
            <div class="footer-glow-point left"></div>
            <div class="footer-glow-point right"></div>

            <div class="footer-container container">
                <div class="row gy-4 align-items-start">
                    <div class="col-lg-5 col-md-12">
                        <div class="d-flex align-items-center mb-3">
                            <img src="{{ asset('images/bkkbn.png') }}" alt="Logo BKKBN" class="footer-logo-large">
                            <div class="ms-3">
                                <h6 class="fw-bold text-dark mb-1">Badan Kependudukan dan Keluarga Berencana Nasional (DIY)</h6>
                                <span class="badge badge-primary-soft">
                                    <i class="bi bi-shield-check text-primary"></i> Divalidasi Pakar Medis
                                </span>
                            </div>
                        </div>

                        <p class="text-muted small lh-lg mb-3">
                            Sistem Pendukung Keputusan (SPK) berbasis metode <strong>Simple Additive Weighting (SAW)</strong> 
                            untuk merekomendasikan aktivitas fisik terbaik, terarah, dan aman bagi lansia sesuai kondisi kesehatan individual.
                        </p>

                        <div class="d-flex align-items-center gap-2 text-muted small">
                            <i class="fa-solid fa-location-dot text-primary"></i>
                            <span>D.I. Yogyakarta, Indonesia</span>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 ps-lg-4">
                        <h6 class="fw-bold text-dark mb-3">Navigasi Utama</h6>
                        <ul class="footer-links">
                            <li>
                                <a href="{{ url('/') }}">
                                    <i class="bi bi-chevron-right small text-primary"></i> Beranda & Rekomendasi
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('panduan-olahraga.index') }}">
                                    <i class="bi bi-chevron-right small text-primary"></i> Panduan Lengkap Olahraga
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('/tentang-saw') }}">
                                    <i class="bi bi-chevron-right small text-primary"></i> Metode & Simulasi SAW
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <h6 class="fw-bold text-dark mb-3">Pilar Keamanan Medis</h6>
                        <p class="text-muted small mb-3">
                            Parameter kriteria kesehatan (C1-C5) dan batasan olahraga dikembangkan berdasarkan konsultasi pakar rehabilitasi medis demi kenyamanan serta keselamatan lansia.
                        </p>

                        <div class="d-flex gap-2">
                            <a href="https://id.linkedin.com/in/faozan-fahmi-ardhana-754828245" target="_blank" rel="noopener noreferrer" class="social-btn" title="LinkedIn Pengembang">
                                <i class="bi bi-linkedin"></i>
                            </a>
                            <a href="https://github.com/Ardhana10" target="_blank" rel="noopener noreferrer" class="social-btn" title="GitHub">
                                <i class="bi bi-github"></i>
                            </a>
                            <a href="https://www.instagram.com/otannn._" target="_blank" rel="noopener noreferrer" class="social-btn" title="Instagram">
                                <i class="bi bi-instagram"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <hr class="footer-divider">

                <div class="row gy-2 align-items-center">
                    <div class="col-md-8 text-center text-md-start">
                        <p class="text-muted mb-0" style="font-size: 0.8rem;">
                            <i class="fa-solid fa-circle-info text-primary me-1"></i>
                            <strong>Disclaimer Medis:</strong> Aplikasi ini dirancang sebagai instrumen pendukung keputusan edukatif. Selalu konsultasikan program latihan dengan dokter keluarga Anda.
                        </p>
                    </div>
                    <div class="col-md-4 text-center text-md-end">
                        <p class="text-muted mb-0" style="font-size: 0.825rem;">
                            &copy; {{ date('Y') }} <strong>LansiaSehat</strong>. All Rights Reserved.
                        </p>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- Bootstrap JS bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Navbar shadow on scroll
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('mainNavbar');
            if (window.scrollY > 20) {
                navbar.classList.add('navbar-scrolled');
            } else {
                navbar.classList.remove('navbar-scrolled');
            }
        });
    </script>

    @stack('scripts')
</body>

</html>
