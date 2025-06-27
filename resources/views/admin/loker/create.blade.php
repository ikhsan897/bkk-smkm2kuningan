@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Tambah Lowongan Baru</h3>
    <form action="{{ route('admin.loker.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group mb-3">
            <label for="judul" class="form-label">Judul Posisi</label>
            <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul') }}" required>
            @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="form-group mb-3">
            <label for="perusahaan" class="form-label">Nama Perusahaan</label>
            <input type="text" name="perusahaan" class="form-control @error('perusahaan') is-invalid @enderror" value="{{ old('perusahaan') }}" required>
            @error('perusahaan')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="form-group mb-3">
            <label for="lokasi" class="form-label">Lokasi</label>
            <input type="text" name="lokasi" class="form-control @error('lokasi') is-invalid @enderror" value="{{ old('lokasi') }}" required>
            @error('lokasi')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="form-group mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="5" required>{{ old('deskripsi') }}</textarea>
            @error('deskripsi')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="form-group mb-3">
            <label for="kualifikasi" class="form-label">Kualifikasi</label>
            <textarea name="kualifikasi" class="form-control @error('kualifikasi') is-invalid @enderror" rows="5" required>{{ old('kualifikasi') }}</textarea>
            @error('kualifikasi')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="form-group mb-3">
            <label for="batas_waktu" class="form-label">Batas Waktu</label>
            {{-- Tambahkan ID unik untuk JavaScript --}}
            <input type="date" id="batas_waktu_input" name="batas_waktu" class="form-control @error('batas_waktu') is-invalid @enderror" value="{{ old('batas_waktu') }}" required>
            @error('batas_waktu')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="form-group mb-3">
            <label for="gambar" class="form-label">Gambar/Poster</label>
            <input type="file" name="gambar" class="form-control @error('gambar') is-invalid @enderror">
            @error('gambar')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('admin.loker.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>

{{-- Script untuk membatasi tanggal --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Dapatkan tanggal hari ini
        const today = new Date();

        // Format tanggal hari ini menjadi YYYY-MM-DD
        const year = today.getFullYear();
        // getMonth() adalah 0-indexed, jadi tambahkan 1
        // padStart(2, '0') untuk memastikan format dua digit (misal: 06 bukan 6)
        const month = String(today.getMonth() + 1).padStart(2, '0');
        const day = String(today.getDate()).padStart(2, '0');
        const todayFormatted = `${year}-${month}-${day}`;

        // Dapatkan elemen input tanggal berdasarkan ID-nya
        // Pastikan ID ini sesuai dengan ID yang Anda berikan pada input date di atas
        const batasWaktuInput = document.getElementById('batas_waktu_input');

        // Setel atribut 'min' pada input tanggal
        if (batasWaktuInput) {
            batasWaktuInput.setAttribute('min', todayFormatted);
        }
    });
</script>

@endsection