<?php

namespace App\Filament\User\Resources\PatientResource\Pages;

use App\Filament\User\Resources\PatientResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPatients extends ListRecords
{
    protected static string $resource = PatientResource::class;
    
    

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];

    }
}
