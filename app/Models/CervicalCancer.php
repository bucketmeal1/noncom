<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CervicalCancer extends Model
{
    use HasFactory;

    protected $fillable = [
        'consultation_date','risk_assessment','given_counseling','result','type_screening','treatment_management','return_schedule','remarks'
    ];

}
