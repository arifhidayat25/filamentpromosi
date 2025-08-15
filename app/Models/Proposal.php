<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache; // <-- Diimpor untuk manajemen cache

class Proposal extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'school_id',
        'status',
        'proposed_date',
        'notes',
        'rejection_reason',
        'dosen_pembina_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'proposed_date' => 'date',
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted(): void
    {
        // Logika ini akan berjalan setiap kali record BARU akan dibuat
        static::creating(function (Proposal $proposal) {
            if (Auth::check()) {
                // Otomatis set user_id dan status awal
                $proposal->user_id = Auth::id();
                $proposal->status = 'diajukan';

                // Otomatis set dosen pembina berdasarkan prodi mahasiswa
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

        // --- MANAJEMEN CACHE OTOMATIS ---
        // Logika ini berjalan SETELAH record berhasil dibuat atau di-update.
        static::saved(function (Proposal $proposal) {
            $cacheKeyPrefix = 'stats:pengajuan:' . $proposal->user_id;
            
            // Hapus semua cache terkait statistik pengajuan untuk user ini
            Cache::forget($cacheKeyPrefix . ':total');
            Cache::forget($cacheKeyPrefix . ':disetujui');
            Cache::forget($cacheKeyPrefix . ':ditolak');
        });

        // Logika ini berjalan SETELAH record berhasil dihapus.
        static::deleted(function (Proposal $proposal) {
            $cacheKeyPrefix = 'stats:pengajuan:' . $proposal->user_id;

            // Hapus semua cache terkait statistik pengajuan untuk user ini
            Cache::forget($cacheKeyPrefix . ':total');
            Cache::forget($cacheKeyPrefix . ':disetujui');
            Cache::forget($cacheKeyPrefix . ':ditolak');
        });
        // --- AKHIR DARI MANAJEMEN CACHE ---
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

    public function certificate(): HasOne
    {
        return $this->hasOne(Certificate::class);
    }
}