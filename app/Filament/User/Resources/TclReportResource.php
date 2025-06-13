<?php

namespace App\Filament\User\Resources;

use App\Filament\User\Resources\TclReportResource\Pages;
use App\Filament\User\Resources\TclReportResource\RelationManagers;
use App\Models\TclReport;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TclReportResource extends Resource
{
    protected static ?string $model = TclReport::class;
    protected static ?string $navigationGroup = "Reports";
    protected static ?string $navigationLabel = "TCL-Report";
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
            'index' => Pages\ListTclReports::route('/'),
            'create' => Pages\CreateTclReport::route('/create'),
            'edit' => Pages\EditTclReport::route('/{record}/edit'),
        ];
    }
}
