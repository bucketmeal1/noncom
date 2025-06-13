<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Municipality extends Model
{
    use HasFactory;
    public function provinces(): BelongsTo
    {
        return $this->belongsTo(Province::class,'provcode','provcode');
    
    }

    public function patient(): HasMany
    {
        return $this->hasMany(Patient::class);
    }

    
    public function barangay(): HasMany
    {
        return $this->hasMany(Barangay::class);
    }

}
