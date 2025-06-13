<?php

namespace App\Filament\User\Resources;

use App\Filament\User\Resources\FhsisReportResource\Pages;
use App\Filament\User\Resources\FhsisReportResource\RelationManagers;
use App\Models\FhsisReport;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FhsisReportResource extends Resource
{
    protected static ?string $model = FhsisReport::class;
    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFhsisReports::route('/'),
            'create' => Pages\CreateFhsisReport::route('/create'),
            'edit' => Pages\EditFhsisReport::route('/{record}/edit'),
        ];
    }
}
