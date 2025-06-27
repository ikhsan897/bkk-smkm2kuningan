@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Manajemen Lowongan Kerja</h3>
        <a href="{{ route('admin.loker.create') }}" class="btn btn-primary">Tambah Lowongan Baru</a>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Perusahaan</th>
                    <th>Batas Waktu</th>
                    <th>Aksi</th>
                    <th>Pelamar</th> {{-- <-- KOLOM BARU --}}
                </tr>
            </thead>
            <tbody>
                @forelse($lokers as $key => $loker)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $loker->judul }}</td>
                    <td>{{ $loker->perusahaan }}</td>
                    <td>{{ \Carbon\Carbon::parse($loker->batas_waktu)->format('d/m/Y') }}</td>
                    <td>
                        <a href="{{ route('admin.loker.edit', $loker) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.loker.destroy', $loker) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus lowongan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                    <td>
                        {{-- TOMBOL BARU UNTUK MELIHAT PELAMAR --}}
                        {{-- Kode `lamarans_count` ini lebih efisien karena kita menggunakan withCount di Controller --}}
                        <a href="{{ route('admin.loker.pelamar', $loker->id) }}" class="btn btn-success btn-sm">
                            Lihat ({{ $loker->lamarans_count }})
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">Belum ada data lowongan.</td> {{-- <-- Ubah colspan menjadi 6 --}}
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
