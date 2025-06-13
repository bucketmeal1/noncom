<?php

namespace App\Filament\Admin\Resources\PersonnelResource\Pages;

use App\Filament\Admin\Resources\PersonnelResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;

class CreatePersonnel extends CreateRecord
{
    protected static string $resource = PersonnelResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Personnel registered')
            ->body('The new personnel has been created successfully.');
    }
}
