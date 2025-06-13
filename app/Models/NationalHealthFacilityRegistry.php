<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class NationalHealthFacilityRegistry extends Model
{
    use HasFactory,LogsActivity;

    protected $fillable = [
        'health_facility_code',
        'health_facility_code_short',
        'facility_name',
        // 'old_facility_name_1',
        // 'old_facility_name_2',
        // 'old_facility_name_3',
        'facility_major_type',
        'health_facility_type',
        // 'category',
        'ownership_major_classification',
        'ownership_sub_classification_for_government_facilities',
        'ownership_sub_classification_for_private_facilities',
        'street_name_and_number',
        'building_name_and_number',
        'region_name',
        'region_psgc',
        'province_name',
        'province_psgc',
        'municipality_name',
        'municipality_psgc',
        'barangay_name',
        'barangay_psgc',
        'zip_code',
        'landline_number',
        'landline_number2',
        'fax_number',
        'email_address',
        'alternate_email_address',
        'official_website',
        'service_capability',
        'bed_capacity',
        'licensing_status',
        'license_validity_date',
    ];
    public static function healthfacilitytypeOptions()
    {
        return self::select('health_facility_type')
            ->groupBy('health_facility_type') // Group by both columns
            ->pluck('health_facility_type')
            ->all();
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly([
            'health_facility_code',
            'health_facility_code_short',
            'facility_name',
            // 'old_facility_name_1',
            // 'old_facility_name_2',
            // 'old_facility_name_3',
            'facility_major_type',
            'health_facility_type',
            // 'category',
            'ownership_major_classification',
            'ownership_sub_classification_for_government_facilities',
            'ownership_sub_classification_for_private_facilities',
            'street_name_and_number',
            'building_name_and_number',
            'region_name',
            'region_psgc',
            'province_name',
            'province_psgc',
            'municipality_name',
            'municipality_psgc',
            'barangay_name',
            'barangay_psgc',
            'zip_code',
            'landline_number',
            'landline_number2',
            'fax_number',
            'email_address',
            'alternate_email_address',
            'official_website',
            'service_capability',
            'bed_capacity',
            'licensing_status',
            'license_validity_date',
        ]);
      
    }

    
}