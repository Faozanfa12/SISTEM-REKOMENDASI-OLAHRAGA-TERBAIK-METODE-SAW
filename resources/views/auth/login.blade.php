@extends('layouts.app')

@section('title', 'Masuk Administrator — SPK Olahraga Lansia')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card border-0 shadow-xl rounded-4 overflow-hidden">
                <div class="card-header-gradient text-center py-4">
                    <div class="brand-icon-box mx-auto mb-3" style="width: 56px; height: 56px; font-size: 1.5rem;">
                        <i class="fa-solid fa-user-shield"></i>
                    </div>
                    <h3 class="fw-bold mb-1">Masuk Panel Admin</h3>
                    <p class="text-white text-opacity-75 small mb-0">
                        Sistem Pendukung Keputusan Rekomendasi Olahraga Lansia
                    </p>
                </div>

                <div class="card-body p-4 p-md-5">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- EMAIL INPUT -->
                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold text-dark small">Alamat Email Administrator</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 text-muted">
                                    <i class="fa-solid fa-envelope"></i>
                                </span>
                                <input id="email" type="email"
                                    class="form-control border-start-0 ps-0 @error('email') is-invalid @enderror" 
                                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                                    placeholder="admin@lansia.id">
                            </div>
                            @error('email')
                                <span class="text-danger small mt-1 d-block">
                                    <i class="fa-solid fa-circle-exclamation me-1"></i>{{ $message }}
                                </span>
                            @enderror
                        </div>

                        <!-- PASSWORD INPUT -->
                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <label for="password" class="form-label fw-bold text-dark small mb-0">Kata Sandi</label>
                                @if (Route::has('password.request'))
                                    <a class="small text-muted" href="{{ route('password.request') }}">
                                        Lupa kata sandi?
                                    </a>
                                @endif
                            </div>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 text-muted">
                                    <i class="fa-solid fa-lock"></i>
                                </span>
                                <input id="password" type="password"
                                    class="form-control border-start-0 ps-0 @error('password') is-invalid @enderror" 
                                    name="password" required autocomplete="current-password"
                                    placeholder="••••••••">
                            </div>
                            @error('password')
                                <span class="text-danger small mt-1 d-block">
                                    <i class="fa-solid fa-circle-exclamation me-1"></i>{{ $message }}
                                </span>
                            @enderror
                        </div>

                        <!-- REMEMBER ME -->
                        <div class="mb-4 d-flex align-items-center justify-content-between">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                    {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label text-muted small" for="remember">
                                    Ingat saya di perangkat ini
                                </label>
                            </div>
                        </div>

                        <!-- SUBMIT BUTTON -->
                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fa-solid fa-arrow-right-to-bracket me-2"></i> Masuk Sekarang
                            </button>
                        </div>

                        <div class="text-center mt-4">
                            <a href="{{ url('/') }}" class="text-muted small">
                                <i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Halaman Utama
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
