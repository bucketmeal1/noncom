<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Region extends Model
{
    use HasFactory;

    public function patient(): HasMany
    {
        return $this->hasMany(Patient::class);
    }
    public function provinces(): HasMany
{
    return $this->hasMany(Province::class);   
}
}
