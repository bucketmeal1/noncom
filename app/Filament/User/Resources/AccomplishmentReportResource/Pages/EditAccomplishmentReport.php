<?php

namespace App\Filament\User\Resources\AccomplishmentReportResource\Pages;

use App\Filament\User\Resources\AccomplishmentReportResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAccomplishmentReport extends EditRecord
{
    protected static string $resource = AccomplishmentReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
