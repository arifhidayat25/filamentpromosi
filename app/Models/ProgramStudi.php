<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramStudi extends Model
{
    use HasFactory;

        protected $fillable = ['name', 'kode'];


    public function users()
{
    return $this->hasMany(User::class);
}
}