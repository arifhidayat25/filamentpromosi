<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Portal Mahasiswa')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #f8fafc 0%, #e0e7ff 100%);
            min-height: 100vh;
        }
        .card {
            box-shadow: 0 4px 24px rgba(0,0,0,0.08);
        }
        .navbar-brand {
            font-weight: bold;
            letter-spacing: 1px;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-4">
    <div class="container">
        <a class="navbar-brand" href="/">Portal Mahasiswa</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            
            {{-- KUNCI PERUBAHAN 1: Gunakan @auth standar --}}
            @auth
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('mahasiswa.dashboard') }}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('mahasiswa.proposal.list') }}">Pengajuan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('mahasiswa.school.create') }}">Pengajuan Sekolah</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('mahasiswa.profil') }}">Profil</a>
                </li>
            </ul>
            @endauth
        </div>
        <div class="d-flex align-items-center">
            
            {{-- KUNCI PERUBAHAN 2: Gunakan @auth standar dan ambil data dari Auth::user() --}}
            @auth
                {{-- Tampilkan nama user yang login --}}
                <span class="me-3">Halo, {{ Auth::user()->name }}</span>
                
                {{-- Form logout menunjuk ke route yang benar --}}
                <form method="POST" action="{{ route('mahasiswa.logout') }}">
                    @csrf
                    <button class="btn btn-outline-danger btn-sm" type="submit">Logout</button>
                </form>
            @else
                {{-- Bagian ini untuk user yang belum login --}}
                <a href="{{ route('mahasiswa.login') }}" class="btn btn-outline-primary btn-sm me-2">Login</a>
                <a href="{{ route('mahasiswa.register') }}" class="btn btn-primary btn-sm">Register</a>
            @endauth
        </div>
    </div>
</nav>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-7">
            <div class="card p-4 my-5">
                @yield('content')
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>