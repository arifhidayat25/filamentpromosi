<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Proposal extends Model
{
    use HasFactory, LogsActivity;

    /**
     * The attributes that are mass assignable.
     * Pastikan semua field dari form dan yang diisi otomatis ada di sini.
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'school_id',
        'status', // Penting untuk diisi otomatis
        'proposed_date',
        'notes',
        'rejection_reason',
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
     * Relasi ke User (pembuat proposal)
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke School (sekolah tujuan)
     */
    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }

    /**
     * Relasi ke Report
     */
    public function report(): HasOne
    {
        return $this->hasOne(Report::class);
    }

    /**
     * Relasi ke Payment
     */
    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class);
    }

    /**
     * Accessor untuk label kustom pada Select field di ReportResource.
     * @return string
     */
    public function getCustomLabelAttribute(): string
    {
        $schoolName = $this->school->name ?? 'Nama Sekolah Tidak Ditemukan';
        $date = $this->proposed_date ? $this->proposed_date : 'Tanggal Belum Diatur';
        return "{$schoolName} - {$date}";
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logAll();
    }
}