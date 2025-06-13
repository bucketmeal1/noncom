<?php

namespace App\Filament\User\Resources\ConsultationResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\FamilyHistory;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class FamilyhistoriesRelationManager extends RelationManager
{
    protected static string $relationship = 'patient_family_histories';
    protected static ?string $title = 'Family History';
        

    public function form(Form $form): Form
    {
        return $form
            ->schema([

                Select::make('patient_history')
                ->label('Family History')
                ->searchable()
                ->required()
                ->options(FamilyHistory::pluck('past_medical_history_desc', 'past_medical_history_desc')->toArray())
                ->multiple()
                ->live(),

            
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('consultation_id')
            ->columns([
                Tables\Columns\TextColumn::make('patient_history')
                ->label('Past Medical History')
                ->sortable()
                ->searchable(),
             
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
