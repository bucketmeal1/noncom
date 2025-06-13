<?php

namespace App\Filament\User\Resources\ConsultationResource\RelationManagers;

use App\Models\PastMedicalHistory;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class PastmedicalhistoriesRelationManager extends RelationManager
{
    protected static string $relationship = 'patient_medical_histories';
    protected static ?string $title = 'Past Medical History';

    public function form(Form $form): Form
    {
        return $form
            ->schema([

                Select::make('patient_medical_history')
                ->label('Family History')
                ->searchable()
                ->required()
                ->options(PastMedicalHistory::pluck('past_medical_history_desc', 'past_medical_history_desc')->toArray())
                ->multiple()
                ->live(),

                // Select::make('patient_medical_history')
                // ->label('Family History')
                // ->searchable()
                // ->required()
                // ->options(
                //     PastMedicalHistory::whereNotNull('past_medical_history_desc')
                //         ->pluck('past_medical_history_desc', 'past_medical_history_desc')
                //         ->toArray()
                // )
                // ->multiple()
                // ->live(),


            ]);
    }

    public function table(Table $table): Table
    {
        return $table
           
            ->columns([
                Tables\Columns\TextColumn::make('patient_medical_history'),
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
