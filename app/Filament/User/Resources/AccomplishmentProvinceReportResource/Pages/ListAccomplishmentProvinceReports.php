<?php

namespace App\Filament\User\Resources\AccomplishmentProvinceReportResource\Pages;

use App\Filament\User\Resources\AccomplishmentProvinceReportResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Redirect;


class ListAccomplishmentProvinceReports extends ListRecords
{
    protected static string $resource = AccomplishmentProvinceReportResource::class;
    protected static string $view = 'filament.reports.accomplishmentprovince_report';


    public $selectedYear = '';

    
    public function mount(): void
    {
        // Initialize $selectedYear with current year or request()->year if available
        $this->selectedYear = request()->year ?? date('Y');
    }

    public function updateSelectorYear()
    {
        // Update $selectedYear with the selected year from the request
       // $this->selectedYear = request()->year ?? date('Y');

        // Redirect to the same page with the updated year parameter
        return Redirect::route('filament.user.resources.accomplishment-province-reports.index', ['year' => $this->selectedYear]);
    }


    protected function getHeaderActions(): array
    {
        return [
            //Actions\CreateAction::make(),
        ];
    }
}
