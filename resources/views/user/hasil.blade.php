@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-lg border-primary">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0 text-center">
                            <i class="fa-solid fa-award"></i>
                            Hasil Rekomendasi Olahraga
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-info d-flex align-items-center" role="alert">
                            <i class="fa-solid fa-user-doctor fa-2x me-3"></i>
                            <div>
                                Hasil ini dihitung berdasarkan kondisi: <strong>{{ $penyakit->nama_penyakit }}</strong>.
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-striped table-hover align-middle fs-5">
                                <thead class="table-dark">
                                    <tr class="text-center">
                                        <th scope="col">Ranking</th>
                                        <th scope="col">Label</th>
                                        <th scope="col" class="text-start">Nama Olahraga</th>
                                        <th scope="col">Skor (Vi)</th>
                                        <th scope="col">Panduan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($hasilRekomendasi as $hasil)
                                        @php
                                            // Tentukan label berdasarkan rentang skor (nilai_vi)
                                            $score = $hasil['nilai_vi'];

                                            if ($score >= 80) {
                                                $labelText = '✅ Sangat Direkomendasikan';
                                                $labelClass = 'badge rounded-pill shadow-sm bg-success text-white';
                                            } elseif ($score >= 60) {
                                                $labelText = '✔️ Pilihan Baik';
                                                $labelClass = 'badge rounded-pill shadow-sm bg-info text-white';
                                            } else {
                                                $labelText = '⚠️ Perlu Pertimbangan';
                                                $labelClass = 'badge rounded-pill shadow-sm bg-warning text-dark';
                                            }
                                        @endphp
                                        <tr class="text-center">
                                            <td class="fw-bold fs-3">{{ $hasil['ranking'] }}</td>
                                            <td class="fw-bold">
                                                <span class="{{ $labelClass }} px-3 py-2 fs-6">{{ $labelText }}</span>
                                            </td>
                                            <td class="text-start fw-bolder">{{ $hasil['nama_alternatif'] }}</td>
                                            <td class="fw-bold">{{ $hasil['nilai_vi'] }}%</td>
                                            <td>
                                                <button class="btn btn-outline-primary" data-bs-toggle="modal"
                                                    data-bs-target="#panduanModal" data-id="{{ $hasil['alternatif_id'] }}">
                                                    <i class="fa-solid fa-book-open"></i> Lihat
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="text-center mt-4">
                            <a href="{{ route('user.index') }}" class="btn btn-secondary btn-lg">
                                <i class="fa-solid fa-arrow-left"></i>
                                Cek Ulang Rekomendasi
                            </a>
                        </div>
                    </div>
                </div>

                @if ($penyakit->nama_penyakit != 'Sehat' && $penyakit->larangan)
                    <div class="card shadow-lg border-danger mt-4">
                        <div class="card-header bg-danger text-white">
                            <h4 class="mb-0">
                                <i class="fa-solid fa-circle-exclamation"></i>
                                Perhatian Medis untuk: {{ $penyakit->nama_penyakit }}
                            </h4>
                        </div>
                        <div class="card-body fs-5">
                            <p><strong>Olahraga atau aktivitas yang TIDAK DISARANKAN / DILARANG:</strong></p>
                            <p class="fw-bold">{{ $penyakit->larangan }}</p>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>

    <div class="modal fade" id="panduanModal" tabindex="-1" aria-labelledby="panduanModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="panduanModalLabel">
                        <i class="fa-solid fa-book-open"></i>
                        Panduan Olahraga
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center" id="modal-loading">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>

                    <div id="modal-content" style="display: none;">
                        <div class="text-center mb-3">
                            <img id="modal-image" src="" alt="" class="img-fluid rounded mx-auto d-block"
                                style="max-width:260px; max-height:260px; object-fit:cover; display:none;">
                        </div>

                        <h2 id="modal-nama-olahraga" class="text-center mb-3"></h2>
                        <p id="modal-deskripsi" class="fs-5"></p>
                        <hr>

                        <h5><i class="fa-solid fa-heart-pulse text-success"></i> Manfaat Utama</h5>
                        <p id="modal-manfaat"></p>

                        <h5><i class="fa-solid fa-clock text-info"></i> Durasi Ideal</h5>
                        <p id="modal-durasi"></p>

                        <h5><i class="fa-solid fa-user-doctor text-warning"></i> Batasan Medis</h5>
                        <p id="modal-batasan"></p>

                        <h5><i class="fa-solid fa-triangle-exclamation text-danger"></i> Peringatan</h5>
                        <p id="modal-peringatan" class="fw-bold"></p>

                        <hr>
                        <h5><i class="fa-solid fa-list-ol text-primary"></i> Tata Cara</h5>
                        <div id="modal-tata-cara" class="mb-3"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var panduanModal = document.getElementById('panduanModal');

            panduanModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget;
                var alternatifId = button.getAttribute('data-id');

                var modalLoading = document.getElementById('modal-loading');
                var modalContent = document.getElementById('modal-content');

                // Reset modal
                modalLoading.style.display = 'block';
                modalContent.style.display = 'none';

                // Fetch data
                fetch(`/panduan/${alternatifId}`)
                    .then(response => response.json())
                    .then(data => {
                        // helper to convert newlines to <br>
                        function nl2br(str) {
                            if (!str) return '';
                            return (str + '').replace(/\n/g, '<br>');
                        }

                        // Populate modal
                        document.getElementById('modal-nama-olahraga').textContent = data.alternatif
                            .nama_alternatif;
                        document.getElementById('modal-deskripsi').textContent = data.deskripsi_umum;
                        document.getElementById('modal-manfaat').textContent = data.manfaat;
                        document.getElementById('modal-durasi').textContent = data.durasi_ideal;
                        document.getElementById('modal-batasan').textContent = data.batasan_medis;
                        document.getElementById('modal-peringatan').textContent = data.peringatan;

                        // Image (if available)
                        var imgEl = document.getElementById('modal-image');
                        if (data.gambar) {
                            imgEl.src = '/storage/' + data.gambar;
                            imgEl.style.display = 'block';
                        } else {
                            imgEl.style.display = 'none';
                        }

                        // Tata cara (preserve line breaks)
                        document.getElementById('modal-tata-cara').innerHTML = nl2br(data.tata_cara);

                        // Show content
                        modalLoading.style.display = 'none';
                        modalContent.style.display = 'block';
                    })
                    .catch(error => {
                        console.error('Error fetching panduan:', error);
                        document.getElementById('modal-loading').innerHTML =
                            '<p class="text-danger">Gagal memuat data panduan.</p>';
                    });
            });
        });
    </script>
@endpush
