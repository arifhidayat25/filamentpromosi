@extends('layouts.mahasiswa')
@section('title', 'Profil Mahasiswa')
@section('content')
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
<h4 class="mb-4">Profil Mahasiswa</h4>
<ul class="list-group mb-3">
<li class="list-group-item"><strong>Nama:</strong> {{ $mahasiswa->name }}</li>    <li class="list-group-item"><strong>NIM:</strong> {{ $mahasiswa->nim }}</li>
    <li class="list-group-item"><strong>Prodi:</strong> {{ $mahasiswa->prodi }}</li>
    <li class="list-group-item"><strong>No Telepon:</strong> {{ $mahasiswa->no_telepon }}</li>
    <li class="list-group-item"><strong>Email:</strong> {{ $mahasiswa->email }}</li>
</ul>
<a href="{{ route('mahasiswa.profil.edit') }}" class="btn btn-primary">Edit Profil</a>
@endsection 