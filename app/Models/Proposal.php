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
        'dosen_pembina_id',
    ];

    protected $casts = [
        'proposed_date' => 'date',
    ];

    protected static function booted(): void
    {
        static::creating(function (Proposal $proposal) {
            if (Auth::check()) {
                $proposal->user_id = Auth::id();
                $proposal->status = 'diajukan';

                $mahasiswa = Auth::user();
                if ($mahasiswa->program_studi_id) {
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

    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class);
    }

    /**
     * INI ADALAH METODE YANG HILANG:
     * Mendefinisikan bahwa sebuah Proposal memiliki satu data Certificate.
     */
    public function certificate(): HasOne
    {
        return $this->hasOne(Certificate::class);
    }
}