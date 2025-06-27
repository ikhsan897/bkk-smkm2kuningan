@extends('layouts.app')

@section('content')
<div class="container py-4">

    {{-- BAGIAN HEADER / JUMBOTRON DENGAN BACKGROUND --}}
    {{-- Ganti URL gambar dengan URL foto sekolah Anda --}}
    <div class="p-5 mb-5 rounded-3 jumbotron-bg" style="background-image: url('{{ asset('images/foto.jpg') }}');">
        <div class="jumbotron-overlay text-center">
            <h1 class="display-4 fw-bold">Bursa Kerja Khusus (BKK)</h1>
            <p class="fs-4">SMK Muhammadiyah 2 Kuningan</p>
            <p class="lead">Menjembatani lulusan terbaik dengan dunia industri dan kerja.</p>
        </div>
    </div>

    {{-- JUDUL BAGIAN LOWONGAN --}}
    <h3 class="text-center mb-4 fw-bold">Lowongan Terbaru</h3>

    {{-- BAGIAN MENAMPILKAN KARTU LOWONGAN --}}
    <div class="row">
        @forelse($latestLokers as $loker)
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm">
                    @if($loker->gambar)
                        <img src="{{ asset('storage/' . $loker->gambar) }}" class="card-img-top" alt="{{ $loker->judul }}" style="height: 180px; object-fit: cover;">
                    @else
                        <img src="https://placehold.co/600x400/EBF4FF/76839A?text=Loker" class="card-img-top" alt="Gambar tidak tersedia" style="height: 180px; object-fit: cover;">
                    @endif
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ Str::limit($loker->judul, 40) }}</h5>
                        <p class="card-text text-muted">{{ $loker->perusahaan }}</p>
                        <a href="{{ route('loker.show', $loker) }}" class="btn btn-primary mt-auto">Lihat Detail</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col text-center">
                <p>Belum ada lowongan terbaru yang dipublikasikan.</p>
            </div>
        @endforelse
    </div>

    {{-- Tombol untuk melihat semua loker --}}
    @if($latestLokers->count() > 0)
    <div class="text-center mt-4">
         <a href="{{ route('loker.index') }}" class="btn btn-outline-primary btn-lg">Lihat Semua Lowongan</a>
    </div>
    @endif

</div>
@endsection
