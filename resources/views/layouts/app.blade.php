<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">


    <!-- Scripts (Bootstrap 5) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        /* Sedikit custom style untuk jumbotron */
        .jumbotron-bg {
            background-size: cover;
            background-position: center;
            color: white;
        }
        .jumbotron-overlay {
            background-color: rgba(0, 0, 0, 0.5);
            padding: 4rem 2rem;
            border-radius: 0.5rem;
        }

        /* == CSS BARU UNTUK EFEK HOVER == */
        .navbar-dark .navbar-nav .nav-link {
            transition: all 0.2s ease-in-out; /* Transisi lebih halus */
            padding-left: 0.75rem;
            padding-right: 0.75rem;
            border-radius: 0.375rem; /* Sedikit lebih bulat */
            font-weight: 500; /* Sedikit lebih tebal secara default */
        }
        .navbar-dark .navbar-nav .nav-link:hover,
        .navbar-dark .navbar-nav .nav-link:focus { /* Tambahkan :focus untuk aksesibilitas */
            background-color: rgba(255, 255, 255, 0.2); /* Latar belakang lebih jelas */
            color: #ffffff; /* Pastikan teks tetap putih terang */
            transform: translateY(-2px); /* Efek sedikit terangkat */
        }
        .dropdown-item:hover,
        .dropdown-item:focus {
            background-color: #0d6efd; /* Warna biru primer Bootstrap */
            color: white !important;
        }
    </style>
</head>
<body>
    <div id="app">
        {{-- Mengubah class navbar menjadi tema biru (bg-primary) dan teks putih (navbar-dark) --}}
        <nav class="navbar navbar-expand-md navbar-dark bg-primary shadow-sm">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                    {{-- == INI BAGIAN LOGO DI NAVIGASI == --}}
                    {{-- Pastikan nama file (logo-sekolah.png) sesuai dengan file Anda di folder public/images --}}
                    <img src="{{ asset('images/logo.png') }}" alt="Logo Sekolah" style="height: 30px; margin-right: 10px;">
                    BKK SMKM2KNG
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('loker.index') }}">Lihat Lowongan</a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('profil.lamaran') }}">
                                        Riwayat Lamaran
                                    </a>

                                    @if(Auth::user()->role == 'admin')
                                    <a class="dropdown-item" href="{{ route('admin.loker.index') }}">
                                        Menu Admin
                                    </a>
                                    @endif

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            {{-- Menampilkan pesan error dari middleware --}}
            @if (session('error'))
                <div class="container">
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                </div>
            @endif
            
            @yield('content')
        </main>
    </div>
</body>
</html>