<?php

namespace App\Filament\Admin\Resources\NationalHealthFacilityRegistryResource\Pages;

use App\Filament\Admin\Resources\NationalHealthFacilityRegistryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Models\PhilippineRegions;
use App\Models\PhilippineProvinces;
use App\Models\PhilippineCities;
use App\Models\PhilippineBarangays;

class CreateNationalHealthFacilityRegistry extends CreateRecord
{
    protected static string $resource = NationalHealthFacilityRegistryResource::class;


    protected function mutateFormDataBeforeCreate(array $data): array
    {

         
        $region = PhilippineRegions::where('psgc_code',$data['region_psgc'])->first();
        $data['region_name'] = $region->region_description;

        $province = PhilippineProvinces::where('province_psgc',$data['province_psgc'])->first();
        $data['province_name'] =  $province->province_description;

        $municipality = PhilippineCities::where('municipality_psgc',$data['municipality_psgc'])->first();
        $data['municipality_name'] = $municipality->city_municipality_description;

        $barangay = PhilippineBarangays::where('barangay_psgc',$data['barangay_psgc'])->first();
        $data['barangay_name'] = $barangay->barangay_description;
    
       
        return $data;
    }
}
