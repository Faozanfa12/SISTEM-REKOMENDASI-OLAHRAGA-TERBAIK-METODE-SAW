<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin - SPK Olahraga Lansia</title>

    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        body {
            background-color: #f8f9fa;
        }

        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 100;
            padding: 48px 0 0;
            box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
            background-color: #343a40;
        }

        .sidebar-sticky {
            padding: 20px;
        }

        .nav-link {
            color: #c2c7d0;
            font-weight: 500;
        }

        .nav-link:hover {
            color: #fff;
        }

        .nav-link.active {
            color: #fff;
            font-weight: bold;
        }

        .nav-link .fa-solid {
            margin-right: 8px;
            width: 20px;
            text-align: center;
        }

        .main-content {
            margin-left: 240px;
            padding: 20px;
        }

        /* Responsive adjustments */
        @media (max-width: 991.98px) {
            .sidebar {
                position: static;
                width: 100%;
                height: auto;
                padding: 0;
                box-shadow: none;
            }

            .sidebar-sticky {
                padding: 10px 0;
            }

            .main-content {
                margin-left: 0;
                padding: 16px;
            }
        }

        @media (max-width: 575.98px) {
            .nav-link .fa-solid {
                margin-right: 6px;
                width: 18px;
            }

            .navbar-brand {
                padding-left: 1rem;
                font-size: 0.95rem;
            }
        }
    </style>
</head>

<body>
    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <button class="navbar-toggler d-md-none ms-2" type="button" data-bs-toggle="offcanvas"
            data-bs-target="#offcanvasSidebar" aria-controls="offcanvasSidebar" aria-expanded="false"
            aria-label="Toggle navigation">
            <i class="fa fa-bars text-white"></i>
        </button>
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="{{ route('admin.dashboard') }}">
            <i class="fa-solid fa-person-walking"></i> Admin SPK Lansia
        </a>
        <div class="navbar-nav">
            <div class="nav-item text-nowrap">
                <a class="nav-link px-3" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa-solid fa-right-from-bracket"></i> Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
    </header>

    <style>
        /* make the toggler smaller and visible */
        .navbar-toggler {
            border: none;
            background: transparent;
            font-size: 1.05rem;
        }

        .navbar-toggler:focus {
            box-shadow: none;
        }
    </style>

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-none d-md-block sidebar">
                <div class="position-sticky sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                                href="{{ route('admin.dashboard') }}">
                                <i class="fa-solid fa-chart-line"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.kriteria.*') ? 'active' : '' }}"
                                href="{{ route('admin.kriteria.index') }}">
                                <i class="fa-solid fa-list-check"></i> Kriteria
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.alternatif.*') ? 'active' : '' }}"
                                href="{{ route('admin.alternatif.index') }}">
                                <i class="fa-solid fa-person-biking"></i> Alternatif
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.penyakit.*') ? 'active' : '' }}"
                                href="{{ route('admin.penyakit.index') }}">
                                <i class="fa-solid fa-virus"></i> Penyakit
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.panduan-olahraga.*') ? 'active' : '' }}"
                                href="{{ route('admin.panduan-olahraga.index') }}">
                                <i class="fa-solid fa-dumbbell"></i> Panduan Olahraga
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.subkriteria.*') ? 'active' : '' }}"
                                href="{{ route('admin.subkriteria.index') }}">
                                <i class="fa-solid fa-list-ol"></i> Pilihan (Sub-Kriteria)
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.nilai.penyakit.*') ? 'active' : '' }}"
                                href="{{ route('admin.nilai.penyakit.index') }}">
                                <i class="fa-solid fa-table-cells"></i> Data Nilai
                            </a>
                        </li>
                        <li class="nav-item mt-3 pt-3 border-top">
                            <a class="nav-link" href="{{ route('admin.saw.hitung') }}"
                                onclick="return confirm('Anda yakin ingin menghitung ulang semua data SAW?')">
                                <i class="fa-solid fa-calculator"></i> Hitung Ulang SAW
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Offcanvas sidebar for small screens -->
            <div class="offcanvas offcanvas-start bg-dark text-white" tabindex="-1" id="offcanvasSidebar"
                aria-labelledby="offcanvasSidebarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title text-white" id="offcanvasSidebarLabel">Menu</h5>
                    <button type="button" class="btn-close btn-close-white text-reset" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <div class="offcanvas-body p-0">
                    <div class="position-sticky sidebar-sticky p-3">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }} text-white"
                                    href="{{ route('admin.dashboard') }}">
                                    <i class="fa-solid fa-chart-line"></i> Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.kriteria.*') ? 'active' : '' }} text-white"
                                    href="{{ route('admin.kriteria.index') }}">
                                    <i class="fa-solid fa-list-check"></i> Kriteria
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.alternatif.*') ? 'active' : '' }} text-white"
                                    href="{{ route('admin.alternatif.index') }}">
                                    <i class="fa-solid fa-person-biking"></i> Alternatif
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.penyakit.*') ? 'active' : '' }} text-white"
                                    href="{{ route('admin.penyakit.index') }}">
                                    <i class="fa-solid fa-virus"></i> Penyakit
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.panduan-olahraga.*') ? 'active' : '' }} text-white"
                                    href="{{ route('admin.panduan-olahraga.index') }}">
                                    <i class="fa-solid fa-dumbbell"></i> Panduan Olahraga
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.subkriteria.*') ? 'active' : '' }} text-white"
                                    href="{{ route('admin.subkriteria.index') }}">
                                    <i class="fa-solid fa-list-ol"></i> Pilihan (Sub-Kriteria)
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.nilai.penyakit.*') ? 'active' : '' }} text-white"
                                    href="{{ route('admin.nilai.penyakit.index') }}">
                                    <i class="fa-solid fa-table-cells"></i> Data Nilai
                                </a>
                            </li>
                            <li class="nav-item mt-3 pt-3 border-top">
                                <a class="nav-link text-white" href="{{ route('admin.saw.hitung') }}"
                                    onclick="return confirm('Anda yakin ingin menghitung ulang semua data SAW?')">
                                    <i class="fa-solid fa-calculator"></i> Hitung Ulang SAW
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <main class="col-md-9 ms-sm-auto col-lg-10 main-content">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.2/dist/chart.umd.min.js"></script>
    @stack('scripts')
</body>

</html>
