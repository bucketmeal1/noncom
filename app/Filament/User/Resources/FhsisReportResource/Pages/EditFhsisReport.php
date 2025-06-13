<?php

namespace App\Filament\User\Resources\FhsisReportResource\Pages;

use App\Filament\User\Resources\FhsisReportResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFhsisReport extends EditRecord
{
    protected static string $resource = FhsisReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
