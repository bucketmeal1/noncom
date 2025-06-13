<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Province extends Model
{
    use HasFactory;
    public function regions(): BelongsTo
    {
        return $this->belongsTo(Region::class, 'regcode', 'regcode');
    }

    public function patient(): HasMany
    {
        return $this->hasMany(Patient::class);
    }

    public function municipalities(): HasMany
    {
        return $this->hasMany(Municipality::class, 'provcode','provcode');
    }
}
