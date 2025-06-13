<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\NationalHealthFacilityRegistry;

class NHFRExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
   
    public function headings():array{
        return [
            'Health Facility Code',
            'Health Facility Code Short',
            'Facility Name',
            'Facility Major Type',
            'Health Facility Type',
            'Ownership Major Classification',
            'Ownership Sub-Classification for Government facilities',
            'Ownership Sub-Classification for private facilities',
            'Street Name and #',
            'Building name and #',
            'Building name and #',
            'Rgion PSGC',
            'Province Name',
            'Province PSGC',
            'Municipality Name',
            'Municipality PSGC',
            'Barangay Name',
            'Barangay PSGC',
            'Zip Code',
            'Landline Number',
            'Landline Number 2',
            'Fax Number',
            'Email Address',
            'Alternate Email Address',
            'Official Website',
            'Service Capability',
            'Bed Capacity',
            'Licensing Status',
            'License Validity Date',
        ];
    }
    public function collection()
    {   
     
        return NationalHealthFacilityRegistry::select(
            'health_facility_code',
            'health_facility_code_short',
            'facility_name',
            'facility_major_type',
            'health_facility_type',
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
        )->get();
    }
}
