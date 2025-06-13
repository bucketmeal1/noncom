<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Reference\Attendant;
use App\Models\Reference\YesNo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Personnel extends Model
{
    use HasFactory,SoftDeletes,LogsActivity;

    protected $fillable = [
        'ref_attendant',
        'personnel_license_no',
        'personnel_ptr_no',
        's2Lic_number',
        'personnel_philhealth',
        'phic_accreditation_no',
        'personnel_TIN',
        'personnel_lname',
        'personnel_fname',
        'personnel_mname',
        'sex_code',
        'personnel_birthdate',
        'hired_code',
        'personnel_status_code',
        'personnel_active',
        'current_user_login',
    ];


    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logFillable();
      
    }
    public function position()
    {
    return $this->belongsTo(Attendant::class, 'ref_attendant','attendant_code');
    }

    public function yesno()
    {
    return $this->belongsTo(YesNo::class, 'personnel_active','yes_no_code');
    }

}
