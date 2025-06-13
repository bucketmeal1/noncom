<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class ActivityLog extends Model
{
    use HasFactory;

    protected $table = "activity_log";

    // Corrected method name to follow Laravel's accessor naming convention
    public function getCauserAttribute()
    {
        $user = User::find($this->causer_id);
        return $user ? $user->name : null;  // Adding a null check for robustness
    }
    public function getPropertiesAttribute()
    {
        $properties = json_decode($this->attributes['properties'], true);

        // Check for JSON decoding errors
        if (json_last_error() !== JSON_ERROR_NONE) {
            return null;  // Or handle the error as appropriate
        }

        return $properties;
    }

    // Method to get properties as a readable string for display purposes
    public function getPropertiesAsStringAttribute()
    {
        $properties = $this->getPropertiesAttribute();
        return $properties ? json_encode($properties, JSON_PRETTY_PRINT) : null;
    }
}
