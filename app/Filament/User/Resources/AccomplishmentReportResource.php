<?php

namespace App\Filament\User\Resources;

use App\Filament\User\Resources\AccomplishmentReportResource\Pages;
use App\Filament\User\Resources\AccomplishmentReportResource\RelationManagers;
use App\Models\AccomplishmentReport;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AccomplishmentReportResource extends Resource
{
    protected static ?string $model = AccomplishmentReport::class;
   protected static ?int $navigationSort = 2;
    protected static ?string $navigationLabel = "Region Report";
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = "Reports";

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
            'index' => Pages\ListAccomplishmentReports::route('/'),
            'create' => Pages\CreateAccomplishmentReport::route('/create'),
            'edit' => Pages\EditAccomplishmentReport::route('/{record}/edit'),
        ];
    }
}
