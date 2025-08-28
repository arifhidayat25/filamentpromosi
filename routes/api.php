<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProposalController; // <-- 1. Import controller baru

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/
// Rute API ini akan menggunakan middleware 'api' yang sudah didefinisikan di Kernel.php
Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:login');
// --- RUTE PUBLIK UNTUK AUTENTIKASI ---
//Route::post('/login', [AuthController::class, 'login']);

// --- RUTE YANG DILINDUNGI (MEMERLUKAN TOKEN) ---
// Token yang sama bisa mengakses SEMUA rute di bawah ini.
Route::middleware('auth:sanctum')->group(function () {
    
    // Endpoint untuk mengambil data user
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Endpoint untuk mengambil proposal milik user
    Route::get('/my-proposals', function (Request $request) {
        return $request->user()->proposals()->with('school')->latest()->get();
    });
    
    // --- ENDPOINT BARU 1: Mengambil Laporan ---
    // Aplikasi luar bisa mengakses GET /api/my-reports
    Route::get('/my-reports', function (Request $request) {
        // Kita ambil laporan melalui relasi proposal
        return $request->user()->proposals()->with('report')->get()->pluck('report')->filter();
    });

    // --- ENDPOINT BARU 2: Mengambil Pembayaran ---
    // Aplikasi luar bisa mengakses GET /api/my-payments
    Route::get('/my-payments', function (Request $request) {
        return $request->user()->proposals()->with('payment')->get()->pluck('payment')->filter();
    });
  // Endpoint untuk membuat proposal baru
     Route::post('/proposals', [ProposalController::class, 'store']);

     Route::get('/pembina/proposals', [\App\Http\Controllers\Api\ProposalController::class, 'indexForPembina']);

    // Endpoint untuk logout
    Route::post('/logout', [AuthController::class, 'logout']);
});