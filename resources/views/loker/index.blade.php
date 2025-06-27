@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center mb-4">Semua Lowongan Kerja</h2>
    <div class="row">
        @forelse($lokers as $loker)
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <img src="{{ $loker->gambar ? Storage::url($loker->gambar) : 'https://via.placeholder.com/400x300.png?text=Loker' }}" class="card-img-top" alt="{{ $loker->judul }}" style="height: 200px; object-fit: cover;">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $loker->judul }}</h5>
                    <p class="card-text"><strong>{{ $loker->perusahaan }}</strong></p>
                    <p class="card-text"><small class="text-muted"><i class="bi bi-geo-alt-fill"></i> {{ $loker->lokasi }}</small></p>
                    <a href="{{ route('loker.show', $loker) }}" class="btn btn-info mt-auto">Detail Lowongan</a>
                </div>
                 <div class="card-footer text-muted">
                    Batas Waktu: {{ \Carbon\Carbon::parse($loker->batas_waktu)->format('d F Y') }}
                </div>
            </div>
        </div>
        @empty
        <p class="text-center">Belum ada lowongan kerja yang tersedia.</p>
        @endforelse
    </div>
    <div class="d-flex justify-content-center">
        {{ $lokers->links() }}
    </div>
</div>
@endsection