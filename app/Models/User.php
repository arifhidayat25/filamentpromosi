<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles; // Menggunakan trait dari Spatie
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // <-- Tambahkan ini di atas

use App\Models\BankAccount;
use Filament\Panel;
use Illuminate\Database\Eloquent\Relations\HasOne;



class User extends Authenticatable
{
    /**
     * Menggunakan semua trait yang diperlukan, termasuk HasRoles dari Spatie.
     */
    use HasApiTokens, HasFactory, Notifiable, HasRoles, LogsActivity ;

    /**
     * The attributes that are mass assignable.
     * Kolom 'role' sudah tidak diperlukan lagi di sini karena peran disimpan di tabel lain.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'nim',
        'program_studi_id',
        'no_telepon',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed', // Pastikan password di-hash
    ];
    
    
    /**
     * Relasi ke tabel proposals. Ini tidak berhubungan dengan peran dan bisa tetap ada.
     */
    public function proposals(): HasMany
    {
        return $this->hasMany(Proposal::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logAll();
    }

    public function programStudi(): BelongsTo
    {
        return $this->belongsTo(ProgramStudi::class, 'program_studi_id');
    }

    public function canAccessPanel(Panel $panel): bool
    {
        if ($panel->getId() === 'admin') {
            return $this->hasRole(['admin', 'pembina', 'staff']);
        }

        if ($panel->getId() === 'student') {
            return $this->hasRole('mahasiswa');
        }

        return true;
    }
}
