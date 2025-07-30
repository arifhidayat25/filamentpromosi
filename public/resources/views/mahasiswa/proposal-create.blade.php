@extends('layouts.mahasiswa')
@section('title', 'Buat Pengajuan Baru')
@section('content')
<h4 class="mb-4">Form Pengajuan Baru</h4>
<form method="POST" action="{{ route('mahasiswa.proposal.store') }}">
    @csrf
    <div class="mb-3">
        <label for="school_id" class="form-label">Sekolah Tujuan</label>
        <select class="form-select @error('school_id') is-invalid @enderror" id="school_id" name="school_id" required>
            <option value="">-- Pilih Sekolah --</option>
            @foreach($schools as $school)
                <option value="{{ $school->id }}" {{ old('school_id') == $school->id ? 'selected' : '' }}>{{ $school->name }}</option>
            @endforeach
        </select>
        @error('school_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
        <label for="proposed_date" class="form-label">Tanggal Perkiraan Pelaksanaan</label>
        <input type="date" class="form-control @error('proposed_date') is-invalid @enderror" id="proposed_date" name="proposed_date" value="{{ old('proposed_date') }}">
        @error('proposed_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
        <label for="notes" class="form-label">Catatan Awal</label>
        <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes" rows="3">{{ old('notes') }}</textarea>
        @error('notes')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <button type="submit" class="btn btn-success">Ajukan</button>
    <a href="{{ route('mahasiswa.proposal.list') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection 