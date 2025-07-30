@extends('layouts.mahasiswa')
@section('title', 'Riwayat Pengajuan')
@section('content')
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
<h4 class="mb-4">Riwayat Pengajuan</h4>
<a href="{{ route('mahasiswa.proposal.create') }}" class="btn btn-primary mb-3">Buat Pengajuan Baru</a>
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Sekolah Tujuan</th>
            <th>Tanggal Perkiraan</th>
            <th>Status</th>
            <th>Catatan</th>
            <th>Alasan Penolakan</th>
            <th>Waktu Pengajuan</th>
        </tr>
    </thead>
    <tbody>
        @forelse($proposals as $proposal)
        <tr>
            <td>{{ $proposal->school->name ?? '-' }}</td>
            <td>{{ $proposal->proposed_date ? date('d-m-Y', strtotime($proposal->proposed_date)) : '-' }}</td>
            <td><span class="badge bg-info">{{ ucfirst(str_replace('_', ' ', $proposal->status)) }}</span></td>
            <td>{{ $proposal->notes }}</td>
            <td>{{ $proposal->rejection_reason }}</td>
            <td>{{ $proposal->created_at->format('d-m-Y H:i') }}</td>
        </tr>
        @empty
        <tr><td colspan="6" class="text-center">Belum ada pengajuan.</td></tr>
        @endforelse
        @foreach($proposals as $proposal)
    <tr>
        <td>{{ $proposal->school->name }}</td>
        <td>{{ $proposal->proposed_date }}</td>
        <td><span class="badge bg-info">{{ $proposal->status }}</span></td>
        <td>
            {{-- Tampilkan tombol "Isi Laporan" hanya jika statusnya sesuai --}}
            @if(in_array($proposal->status, ['disetujui_staf', 'siap_dilaksanakan']))
                <a href="{{ route('mahasiswa.report.create', $proposal) }}" class="btn btn-success btn-sm">Isi Laporan</a>
            @else
                <a href="#" class="btn btn-secondary btn-sm">Detail</a>
            @endif
        </td>
    </tr>
@endforeach
    </tbody>
</table>
@endsection 