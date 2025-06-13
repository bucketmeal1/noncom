<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiskScreening extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'consultation_id','fbs_result','fbs_date','rbs_result','rbs_date','polyphagia','polydipsia','polyuria','total_cholesterol','total_cholesterol_date','hdl','hdl_date',
        'ldl','ldl_date','vldl','vldl_date','triglyceride','triglyceride_date','protein','protein_date','ketones','ketones_date','breathlessness','chronic_cough','sputum',
        'chest_tightness','wheezing'
    ];

}