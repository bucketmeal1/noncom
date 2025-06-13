<?php

namespace App\Filament\User\Resources\ConsultationResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\DateTimePicker;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VitalsignsRelationManager extends RelationManager
{
    protected static string $relationship = 'vitalsigns';
    protected static ?string $title = 'Vital Sign';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
               
                DateTimePicker::make('consultation_date')->required(),
                Forms\Components\TextInput::make('pulse_rate')->required(),
                Forms\Components\TextInput::make('systolic')->required(),
                Forms\Components\TextInput::make('body_temperature')->numeric(),
                Forms\Components\TextInput::make('diastolic')->numeric(),
                Forms\Components\TextInput::make('repiratory_rate')->numeric(),
                Forms\Components\TextInput::make('blood_oxygen')->numeric(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('consultation_date')
            ->columns([
            
                Tables\Columns\TextColumn::make('consultation_date')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('diastolic')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('systolic')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('body_temperature')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('pulse_rate')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('respiration_rate')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('blood_pressure')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('blood_oxygen')->sortable()->searchable(),
                
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
