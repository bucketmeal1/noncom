<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientMedicalHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'consultation_id', 'patient_medical_history', 
    ];



    protected $casts = [
        'patient_medical_history' => 'array',
    ];


   
}
