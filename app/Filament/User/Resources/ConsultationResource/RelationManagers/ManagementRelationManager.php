<?php

namespace App\Filament\User\Resources\ConsultationResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class ManagementRelationManager extends RelationManager
{
    protected static string $relationship = 'management';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('management')
                ->label('management')
               
                ->options([
                'Anti hypertensives' => 'Anti hypertensives',
                'Oral hypoglycemic' => 'Oral hypoglycemic'
                
                ]) 
            ]);
          
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('management')
            ->columns([
                Tables\Columns\TextColumn::make('management'),
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
            ]);
    }
}
