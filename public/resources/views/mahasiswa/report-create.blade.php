@extends('layouts.mahasiswa')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Formulir Laporan Kegiatan Promosi</div>

                <div class="card-body">
                    <h5>Proposal untuk: {{ $proposal->school->name }}</h5>
                    <p>Silakan isi detail laporan kegiatan yang telah dilaksanakan.</p>
                    
                    <form method="POST" action="{{ route('mahasiswa.report.store', $proposal) }}">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="event_date">Tanggal Pasti Pelaksanaan</label>
                            <input id="event_date" type="date" class="form-control @error('event_date') is-invalid @enderror" name="event_date" value="{{ old('event_date') }}" required>
                            @error('event_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="attendees_count">Jumlah Peserta (Siswa)</label>
                            <input id="attendees_count" type="number" class="form-control @error('attendees_count') is-invalid @enderror" name="attendees_count" value="{{ old('attendees_count') }}" required>
                            @error('attendees_count')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="qualitative_notes">Catatan Kualitatif</label>
                            <textarea id="qualitative_notes" class="form-control @error('qualitative_notes') is-invalid @enderror" name="qualitative_notes" rows="4" required>{{ old('qualitative_notes') }}</textarea>
                             @error('qualitative_notes')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="documentation_path">Link Dokumentasi (Google Drive, dll.)</label>
                            <input id="documentation_path" type="text" class="form-control @error('documentation_path') is-invalid @enderror" name="documentation_path" value="{{ old('documentation_path') }}">
                            @error('documentation_path')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">
                            Submit Laporan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
