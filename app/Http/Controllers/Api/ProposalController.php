<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Models\Proposal;
use App\Models\School;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

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

            // --- PERBAIKAN DI SINI ---
            // Kirim respons sukses dengan kode status 201 (Created)
            return ResponseFormatter::success($proposal, 'Proposal berhasil dibuat', 201);

        } catch (ValidationException $e) {
            return ResponseFormatter::error($e->errors(), 'Validasi gagal', 422);
        } catch (\Exception $e) {
            return ResponseFormatter::error(null, 'Terjadi kesalahan pada server: ' . $e->getMessage(), 500);
        }
    }
}
