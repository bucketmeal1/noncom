<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PastMedicalHistory extends Model
{
    use HasFactory;
    protected $table = "past_medical_histories";

    protected $fillable = [
        'consultation_id', 'past_medical_history_code', 'past_medical_history_desc'
    ];
}
