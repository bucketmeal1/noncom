<?php

namespace App\Filament\User\Resources\ConsultationResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Forms\Components\Radio;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class NcdRiskFactorRelationManager extends RelationManager
{
    protected static string $relationship = 'ncdRiskFactor';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Radio::make('smoking')
                            ->inline()
                            ->options([
                                'Yes' => 'Yes',
                                'No' => 'No',
                            ]),
                        Radio::make('excessive_alcohol')
                            ->inline()
                            ->options([
                                'Yes' => 'Yes',
                                'No' => 'No',
                            ]),
                        Radio::make('highfat')
                            ->inline()
                            ->options([
                                'Yes' => 'Yes',
                                'No' => 'No',
                            ]),
                        Radio::make('highsalt')
                            ->inline()
                            ->options([
                                'Yes' => 'Yes',
                                'No' => 'No',
                            ]),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('smoking')
            ->columns([
                Tables\Columns\TextColumn::make('smoking'),
                Tables\Columns\TextColumn::make('excessive_alcohol'),
                Tables\Columns\TextColumn::make('highsalt'),
                Tables\Columns\TextColumn::make('highfat')
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }
}
