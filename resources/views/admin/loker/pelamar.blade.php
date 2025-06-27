@extends('layouts.app') {{-- Atau layout admin Anda --}}

@section('content')
<div class="container-fluid py-4">
    <h3 class="mb-4">Daftar Pelamar untuk: {{ $loker->judul }}</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Pelamar</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Pelamar</th>
                            <th>Email Notifikasi</th>
                            <th>Tanggal Melamar</th>
                            <th>Dokumen</th>
                            <th class="text-center">Status Saat Ini</th>
                            <th>Ubah Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($loker->lamarans as $index => $lamaran)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $lamaran->user->name ?? 'N/A' }}</td>
                            <td>{{ $lamaran->email }}</td>
                            <td>{{ $lamaran->created_at->format('d M Y, H:i') }}</td>
                            <td>
                                <a href="{{ asset('storage/' . $lamaran->cv_path) }}" class="btn btn-sm btn-info" target="_blank">Lihat CV</a>
                                @if($lamaran->surat_lamaran_path)
                                <a href="{{ asset('storage/' . $lamaran->surat_lamaran_path) }}" class="btn btn-sm btn-secondary" target="_blank">Lihat Surat</a>
                                @endif
                            </td>
                            <td class="text-center"><span class="badge bg-secondary text-white p-2">{{ Str::ucfirst($lamaran->status) }}</span></td>
                            <td>
                                <form action="{{ route('admin.lamaran.updateStatus', $lamaran->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <div class="input-group">
                                        <select name="status" class="form-select form-select-sm">
                                            <option value="pending" @if($lamaran->status == 'pending') selected @endif>Pending</option>
                                            <option value="dilihat" @if($lamaran->status == 'dilihat') selected @endif>Dilihat</option>
                                            <option value="dipertimbangkan" @if($lamaran->status == 'dipertimbangkan') selected @endif>Dipertimbangkan</option>
                                            <option value="diterima" @if($lamaran->status == 'diterima') selected @endif>Diterima</option>
                                            <option value="ditolak" @if($lamaran->status == 'ditolak') selected @endif>Ditolak</option>
                                        </select>
                                        <button type="submit" class="btn btn-sm btn-primary">Update</button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">Belum ada pelamar untuk lowongan ini.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
