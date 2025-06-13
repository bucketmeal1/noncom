<?php

namespace App\Filament\User\Resources\TclReportResource\Pages;

use App\Filament\User\Resources\TclReportResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTclReport extends EditRecord
{
    protected static string $resource = TclReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
