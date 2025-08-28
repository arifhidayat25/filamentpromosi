<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Models\Proposal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException; // <-- Import ValidationException

class ProposalController extends Controller
{
    public function store(Request $request)
    {
        try {
            $request->validate([
                'school_id' => 'required|exists:schools,id',
                'proposed_date' => 'required|date',
                'notes' => 'nullable|string',
            ]);

            $proposal = Proposal::create([
                'user_id' => Auth::id(),
                'school_id' => $request->school_id,
                'proposed_date' => $request->proposed_date,
                'notes' => $request->notes,
            ]);

            return ResponseFormatter::success($proposal, 'Proposal berhasil dibuat', 201);

        } catch (ValidationException $e) {
            // --- PERBAIKAN DI SINI ---
            // Tangkap error validasi secara spesifik dan format dengan benar.
            return ResponseFormatter::error($e->errors(), 'Validasi gagal', 422);
        } catch (\Exception $e) {
            // Tangkap semua error server lainnya.
            return ResponseFormatter::error(null, 'Terjadi kesalahan pada server: ' . $e->getMessage(), 500);
        }
    }

    // file: app/Http/Controllers/Api/ProposalController.php
public function indexForPembina(Request $request)
{
    $pembina = $request->user();

    if (!$pembina->hasRole('pembina')) {
        return ResponseFormatter::error(null, 'Akses ditolak', 403);
    }

    $proposals = Proposal::whereHas('user', function ($query) use ($pembina) {
        $query->where('program_studi_id', $pembina->program_studi_id);
    })->with('user', 'school')->latest()->get();

    return ResponseFormatter::success($proposals, 'Data proposal berhasil diambil');
}
}
