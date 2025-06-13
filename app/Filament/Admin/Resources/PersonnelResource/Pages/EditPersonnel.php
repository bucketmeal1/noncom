<?php

namespace App\Filament\Admin\Resources\PersonnelResource\Pages;

use App\Filament\Admin\Resources\PersonnelResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;


class EditPersonnel extends EditRecord
{
    protected static string $resource = PersonnelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()->successNotification(
                Notification::make()
                     ->success()
                     ->title('Personnel deleted')
                     ->body('The personnel has been deleted successfully.'),
             )
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
    

    protected function getSavedNotification(): ?Notification
    {
        
        return Notification::make()
            ->success()
            ->title('Personnel updated')
            ->body('The personnel has been updated successfully.');
    }
}
