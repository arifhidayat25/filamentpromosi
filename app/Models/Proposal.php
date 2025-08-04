<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne; // <-- Tambahkan ini
use Illuminate\Support\Facades\Auth;

class Proposal extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'school_id',
        'status',
        'proposed_date',
        'deskripsi',
        'rejection_reason',
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
            }
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }

    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class);
    }

    /**
     * PERBAIKAN: Mendefinisikan relasi "hasOne" ke model Report.
     * Sebuah proposal hanya memiliki satu laporan.
     */
    public function report(): HasOne
    {
        return $this->hasOne(Report::class);
    }
}