@extends('layouts.mahasiswa')
@section('title', 'Profil Mahasiswa')
@section('content')

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<h4 class="mb-4">Profil Mahasiswa</h4>

<div class="card">
    <div class="card-body">
        <ul class="list-group list-group-flush">
            {{-- Ini sudah benar menggunakan ->name --}}
            <li class="list-group-item"><strong>Nama:</strong> {{ $mahasiswa->name }}</li>
            <li class="list-group-item"><strong>NIM:</strong> {{ $mahasiswa->nim }}</li>
            <li class="list-group-item"><strong>Prodi:</strong> {{ $mahasiswa->prodi }}</li>
            <li class="list-group-item"><strong>No Telepon:</strong> {{ $mahasiswa->no_telepon }}</li>
            <li class="list-group-item"><strong>Email:</strong> {{ $mahasiswa->email }}</li>
        </ul>
    </div>
</div>

<a href="{{ route('mahasiswa.profil.edit') }}" class="btn btn-primary mt-3">Edit Profil</a>

@endsections