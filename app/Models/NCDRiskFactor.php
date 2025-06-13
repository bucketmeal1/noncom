<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NCDRiskFactor extends Model
{
    use HasFactory;
    
    protected $table = "ncd_risk_factors";
    
    protected $fillable = [
        'smoking','excessive_alcohol','highfat','highsalt'
    ];

}
