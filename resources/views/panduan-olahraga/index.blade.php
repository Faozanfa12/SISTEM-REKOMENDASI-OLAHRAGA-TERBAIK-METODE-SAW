@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-semibold mb-6 text-center text-primary">Panduan Olahraga untuk Lansia</h1>

        {{-- Pastikan div card-grid ada di sini --}}
        <div class="card-grid">
            @foreach ($panduanOlahraga as $panduan)
                {{-- Tambahkan kelas panduan-card di sini --}}
                <div class="panduan-card">
                    @if ($panduan->gambar)
                        <img src="{{ asset('storage/' . $panduan->gambar) }}" alt="{{ $panduan->nama }}" class="img-fluid">
                    @else
                        <div class="d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-dumbbell"></i>
                        </div>
                    @endif
                    <div class="p-4">
                        <h2 class="font-semibold">{{ $panduan->nama }}</h2>
                        <p class="text-gray-600 mb-4 line-clamp-3">
                            {{ Str::limit($panduan->deskripsi_singkat, 150) }}
                        </p>
                        <a href="{{ route('panduan-olahraga.show', $panduan->id) }}" class="btn">
                            <i class="fa-solid fa-eye me-1"></i> Lihat Detail
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
