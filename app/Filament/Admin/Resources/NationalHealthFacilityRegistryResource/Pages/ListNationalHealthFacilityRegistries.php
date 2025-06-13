<?php

namespace App\Filament\Admin\Resources\NationalHealthFacilityRegistryResource\Pages;

use App\Filament\Admin\Resources\NationalHealthFacilityRegistryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Konnco\FilamentImport\Actions\ImportField;
use Konnco\FilamentImport\Actions\ImportAction;
use Filament\Actions\ActionGroup;

use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use pxlrbt\FilamentExcel\Columns\Column;
use App\Exports\NHFRExport;
use Maatwebsite\Excel\Facades\Excel;
use Filament\Notifications\Notification;

class ListNationalHealthFacilityRegistries extends ListRecords
{
    protected static string $resource = NationalHealthFacilityRegistryResource::class;

    protected function getHeaderActions(): array
    {

        ini_set('max_execution_time', 3600);


        return [
            
           

                Actions\CreateAction::make()
                ->label('Add New')
                ->icon('heroicon-o-plus')
                ->color('success'),
                ImportAction::make() 
                ->label('Import')
                ->color('info')
                ->icon('heroicon-o-arrow-up')
                ->uniqueField('health_facility_code')
                ->fields([
                    ImportField::make('health_facility_code')->required(),
                    ImportField::make('health_facility_code_short')->required(),
                    ImportField::make('facility_name')->required(),
                    ImportField::make('facility_major_type')->required(),
                    ImportField::make('health_facility_type')->required(),
                    ImportField::make('ownership_major_classification')->required(),
                    ImportField::make('ownership_sub_classification_for_government_facilities')->required(),
                    ImportField::make('ownership_sub_classification_for_private_facilities')->required(),
                    ImportField::make('street_name_and_number')->required(),
                    ImportField::make('building_name_and_number')->required(),
                    ImportField::make('region_name')->required(),
                    ImportField::make('region_psgc')->required(),
                    ImportField::make('province_name')->required(),
                    ImportField::make('province_psgc')->required(),
                    ImportField::make('municipality_name')->required(),
                    ImportField::make('municipality_psgc')->required(),
                    ImportField::make('barangay_name')->required(),
                    ImportField::make('barangay_psgc')->required(),
                    ImportField::make('zip_code')->required(),
                    ImportField::make('landline_number')->required(),
                    ImportField::make('landline_number2')->required(),
                    ImportField::make('fax_number')->required(),
                    ImportField::make('email_address')->required(),
                    ImportField::make('alternate_email_address')->required(),
                    ImportField::make('official_website')->required(),
                    ImportField::make('service_capability')->required(),
                    ImportField::make('bed_capacity')->required(),
                    ImportField::make('licensing_status')->required(),
                    ImportField::make('license_validity_date')->required(),
                ]), 

                Actions\Action::make('exportNHFR')
                ->label('Export')
                ->color('warning')
                ->icon('heroicon-o-arrow-down')
                ->action(function (array $data) {
    
                    $datetime = now()->format('YmdHis');
                    $filename = 'NHFR_' . $datetime . '.xlsx';
    
                    return Excel::download(new NHFRExport, $filename);
                }),
            



          

        ];
    }
}
