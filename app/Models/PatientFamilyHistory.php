<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientFamilyHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'consultation_id','patient_history'
    ]; 

    protected $casts = [
        'patient_history' => 'array',
    ];

   
}
