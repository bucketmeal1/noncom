<?php

namespace App\Filament\User\Resources\FhsisReportResource\Pages;

use App\Filament\User\Resources\FhsisReportResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFhsisReports extends ListRecords
{
    protected static string $resource = FhsisReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
