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
        'prodi',
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
<<<<<<< HEAD
    
=======
    public function canAccessPanel(Panel $panel): bool
    {
        // Jika user mencoba mengakses panel 'admin'
        if ($panel->getId() === 'admin') {
            // Izinkan jika rolenya adalah Admin, Pembina, atau Staff
            return $this->hasAnyRole(['Admin', 'Pembina', 'Staff']);
        }

        // Jika user mencoba mengakses panel 'student'
        if ($panel->getId() === 'student') {
            // Izinkan jika rolenya adalah Admin atau Student
            return $this->hasAnyRole(['Admin', 'Student']);
        }

        // Jika ada panel lain, tolak secara default
        return false;
    }
>>>>>>> 75f03d02081b0e60cd3f0d9a73fdcfbc57311c19

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

    // SEMUA KODE LAMA TERKAIT PERAN (ROLE) SEPERTI:
    // - public const ROLE_...
    // - public function hasRole(...)
    // - protected function isAdmin()
    // - protected function isMahasiswa()
    // TELAH DIHAPUS KARENA SUDAH DITANGANI OLEH TRAIT 'HasRoles'.
}
