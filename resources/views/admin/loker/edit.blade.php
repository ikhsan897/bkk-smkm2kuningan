@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Edit Lowongan</h3>
    <form action="{{ route('admin.loker.update', $loker->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group mb-3">
            <label for="judul" class="form-label">Judul Posisi</label>
            <input type="text" name="judul" class="form-control" value="{{ old('judul', $loker->judul) }}" required>
        </div>
        <div class="form-group mb-3">
            <label for="perusahaan" class="form-label">Nama Perusahaan</label>
            <input type="text" name="perusahaan" class="form-control" value="{{ old('perusahaan', $loker->perusahaan) }}" required>
        </div>
        <div class="form-group mb-3">
            <label for="lokasi" class="form-label">Lokasi</label>
            <input type="text" name="lokasi" class="form-control" value="{{ old('lokasi', $loker->lokasi) }}" required>
        </div>
        <div class="form-group mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="5" required>{{ old('deskripsi', $loker->deskripsi) }}</textarea>
        </div>
        <div class="form-group mb-3">
            <label for="kualifikasi" class="form-label">Kualifikasi</label>
            <textarea name="kualifikasi" class="form-control" rows="5" required>{{ old('kualifikasi', $loker->kualifikasi) }}</textarea>
        </div>
        <div class="form-group mb-3">
            <label for="batas_waktu" class="form-label">Batas Waktu</label>
            <input type="date" name="batas_waktu" class="form-control" value="{{ old('batas_waktu', $loker->batas_waktu) }}" required>
        </div>
        <div class="form-group mb-3">
            <label for="gambar" class="form-label">Gambar/Poster (Kosongkan jika tidak ingin diubah)</label>
            <input type="file" name="gambar" class="form-control">
            @if($loker->gambar)
                <small class="form-text text-muted">Gambar saat ini: <a href="{{ Storage::url($loker->gambar) }}" target="_blank">Lihat Gambar</a></small>
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('admin.loker.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection