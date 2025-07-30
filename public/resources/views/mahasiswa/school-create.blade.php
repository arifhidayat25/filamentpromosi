@extends('layouts.mahasiswa')
@section('title', 'Form Pengajuan Sekolah')
@section('content')
<h4 class="mb-4">Form Pengajuan Sekolah</h4>

@if(session('success'))
    <div class="alert alert-success mb-4">{{ session('success') }}</div>
@endif

<form method="POST" action="{{ route('mahasiswa.school.store') }}">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Nama Sekolah</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    
    <div class="mb-3">
        <label for="address" class="form-label">Alamat</label>
        <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="3" required>{{ old('address') }}</textarea>
        @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    
    <div class="mb-3">
        <label for="city" class="form-label">Kota</label>
        <input type="text" class="form-control @error('city') is-invalid @enderror" id="city" name="city" value="{{ old('city') }}" required>
        @error('city')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    
    <div class="mb-3">
        <label for="contact_person" class="form-label">Nama Kontak</label>
        <input type="text" class="form-control @error('contact_person') is-invalid @enderror" id="contact_person" name="contact_person" value="{{ old('contact_person') }}" required>
        @error('contact_person')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    
    <div class="mb-3">
        <label for="contact_phone" class="form-label">Nomor Telepon</label>
        <input type="tel" class="form-control @error('contact_phone') is-invalid @enderror" id="contact_phone" name="contact_phone" value="{{ old('contact_phone') }}" required>
        @error('contact_phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="{{ route('mahasiswa.dashboard') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection