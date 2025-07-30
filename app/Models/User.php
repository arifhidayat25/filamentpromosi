<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
    'name',
    'email',
    'password',
    'nim', // <-- Tambahkan
    'prodi', // <-- Tambahkan
    'no_telepon', // <-- Tambahkan
    'role',
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
    ];

    /**
     * Role constants
     */
    public const ROLE_MAHASISWA = 'mahasiswa';
    public const ROLE_PEMBINA = 'pembina';
    public const ROLE_STAFF = 'staff';
    public const ROLE_ADMIN = 'admin';

    /**
     * Get available roles
     */
    public static function roles(): array
    {
        return [
            self::ROLE_MAHASISWA,
            self::ROLE_PEMBINA,
            self::ROLE_STAFF,
            self::ROLE_ADMIN,
        ];
    }
    
    /**
     * Check if user has a specific role
     *
     * @param string $role
     * @return bool
     */
    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }
    /**
     * Relasi ke tabel proposals.
     */
    public function proposals(): HasMany
    {
        return $this->hasMany(Proposal::class);
    }

    /**
     * Accessor untuk memeriksa apakah user adalah admin.
     */
    protected function isAdmin(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->role === 'admin',
        );
    }

    /**
     * Accessor untuk memeriksa apakah user adalah mahasiswa.
     */
    protected function isMahasiswa(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->role === 'mahasiswa',
        );
    }

}
