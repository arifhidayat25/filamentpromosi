<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\MahasiswaController; // Pastikan namespace ini benar

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

// Rute untuk login admin/Filament (biarkan seperti ini)
Route::get('/login', function () {
    return 'Halaman login admin. Silakan login dari /admin';
})->name('login');


// ===================================================================
// KUMPULAN RUTE UNTUK MAHASISWA
// ===================================================================

// --- Grup untuk yang BELUM LOGIN (Tamu) ---
Route::middleware('guest')->group(function () {
    Route::get('/mahasiswa/register', [MahasiswaController::class, 'showRegisterForm'])->name('mahasiswa.register');
    Route::post('/mahasiswa/register', [MahasiswaController::class, 'register'])->name('mahasiswa.register.submit');

    Route::get('/mahasiswa/login', [MahasiswaController::class, 'showLoginForm'])->name('mahasiswa.login');
    Route::post('/mahasiswa/login', [MahasiswaController::class, 'login'])->name('mahasiswa.login.submit');
});


// --- Grup untuk Mahasiswa yang SUDAH LOGIN ---
// Semua rute di dalam grup ini akan memiliki URL diawali dengan /mahasiswa/...
// dan dijaga oleh middleware 'auth' yang sama.
Route::prefix('mahasiswa')->name('mahasiswa.')->middleware('auth')->group(function () {
    
    // Dashboard ( /mahasiswa/dashboard )
    Route::get('/dashboard', function () {
        // Cek role untuk keamanan tambahan
        if (Auth::user()->role !== 'mahasiswa') {
            abort(403, 'Akses Ditolak.');
        }
        return view('mahasiswa.dashboard', ['mahasiswa' => Auth::user()]);
    })->name('dashboard');

    // Profil ( /mahasiswa/profil, /mahasiswa/profil/edit, dst. )
    Route::get('/profil', [MahasiswaController::class, 'profil'])->name('profil');
    Route::get('/profil/edit', [MahasiswaController::class, 'editProfil'])->name('profil.edit');
    Route::post('/profil/edit', [MahasiswaController::class, 'updateProfil'])->name('profil.update');

    // Proposal ( /mahasiswa/pengajuan, dst. )
    Route::get('/pengajuan', [MahasiswaController::class, 'listProposal'])->name('proposal.list');
    Route::get('/pengajuan/buat', [MahasiswaController::class, 'createProposal'])->name('proposal.create');
    Route::post('/pengajuan/buat', [MahasiswaController::class, 'storeProposal'])->name('proposal.store');
    
    // Pengajuan Sekolah ( /mahasiswa/sekolah/buat, dst. )
    Route::get('/sekolah/buat', [MahasiswaController::class, 'createSchool'])->name('school.create');
    Route::post('/sekolah/buat', [MahasiswaController::class, 'storeSchool'])->name('school.store');

    Route::get('/proposal/{proposal}/report/create', [MahasiswaController::class, 'createReport'])->name('mahasiswa.report.create');
Route::post('/proposal/{proposal}/report', [MahasiswaController::class, 'storeReport'])->name('mahasiswa.report.store');
    
    // Logout
    Route::post('/logout', [MahasiswaController::class, 'logout'])->name('logout');
});