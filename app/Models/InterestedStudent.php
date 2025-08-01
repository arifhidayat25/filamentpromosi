<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class InterestedStudent extends Model
{
    use HasFactory, LogsActivity;
    protected $table = 'interested_students';
    protected $fillable = ['report_id', 'student_name', 'phone_number', 'class'];

    public function report(): BelongsTo
    {
        return $this->belongsTo(Report::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logAll();
    }
}
