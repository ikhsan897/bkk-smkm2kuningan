@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Admin Dashboard') }}</div>
                <div class="card-body">
                    <p>Selamat Datang, <strong>{{ Auth::user()->name }}</strong>!</p>
                    <p>Anda telah login sebagai Admin. Dari sini Anda bisa mengelola data lowongan kerja.</p>
                    <hr>
                    <a href="{{ route('admin.loker.index') }}" class="btn btn-primary">Kelola Lowongan Kerja</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection