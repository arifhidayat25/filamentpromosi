@extends('layouts.mahasiswa')
@section('title', 'Edit Profil Mahasiswa')
@section('content')

<h4 class="mb-4">Edit Profil Mahasiswa</h4>
<form method="POST" action="{{ route('mahasiswa.profil.update') }}">
    @csrf
    {{-- NIM dan Email tidak bisa diubah --}}
    <div class="mb-3">
        <label class="form-label">NIM</label>
        <input type="text" class="form-control" value="{{ $mahasiswa->nim }}" readonly disabled>
    </div>
    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" class="form-control" value="{{ $mahasiswa->email }}" readonly disabled>
    </div>

    {{-- KUNCI PERBAIKAN 1: Ubah 'nama' menjadi 'name' --}}
    <div class="mb-3">
        <label for="name" class="form-label">Nama</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $mahasiswa->name) }}" required>
        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="mb-3">
        <label for="prodi" class="form-label">Prodi</label>
        <input type="text" class="form-control @error('prodi') is-invalid @enderror" id="prodi" name="prodi" value="{{ old('prodi', $mahasiswa->prodi) }}" required>
        @error('prodi')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
        <label for="no_telepon" class="form-label">No Telepon</label>
        <input type="text" class="form-control @error('no_telepon') is-invalid @enderror" id="no_telepon" name="no_telepon" value="{{ old('no_telepon', $mahasiswa->no_telepon) }}" required>
        @error('no_telepon')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <hr>
    <p class="text-muted">Isi bagian di bawah ini hanya jika Anda ingin mengubah password.</p>
    <div class="mb-3">
        <label for="password" class="form-label">Password Baru</label>
        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
        @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
        <label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>
        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
    </div>
    <button type="submit" class="btn btn-success">Simpan Perubahan</button>
    <a href="{{ route('mahasiswa.profil') }}" class="btn btn-secondary">Batal</a>
</form>

@endsection