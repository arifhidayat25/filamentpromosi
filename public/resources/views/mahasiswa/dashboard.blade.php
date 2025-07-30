@extends('layouts.mahasiswa')
@section('title', 'Dashboard Mahasiswa')
@section('content')
<div class="container mt-5">
    <h2>Dashboard Mahasiswa</h2>
    <p>Selamat datang, <strong>{{ $mahasiswa->nama }}</strong>!</p>
    <form method="POST" action="{{ route('mahasiswa.logout') }}">
        @csrf
        <button type="submit" class="btn btn-danger">Logout</button>
    </form>
</div>
@endsection 