<?php

namespace App\Filament\User\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use App\Models\FhsisReport;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget as BaseWidget;
use App\Filament\User\Resources\FhsisReportResource;

class FHSIS extends BaseWidget
{
    protected static ?int $sort = 2;
    protected int | string | array $columnSpan = "full"; 
    public function table(Table $table): Table
    {
        return $table
            ->query(
                FhsisReportResource::getEloquentQuery()
            )
            ->columns([
                TextColumn::make('count'),
                TextColumn::make('result'),
            ]);
    }
}
