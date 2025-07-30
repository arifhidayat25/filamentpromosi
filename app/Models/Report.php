<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Report extends Model
{
    use HasFactory;
    protected $fillable = ['proposal_id', 'event_date', 'attendees_count', 'qualitative_notes', 'documentation_path'];

    public function proposal(): BelongsTo
    {
        return $this->belongsTo(Proposal::class);
    }

    public function interestedStudents(): HasMany
    {
        return $this->hasMany(InterestedStudent::class);
    }
}
