<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel') — SPK Rekomendasi Olahraga Lansia</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />

    <!-- Bootstrap 5.3.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Custom Modern Stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}?v={{ filemtime(public_path('css/style.css')) }}">

    <style>
        body {
            background-color: #f8fafc;
            padding-top: 0 !important;
            min-height: 100vh;
        }

        .admin-sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 1000;
            width: 260px;
            padding: 0;
            box-shadow: 4px 0 24px rgba(15, 23, 42, 0.08);
            background: #0f172a;
            display: flex;
            flex-direction: column;
        }

        .admin-sidebar-header {
            padding: 1.5rem 1.25rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }

        .sidebar-sticky {
            padding: 1.25rem 0.75rem;
            overflow-y: auto;
            flex-grow: 1;
        }

        .sidebar-menu-title {
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #64748b;
            padding: 0.75rem 1rem 0.35rem;
        }

        .admin-sidebar .nav-link {
            color: #94a3b8;
            font-weight: 500;
            font-size: 0.9rem;
            padding: 0.65rem 1rem;
            margin-bottom: 0.25rem;
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            transition: all 0.2s ease;
        }

        .admin-sidebar .nav-link i {
            width: 20px;
            text-align: center;
            font-size: 1rem;
        }

        .admin-sidebar .nav-link:hover {
            color: #ffffff;
            background: rgba(255, 255, 255, 0.07);
        }

        .admin-sidebar .nav-link.active {
            color: #ffffff !important;
            background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
            box-shadow: 0 4px 14px rgba(2, 132, 199, 0.35);
            font-weight: 700;
        }

        .admin-topbar {
            margin-left: 260px;
            background: #ffffff;
            border-bottom: 1px solid #e2e8f0;
            padding: 0.85rem 2rem;
            position: sticky;
            top: 0;
            z-index: 900;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02);
        }

        .main-content {
            margin-left: 260px;
            padding: 2rem;
            min-height: calc(100vh - 70px);
        }

        @media (max-width: 991.98px) {
            .admin-sidebar {
                display: none;
            }
            .admin-topbar, .main-content {
                margin-left: 0;
                padding: 1.25rem;
            }
        }
    </style>
</head>

<body>
    <!-- DESKTOP SIDEBAR -->
    <nav class="admin-sidebar d-none d-lg-flex">
        <div class="admin-sidebar-header">
            <a class="navbar-brand d-flex align-items-center gap-2 p-0 text-decoration-none" href="{{ route('admin.dashboard') }}">
                <div class="brand-icon-box" style="width: 38px; height: 38px; font-size: 1.1rem;">
                    <i class="fa-solid fa-person-walking"></i>
                </div>
                <div>
                    <div class="text-white fw-bold fs-6">LansiaSehat</div>
                    <div class="text-muted small" style="font-size: 0.7rem;">Panel Administrator</div>
                </div>
            </a>
        </div>

        <div class="sidebar-sticky">
            <div class="sidebar-menu-title">Menu Utama</div>
            <ul class="nav flex-column mb-3">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                        href="{{ route('admin.dashboard') }}">
                        <i class="fa-solid fa-chart-line"></i> Dashboard
                    </a>
                </li>
            </ul>

            <div class="sidebar-menu-title">Master Data SPK</div>
            <ul class="nav flex-column mb-3">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.kriteria.*') ? 'active' : '' }}"
                        href="{{ route('admin.kriteria.index') }}">
                        <i class="fa-solid fa-list-check"></i> Kriteria SAW
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.subkriteria.*') ? 'active' : '' }}"
                        href="{{ route('admin.subkriteria.index') }}">
                        <i class="fa-solid fa-list-ol"></i> Sub-Kriteria (Pilihan)
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.alternatif.*') ? 'active' : '' }}"
                        href="{{ route('admin.alternatif.index') }}">
                        <i class="fa-solid fa-person-walking"></i> Alternatif Olahraga
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.penyakit.*') ? 'active' : '' }}"
                        href="{{ route('admin.penyakit.index') }}">
                        <i class="fa-solid fa-notes-medical"></i> Data Penyakit
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.panduan-olahraga.*') ? 'active' : '' }}"
                        href="{{ route('admin.panduan-olahraga.index') }}">
                        <i class="fa-solid fa-dumbbell"></i> Panduan Olahraga
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.nilai.penyakit.*') ? 'active' : '' }}"
                        href="{{ route('admin.nilai.penyakit.index') }}">
                        <i class="fa-solid fa-table-cells"></i> Matriks Nilai Alternatif
                    </a>
                </li>
            </ul>

            <div class="sidebar-menu-title">Komputasi & Aksi</div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.saw.hitung') }}"
                        onclick="return confirm('Anda yakin ingin menghitung ulang semua data SAW?')">
                        <i class="fa-solid fa-calculator text-warning"></i> Hitung Ulang SAW
                    </a>
                </li>
            </ul>
        </div>

        <div class="p-3 border-top border-secondary border-opacity-25 mt-auto">
            <a href="{{ url('/') }}" target="_blank" class="btn btn-outline-light btn-sm w-100 mb-2 rounded-pill">
                <i class="fa-solid fa-arrow-up-right-from-square me-1"></i> Buka Website
            </a>
        </div>
    </nav>

    <!-- MOBILE TOPBAR & DRAWER TOGGLE -->
    <header class="admin-topbar d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-2">
            <button class="btn btn-light d-lg-none border p-2" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasSidebar" aria-controls="offcanvasSidebar">
                <i class="fa-solid fa-bars fs-5"></i>
            </button>
            <h5 class="fw-bold text-dark mb-0 d-none d-md-block">@yield('page_title', 'Dashboard')</h5>
        </div>

        <div class="d-flex align-items-center gap-3">
            <a href="{{ url('/') }}" target="_blank" class="btn btn-outline-primary btn-sm rounded-pill d-none d-sm-inline-flex">
                <i class="fa-solid fa-globe me-1"></i> Lihat Web Publik
            </a>

            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-dark text-decoration-none dropdown-toggle" id="userMenu" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center me-2 fw-bold" style="width: 36px; height: 36px;">
                        <i class="fa-solid fa-user-shield"></i>
                    </div>
                    <span class="fw-semibold small d-none d-sm-inline">{{ Auth::user()->name }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 mt-2 p-2" style="border-radius: 14px;" aria-labelledby="userMenu">
                    <li><h6 class="dropdown-header small text-muted">Akun: {{ Auth::user()->email }}</h6></li>
                    <li><hr class="dropdown-divider my-1"></li>
                    <li>
                        <a class="dropdown-item text-danger py-2 rounded-2" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fa-solid fa-right-from-bracket me-2"></i> Keluar
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </header>

    <!-- OFFCANVAS SIDEBAR FOR MOBILE -->
    <div class="offcanvas offcanvas-start bg-dark text-white" tabindex="-1" id="offcanvasSidebar">
        <div class="offcanvas-header border-bottom border-secondary">
            <h5 class="offcanvas-title text-white">Menu Admin</h5>
            <button type="button" class="btn-close btn-close-white text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body p-3">
            <ul class="nav flex-column">
                <li class="nav-item mb-1">
                    <a class="nav-link text-white {{ request()->routeIs('admin.dashboard') ? 'active bg-primary' : '' }}"
                        href="{{ route('admin.dashboard') }}">
                        <i class="fa-solid fa-chart-line me-2"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item mb-1">
                    <a class="nav-link text-white {{ request()->routeIs('admin.kriteria.*') ? 'active bg-primary' : '' }}"
                        href="{{ route('admin.kriteria.index') }}">
                        <i class="fa-solid fa-list-check me-2"></i> Kriteria
                    </a>
                </li>
                <li class="nav-item mb-1">
                    <a class="nav-link text-white {{ request()->routeIs('admin.subkriteria.*') ? 'active bg-primary' : '' }}"
                        href="{{ route('admin.subkriteria.index') }}">
                        <i class="fa-solid fa-list-ol me-2"></i> Sub-Kriteria
                    </a>
                </li>
                <li class="nav-item mb-1">
                    <a class="nav-link text-white {{ request()->routeIs('admin.alternatif.*') ? 'active bg-primary' : '' }}"
                        href="{{ route('admin.alternatif.index') }}">
                        <i class="fa-solid fa-person-walking me-2"></i> Alternatif
                    </a>
                </li>
                <li class="nav-item mb-1">
                    <a class="nav-link text-white {{ request()->routeIs('admin.penyakit.*') ? 'active bg-primary' : '' }}"
                        href="{{ route('admin.penyakit.index') }}">
                        <i class="fa-solid fa-notes-medical me-2"></i> Penyakit
                    </a>
                </li>
                <li class="nav-item mb-1">
                    <a class="nav-link text-white {{ request()->routeIs('admin.panduan-olahraga.*') ? 'active bg-primary' : '' }}"
                        href="{{ route('admin.panduan-olahraga.index') }}">
                        <i class="fa-solid fa-dumbbell me-2"></i> Panduan Olahraga
                    </a>
                </li>
                <li class="nav-item mb-1">
                    <a class="nav-link text-white {{ request()->routeIs('admin.nilai.penyakit.*') ? 'active bg-primary' : '' }}"
                        href="{{ route('admin.nilai.penyakit.index') }}">
                        <i class="fa-solid fa-table-cells me-2"></i> Matriks Nilai
                    </a>
                </li>
                <li class="nav-item mt-3 pt-3 border-top border-secondary">
                    <a class="nav-link text-warning" href="{{ route('admin.saw.hitung') }}"
                        onclick="return confirm('Anda yakin ingin menghitung ulang semua data SAW?')">
                        <i class="fa-solid fa-calculator me-2"></i> Hitung Ulang SAW
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!-- MAIN DASHBOARD CONTENT -->
    <main class="main-content">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4 d-flex align-items-center" role="alert">
                <i class="fa-solid fa-circle-check fs-4 me-3 text-success"></i>
                <div class="flex-grow-1">{{ session('success') }}</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4 d-flex align-items-center" role="alert">
                <i class="fa-solid fa-triangle-exclamation fs-4 me-3 text-danger"></i>
                <div class="flex-grow-1">{{ session('error') }}</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Bootstrap JS Bundle & Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.2/dist/chart.umd.min.js"></script>
    @stack('scripts')
</body>

</html>
