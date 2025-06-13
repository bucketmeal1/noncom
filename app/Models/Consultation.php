<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    use HasFactory;

    protected $fillable =[
        'patient_id','nature_visit', 'consultation_type','consultation_date','patient_height','patient_weight', 'bmi', 'class','classification'
    ];

    public function vitalsigns(){
        return $this->hasMany(VitalSign::class,'consultation_id','id');
        
    }

    public function patient_family_histories()
    {
        return $this->hasMany(PatientFamilyHistory::class, 'consultation_id','id');
    }

    public function patient_medical_histories()
    {
        return $this->hasMany(PatientMedicalHistory::class, 'consultation_id', 'id');
    }

    public function ncdRiskFactor()
    {
        return $this->hasMany(NCDRiskFactor::class, 'consultation_id', 'id');
    }

    public function riskscreening()
    {
        return $this->hasMany(RiskScreening::class, 'consultation_id', 'id');
    }

    public function cervicalcancer()
    {
        return $this->hasMany(CervicalCancer::class, 'consultation_id', 'id');
    }

    

    public function management()
    {
    return $this->hasMany(Management::class, 'consultation_id', 'id');
    }

    public function diagnosis()
    {
        return $this->hasMany(Diagnosis::class, 'consultation_id', 'id');
    
    }
    
    public function patients()
    {
        return $this->hasMany(Patient::class);
    }

    
    

}
