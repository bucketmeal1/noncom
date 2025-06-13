<?php

namespace App\Filament\Admin\Resources\UserResource\Pages;

use App\Filament\Admin\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;
use App\Models\User;


class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    // protected function mutateFormDataBeforeCreate(array $data): array
    // {
    //     return $data;
    // }
    protected function afterCreate(): void
    {
        // $savedRecordId = $this->record->id;
        // $update = User::find($savedRecordId);
        // $update->unit_id = $this->data['unit_id'];
        // $update->save();
    }
   
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('User registered')
            ->body('The user has been created successfully.');
    }
}
