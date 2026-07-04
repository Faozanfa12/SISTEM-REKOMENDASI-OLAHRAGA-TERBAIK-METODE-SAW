@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg border-0">
                    <div class="card-header bg-primary text-white text-center">
                        <h4 class="mb-0">
                            <i class="fa-solid fa-stethoscope"></i>
                            Temukan Olahraga Terbaik Sesuai Kondisi Anda
                        </h4>
                    </div>
                    <div class="card-body p-4">
                        <p class="text-center text-muted">
                            Silakan isi 4 data berikut untuk mendapatkan rekomendasi olahraga yang paling sesuai
                            untuk Anda menggunakan metode Simple Additive Weighting (SAW).
                        </p>
                        <hr>

                        <form action="{{ route('user.rekomendasi') }}" method="POST" id="form-rekomendasi">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label fs-5 fw-bold">1. Pilih Kondisi Kesehatan Anda:</label>
                                <div class="form-check fs-5">
                                    <input class="form-check-input" type="radio" name="kondisi" id="kondisi-sehat"
                                        value="sehat" checked>
                                    <label class="form-check-label" for="kondisi-sehat">
                                        <i class="fa-solid fa-check-circle text-success"></i> Sehat / Normal
                                    </label>
                                </div>
                                <div class="form-check fs-5">
                                    <input class="form-check-input" type="radio" name="kondisi" id="kondisi-sakit"
                                        value="sakit">
                                    <label class="form-check-label" for="kondisi-sakit">
                                        <i class="fa-solid fa-triangle-exclamation text-danger"></i> Memiliki Riwayat
                                        Penyakit
                                    </label>
                                </div>
                            </div>

                            <div class="mb-3" id="dropdown-penyakit" style="display: none;">
                                <label for="penyakit_id" class="form-label fs-5">Pilih Jenis Penyakit:</label>
                                <select class="form-select form-select-lg @error('penyakit_id') is-invalid @enderror"
                                    name="penyakit_id" id="penyakit_id">
                                    <option value="" disabled selected>-- Pilih riwayat penyakit Anda --</option>
                                    @foreach ($penyakit->where('nama_penyakit', '!=', 'Sehat') as $p)
                                        <option value="{{ $p->id }}">{{ $p->nama_penyakit }}</option>
                                    @endforeach
                                </select>
                                @error('penyakit_id')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 mt-4">
                                <label for="c1_sub_id" class="form-label fs-5 fw-bold">2. Pilih Rentang Usia Anda:</label>
                                <select class="form-select form-select-lg @error('c1_sub_id') is-invalid @enderror"
                                    name="c1_sub_id" id="c1_sub_id" required>
                                    <option value="" disabled selected>-- Pilih usia --</option>
                                    @foreach ($options_c1 as $opt)
                                        <option value="{{ $opt->id }}">{{ $opt->pilihan }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('c1_sub_id')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 mt-4">
                                <label for="c3_sub_id" class="form-label fs-5 fw-bold">3. Apa Tujuan Utama Anda
                                    Berolahraga:</label>
                                <select class="form-select form-select-lg @error('c3_sub_id') is-invalid @enderror"
                                    name="c3_sub_id" id="c3_sub_id" required>
                                    <option value="" disabled selected>-- Pilih tujuan --</option>
                                    @foreach ($options_c3 as $opt)
                                        <option value="{{ $opt->id }}">{{ $opt->pilihan }}</option>
                                    @endforeach
                                </select>
                                @error('c3_sub_id')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 mt-4">
                                <label for="c5_sub_id" class="form-label fs-5 fw-bold">4. Preferensi Biaya Olahraga:</label>
                                <select class="form-select form-select-lg @error('c5_sub_id') is-invalid @enderror"
                                    name="c5_sub_id" id="c5_sub_id" required>
                                    <option value="" disabled selected>-- Pilih biaya --</option>
                                    @foreach ($options_c5 as $opt)
                                        <option value="{{ $opt->id }}">{{ $opt->pilihan }}</option>
                                    @endforeach
                                </select>
                                @error('c5_sub_id')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fa-solid fa-calculator"></i>
                                    Cek Rekomendasi
                                </button>
                            </div>
                        </form>
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

                function togglePenyakitDropdown() {
                    if (radioSakit.checked) {
                        dropdownPenyakit.style.display = 'block';
                        selectPenyakit.setAttribute('required', 'required');
                    } else {
                        dropdownPenyakit.style.display = 'none';
                        selectPenyakit.removeAttribute('required');
                        selectPenyakit.value = ''; // Reset pilihan
                    }
                }
                radioSehat.addEventListener('change', togglePenyakitDropdown);
                radioSakit.addEventListener('change', togglePenyakitDropdown);
                togglePenyakitDropdown(); // Initial check
            });
        </script>
    @endpush
@endsection
