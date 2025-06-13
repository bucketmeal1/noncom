<?php

namespace App\Filament\User\Resources\ConsultationResource\RelationManagers;

use App\Models\Diagnosis;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class DiagnosisRelationManager extends RelationManager
{
    protected static string $relationship = 'diagnosis';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DatePicker::make('consultation_date'),
                    Select::make('diagnosis')
                    ->label('Diagnosis')
                    ->options([
                        'Hypertension' => 'Hypertension',
                        'Stroke' => 'Stroke',
                        'Heart Attack' => 'Heart Attack',
                        'Diabetes Mellitus Type 1' => 'Dieabetes Mellitus Type 1',
                        'Diabetes Mellitus Type 2' => 'Dieabetes Mellitus Type 2',
                        'Asthma' => 'Asthma',
                        'Cancer' => 'Cancer',
                        'Kidney' => 'Kidney',
                        'Suspicious Breast Mass' => 'Suspicious Breast Mass',
                    ]),
                    Select::make('status')
                    ->options([
                        'outgoing' =>'outgoing',
                        'discontinued' => 'discontinued',
                        'intermitent' => 'intermitent',
                    ]),

                

                    Select::make('outcome')
                    ->options([
                       'controlled'   => 'controlled',
                       'uncontrolled'  => 'uncontrolled',
                       'died' => 'died',
                    ]),
                
                
            ]);
            
      
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('diagnosis')
            ->columns([
                Tables\Columns\TextColumn::make('diagnosis'),
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
