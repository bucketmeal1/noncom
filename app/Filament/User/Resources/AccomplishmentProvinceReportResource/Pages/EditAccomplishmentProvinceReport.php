<?php

namespace App\Filament\User\Resources\AccomplishmentProvinceReportResource\Pages;

use App\Filament\User\Resources\AccomplishmentProvinceReportResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAccomplishmentProvinceReport extends EditRecord
{
    protected static string $resource = AccomplishmentProvinceReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
