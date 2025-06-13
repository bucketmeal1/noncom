<?php

namespace App\Filament\Admin\Resources\NationalHealthFacilityRegistryResource\Pages;

use App\Filament\Admin\Resources\NationalHealthFacilityRegistryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use App\Models\PhilippineRegions;
use App\Models\PhilippineProvinces;
use App\Models\PhilippineCities;
use App\Models\PhilippineBarangays;
class EditNationalHealthFacilityRegistry extends EditRecord
{
    protected static string $resource = NationalHealthFacilityRegistryResource::class;

    protected function handleRecordUpdate(Model $record, array $data): Model
    {

        $region = PhilippineRegions::where('psgc_code',$data['region_psgc'])->first();
        $record['region_name'] = $region->region_description;

        $province = PhilippineProvinces::where('province_psgc',$data['province_psgc'])->first();
        $record['province_name'] =  $province->province_description;

        $municipality = PhilippineCities::where('municipality_psgc',$data['municipality_psgc'])->first();
        $record['municipality_name'] = $municipality->city_municipality_description;

        $barangay = PhilippineBarangays::where('barangay_psgc',$data['barangay_psgc'])->first();
        $record['barangay_name'] = $barangay->barangay_description;
        
        $record->update($data);
    
        return $record;
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
