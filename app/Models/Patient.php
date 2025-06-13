<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Patient extends Model
{
    use HasFactory;
    
    protected $fillable =['user_id',
        'firstname','lastname','middlename','gender', 'birthdate','civil_status','contact','pwd_id','regcode','provcode','citycode','bgycode','house_number',

    ];

    public function consultations(): HasMany
    {
        return $this->hasMany(Consultation::class, 'patient_id', 'id');
    }
    public function provinces(): BelongsTo {
        return $this->belongsTo(Province::class, 'regcode', 'regcode' );
    }
    
    public function barangay()
    {
        return $this->belongsTo(Barangay::class, 'citycode','citycode');
    }
    
    
    public function regions(): BelongsTo{
        return $this->belongsTo(Region::class,'regcode','regcode');
    }
    
    public function municipalities(): BelongsTo{
        return $this->belongsTo(Municipality::class, 'provcode','provcode');
    }

    public function getFullNameAttribute()
{
    return $this->lastname . ', ' . $this->firstname . ' ' . $this->middlename;
}
//     // getattribute table id change to attribute you want to view in your table
// public function getRegionNameAttribute(){
//     return Region::where('regcode',$this->regcode)->first()->regname;
//     //Regions::find($this->province);
// }
// public function getProvinceNameAttribute(){
//     return Province::where('provcode',$this->provcode)->first()->provname;
//    // return 'bsta name dito query kbfg';//Regions::find($this->province); palit mo nlnf
// }

// public function getMunicipalityNameAttribute(){
//     return Municipality::where('citycode',$this->citycode)->first()->cityname;
//    // return 'bsta name dito query kbfg';//Regions::find($this->province);
// }

// public function getBarangayNameAttribute(){
//     return Municipality::where('bgycode',$this->bgycode)->first()->bgyname;
//    // return 'bsta name dito query kbfg';//Regions::find($this->province);
// }
// // // // public function getP
}



