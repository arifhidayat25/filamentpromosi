<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Auth;

class Proposal extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'school_id',
        'status',
        'proposed_date',
        'notes',
        'rejection_reason',
        'dosen_pembina_id', // Pastikan kolom ini ada di $fillable
    ];

    protected $casts = [
        'proposed_date' => 'date',
    ];

    /**
     * Logika ini berjalan setiap kali ada data Proposal BARU yang akan disimpan.
     */
    protected static function booted(): void
    {
        static::creating(function (Proposal $proposal) {
            if (Auth::check()) {
                // 1. Setel user_id (mahasiswa) dan status awal
                $proposal->user_id = Auth::id();
                $proposal->status = 'diajukan';

                // 2. LOGIKA BARU: Cari dan setel Dosen Pembina secara otomatis
                $mahasiswa = Auth::user();
                if ($mahasiswa->program_studi_id) {
                    // Cari satu user yang perannya 'pembina' DAN prodinya sama dengan mahasiswa
                    $pembina = User::where('program_studi_id', $mahasiswa->program_studi_id)
                                   ->whereHas('roles', fn($q) => $q->where('name', 'pembina'))
                                   ->first();
                    
                    if ($pembina) {
                        $proposal->dosen_pembina_id = $pembina->id;
                    }
                }
            }
        });
    }

    // --- Definisi Relasi ---
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function certificate(): HasOne
{
    return $this->hasOne(Certificate::class);
}

    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }

    public function report(): HasOne
    {
        return $this->hasOne(Report::class);
    }
    
    public function dosenPembina(): BelongsTo
    {
        return $this->belongsTo(User::class, 'dosen_pembina_id');
    }
}