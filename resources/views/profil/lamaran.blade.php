@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h2 class="mb-4 text-center">Riwayat Lamaran Saya</h2>
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Posisi yang Dilamar</th>
                                    <th scope="col">Perusahaan</th>
                                    <th scope="col">Tanggal Melamar</th>
                                    <th scope="col" class="text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($lamarans as $index => $lamaran)
                                    <tr>
                                        <td>{{ $lamarans->firstItem() + $index }}</td>
                                        <td>
                                            <a href="{{ route('loker.show', $lamaran->lowonganKerja->id) }}" class="text-decoration-none">
                                                {{ $lamaran->lowonganKerja->judul }}
                                            </a>
                                        </td>
                                        <td>{{ $lamaran->lowonganKerja->perusahaan }}</td>
                                        <td>{{ $lamaran->created_at->format('d F Y') }}</td>
                                        <td class="text-center">
                                            @php
                                                $statusClass = '';
                                                switch ($lamaran->status) {
                                                    case 'diterima':
                                                        $statusClass = 'bg-success';
                                                        break;
                                                    case 'ditolak':
                                                        $statusClass = 'bg-danger';
                                                        break;
                                                    case 'dipertimbangkan':
                                                        $statusClass = 'bg-info text-dark';
                                                        break;
                                                    case 'dilihat':
                                                        $statusClass = 'bg-primary';
                                                        break;
                                                    default:
                                                        $statusClass = 'bg-secondary';
                                                }
                                            @endphp
                                            <span class="badge {{ $statusClass }} rounded-pill px-3 py-2">
                                                {{ Str::ucfirst($lamaran->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-4">Anda belum pernah mengirim lamaran. <a href="{{ route('loker.index') }}">Cari lowongan sekarang!</a></td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    {{-- Navigasi Paginasi --}}
                    <div class="d-flex justify-content-center mt-3">
                        {{ $lamarans->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection