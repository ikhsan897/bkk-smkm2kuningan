@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm text-center p-5">
                <div class="card-body">
                    <h2 class="text-success mb-3">Registrasi Berhasil!</h2>
                    <p class="lead">Akun Anda telah berhasil dibuat. Selamat datang di BKK SMK Muhammadiyah 2 Kuningan.</p>
                    <hr>
                    <p>Anda sekarang bisa mulai mencari lowongan pekerjaan yang tersedia.</p>
                    <a href="{{ route('home') }}" class="btn btn-primary mt-3">Kembali ke Halaman Utama</a>
                    <a href="{{ route('loker.index') }}" class="btn btn-outline-secondary mt-3">Lihat Semua Lowongan</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
