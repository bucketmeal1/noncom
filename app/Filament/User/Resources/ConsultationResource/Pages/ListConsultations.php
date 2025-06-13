<?php

namespace App\Filament\User\Resources\ConsultationResource\Pages;

use App\Filament\User\Resources\ConsultationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListConsultations extends ListRecords
{
    protected static string $resource = ConsultationResource::class;

    // protected function getHeaderActions(): array
    // {
    //     // return [
    //     //     Actions\CreateAction::make(),
    //     // ];
    // }
}
