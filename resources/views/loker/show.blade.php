@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="card shadow-lg">
        <div class="card-body p-5">

            {{-- Menampilkan pesan notifikasi --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row">
                <div class="col-md-4 mb-4 mb-md-0"> {{-- Tambahkan mb-4 untuk margin bawah di mobile --}}
                    @if($loker->gambar)
                        <img src="{{ asset('storage/' . $loker->gambar) }}" class="img-fluid rounded shadow-sm" alt="Gambar Lowongan">
                    @else
                        <img src="https://via.placeholder.com/400x300.png?text=Loker" class="img-fluid rounded shadow-sm" alt="Gambar tidak tersedia">
                    @endif
                </div>
                <div class="col-md-8">
                    <h1 class="display-6 fw-bold">{{ $loker->judul }}</h1>
                    <h4 class="text-muted">{{ $loker->perusahaan }}</h4>
                    <hr>
                    <p><strong><i class="bi bi-geo-alt-fill"></i> Lokasi:</strong> {{ $loker->lokasi }}</p>
                    <p><strong><i class="bi bi-calendar-x-fill"></i> Batas Waktu Lamaran:</strong> {{ \Carbon\Carbon::parse($loker->batas_waktu)->format('d F Y') }}</p>

                    {{-- Kualifikasi dipindahkan ke sini, di dalam col-md-8 --}}
                    <h5 class="mt-4"><strong>Kualifikasi:</strong></h5>
                    <p>{!! nl2br(e($loker->kualifikasi)) !!}</p>
                </div>
            </div>

            {{-- Deskripsi Pekerjaan berada di bawah kedua kolom utama --}}
            <div class="mt-5">
                <h5><strong>Deskripsi Pekerjaan:</strong></h5>
                <p>{!! nl2br(e($loker->deskripsi)) !!}</p>
            </div>

            {{-- Tombol Lamar Sekarang akan memeriksa login --}}
            <div class="text-center mt-5">
                @auth
                    <button type="button" class="btn btn-primary btn-lg px-5" data-bs-toggle="modal" data-bs-target="#lamaranModal">
                        Lamar Sekarang
                    </button>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-5">Login untuk Melamar</a>
                @endauth
            </div>

            {{-- Bagian Saran Lowongan Lain --}}
            <div class="mt-5 pt-5 border-top">
                <h4 class="mb-4">Lowongan Lain yang Mungkin Relevan</h4>
                <div class="row flex-nowrap overflow-auto pb-3 custom-scrollbar"> {{-- flex-nowrap dan overflow-auto untuk scroll horizontal --}}
                    @forelse($relatedLokers as $relatedLoker)
                        <div class="col-12 col-md-4 col-lg-3 d-flex align-items-stretch"> {{-- Kolom yang fleksibel --}}
                            <div class="card mb-3 shadow-sm" style="min-width: 250px;"> {{-- Atur min-width untuk kartu --}}
                                <img src="{{ asset('storage/' . ($relatedLoker->gambar ?? 'placeholder.png')) }}" 
                                     class="card-img-top" 
                                     alt="Gambar Loker"
                                     onerror="this.onerror=null;this.src='https://via.placeholder.com/250x150.png?text=Loker';"
                                     style="height: 150px; object-fit: cover;">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title text-truncate">{{ $relatedLoker->judul }}</h5>
                                    <p class="card-text text-muted mb-1">{{ $relatedLoker->perusahaan }}</p>
                                    <small class="text-muted"><i class="bi bi-geo-alt"></i> {{ $relatedLoker->lokasi }}</small>
                                    <small class="text-muted"><i class="bi bi-calendar-x"></i> Batas: {{ \Carbon\Carbon::parse($relatedLoker->batas_waktu)->format('d M Y') }}</small>
                                    <div class="mt-auto pt-3"> {{-- mt-auto untuk mendorong tombol ke bawah --}}
                                        <a href="{{ route('loker.show', $relatedLoker->id) }}" class="btn btn-sm btn-outline-primary w-100">Lihat Detail</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <p class="text-muted">Tidak ada lowongan lain yang tersedia saat ini.</p>
                        </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</div>

{{-- Modal hanya akan ada di DOM jika user sudah login --}}
@auth
<!-- Modal Form Lamaran -->
<div class="modal fade" id="lamaranModal" tabindex="-1" aria-labelledby="lamaranModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="lamaranModalLabel">Kirim Lamaran untuk: {{ $loker->judul }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('loker.apply', $loker->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <p>Lamaran Anda akan tercatat di akun ini. Notifikasi akan dikirim ke email di bawah.</p>

                    {{-- Bagian yang ditambahkan untuk email dan upload file CV/Surat Lamaran --}}
                    <div class="mb-3">
                        <label for="email" class="form-label"><strong>Email untuk Notifikasi<span class="text-danger">*</span></strong></label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email', auth()->user()->email) }}" required>
                        <div class="form-text">Pastikan email aktif. Notifikasi akan dikirim ke email ini.</div>
                    </div>

                    <div class="mb-3">
                        <label for="cv" class="form-label"><strong>Curriculum Vitae (CV) <span class="text-danger">*</span></strong></label>
                        <input class="form-control" type="file" id="cv" name="cv" required>
                        <div class="form-text">File wajib dalam format: PDF, DOC, DOCX (Maks: 2MB)</div>
                    </div>

                    <div class="mb-3">
                        <label for="surat_lamaran" class="form-label"><strong>Surat Lamaran (Opsional)</strong></label>
                        <input class="form-control" type="file" id="surat_lamaran" name="surat_lamaran">
                        <div class="form-text">File dalam format: PDF, DOC, DOCX (Maks: 2MB)</div>
                    </div>

                    <small class="text-danger">* Wajib diisi</small>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Kirim Lamaran</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endauth
@endsection
