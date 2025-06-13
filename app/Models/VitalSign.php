<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VitalSign extends Model
{
    use HasFactory;

    protected $fillable =[
        'consultation_date', 'systolic','diastolic','body_temperature','pulse_rate','repiratory_rate','blood_oxygen'
    ];

  

   
}
