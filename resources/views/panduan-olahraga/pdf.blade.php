<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">

    <div style="text-align: center;">
        <img src="{{ public_path('storage/' . $panduan->gambar) }}" alt="gambar"
            style="max-width:50%; height:auto; margin-bottom:20px;">
    </div>

    <title>{{ $panduan->alternatif->nama_alternatif }}</title>
    <style>
        body {
            font-family: sans-serif;
            line-height: 1.6;
            padding: 20px;
        }

        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 30px;
        }

        h2 {
            color: #444;
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
            margin-top: 25px;
        }

        .section {
            margin-bottom: 25px;
        }

        ul {
            padding-left: 20px;
        }

        li {
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <h1>{{ $panduan->alternatif->nama_alternatif }}</h1>

    <div class="section">
        <h2>Deskripsi Umum</h2>
        <p>{!! nl2br(e($panduan->deskripsi_umum)) !!}</p>
    </div>

    <div class="section">
        <h2>Manfaat</h2>
        <p>{!! nl2br(e($panduan->manfaat)) !!}</p>
    </div>

    <div class="section">
        <h2>Durasi Ideal</h2>
        <p>{!! nl2br(e($panduan->durasi_ideal)) !!}</p>
    </div>

    <div class="section">
        <h2>Batasan Medis</h2>
        <p>{!! nl2br(e($panduan->batasan_medis)) !!}</p>
    </div>

    <div class="section">
        <h2>Peringatan</h2>
        <p>{!! nl2br(e($panduan->peringatan)) !!}</p>
    </div>
</body>

</html>
