<?php

namespace App\Filament\User\Resources\PatientResource\Pages;

use App\Filament\User\Resources\PatientResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePatient extends CreateRecord
{
    protected static string $resource = PatientResource::class;


    protected function getRedirectUrl(): string
    {
        return env('APP_URL').$this->getResource()::getUrl('index', isAbsolute: false);
    }


    protected function mutateFormDataBeforeCreate(array $data): array
    {

        $data['user_id'] = auth()->id();

        return $data;
    }
}
