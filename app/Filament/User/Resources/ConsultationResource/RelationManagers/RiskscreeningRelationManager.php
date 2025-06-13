<?php

namespace App\Filament\User\Resources\ConsultationResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class RiskscreeningRelationManager extends RelationManager
{
    protected static string $relationship = 'riskscreening';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Fieldset::make('Hypertension/Diabetes/Hypercholesterolemia Renal Diseases')
            ->schema([
   
                Tabs::make('Tabs')
                ->tabs([
                    Tabs\Tab::make('Blood Sugar')
                        ->schema([      
                            Fieldset::make('')
                            ->columnSpan(2)
                            ->label('Blood Sugar')
                    ->schema([  
                        TextInput::make('fbs_result'),
                        DatePicker::make('fbs_date'),
                        TextInput::make('rbs_result'),  
                        DatePicker::make('rbs_date'),
            
                        // ...    
                    ]),
                    Fieldset::make('')
                            ->label('Check if DM clinical symptoms are present:')
                    ->schema([ 
                    Checkbox::make('polyphagia')->label('Polyphagia'),
                        Checkbox::make('polydipsia')->label('Polydipsia'),
                        Checkbox::make('polyuria')->label('Polyuria'),
                    ]),
                    ]),
                    Tabs\Tab::make('Lipid Profile')
                        ->schema([
                            TextInput::make('total_cholesterol'),
                            DatePicker::make('total_cholesterol_date'),
                            TextInput::make('hdl'),
                            DatePicker::make('hdl_date'),
                            TextInput::make('ldl'),
                            DatePicker::make('ldl_date'),
                            TextInput::make('vldl'),
                            DatePicker::make('vldl_date'),
                            TextInput::make('triglyceride'),
                            DatePicker::make('triglyceride_date')

                        ]),
                    Tabs\Tab::make('Urinalysis/Urine Dipstick Test')
                        ->schema([
                            TextInput::make('protein'),
                            DatePicker::make('protein_date'),
                            TextInput::make('ketones'),
                            DatePicker::make('ketones_date')
                        ]),
                    ]),

              
            
            Tabs::make('Tabs')
                ->tabs([
                    Tabs\Tab::make('Chronic Respiratory Diseases( Asthma a d COPD)')
                        ->schema([      
                            Fieldset::make('')
                            ->label('')
                    ->schema([  
                        Checkbox::make('breathlessness')->label('Breathlessness'),
                        Checkbox::make('chronic_cough')->label('Chronic cough'),
                        Checkbox::make('sputum')->label('Sputum'),
                        Checkbox::make('chest_tightness')->label('Chest tightness'),
                        Checkbox::make('wheezing')->label('Wheezing'),
                      
                // ...    
                    ]),
                 
                ]),

                

            ]),

          ])->columns(2)
        
        ]);
        
          
    }

    public function table(Table $table): Table
    {
          $bloodSugarColumns = [
            Tables\Columns\TextColumn::make('fbs_result')->label('FBS Result'),
            Tables\Columns\TextColumn::make('fbs_date')->label('FBS Date'),
            Tables\Columns\TextColumn::make('rbs_result')->label('RBS Result'),
            Tables\Columns\TextColumn::make('rbs_date')->label('RBS Date'),
        ];

        $lipidProfileColumns = [
            Tables\Columns\TextColumn::make('total_cholesterol')->label('Total Cholesterol'),
            Tables\Columns\TextColumn::make('total_cholesterol_date')->label('Total Cholesterol Date'),
            Tables\Columns\TextColumn::make('hdl')->label('HDL'),
            Tables\Columns\TextColumn::make('hdl_date')->label('HDL Date'),
            Tables\Columns\TextColumn::make('ldl')->label('LDL'),
            Tables\Columns\TextColumn::make('ldl_date')->label('LDL Date'),
            Tables\Columns\TextColumn::make('vldl')->label('VLDL'),
            Tables\Columns\TextColumn::make('vldl_date')->label('VLDL Date'),
            Tables\Columns\TextColumn::make('triglyceride')->label('Triglyceride'),
            Tables\Columns\TextColumn::make('triglyceride_date')->label('Triglyceride Date'),
        ];

        $urinalysisColumns = [
            Tables\Columns\TextColumn::make('protein')->label('Protein'),
            Tables\Columns\TextColumn::make('protein_date')->label('Protein Date'),
            Tables\Columns\TextColumn::make('ketones')->label('Ketones'),
            Tables\Columns\TextColumn::make('ketones_date')->label('Ketones Date'),
        ];

        $chronicRespiratoryColumns = [
            Tables\Columns\TextColumn::make('breathlessness')->label('Breathlessness'),
            Tables\Columns\TextColumn::make('chronic_cough')->label('Chronic Cough'),
            Tables\Columns\TextColumn::make('sputum')->label('Sputum'),
            Tables\Columns\TextColumn::make('chest_tightness')->label('Chest Tightness'),
            Tables\Columns\TextColumn::make('wheezing')->label('Wheezing'),
        ];

        return $table
            ->recordTitleAttribute('fbs_result')
            ->columns(array_merge(
                [
                    Tables\Columns\TextColumn::make('Group: Blood Sugar'),
                ],
                $bloodSugarColumns,
                [
                    Tables\Columns\TextColumn::make('Group: Lipid Profile'),
                ],
                $lipidProfileColumns,
                [
                    Tables\Columns\TextColumn::make('Group: Urinalysis/Urine Dipstick Test'),
                ],
                $urinalysisColumns,
                [
                    Tables\Columns\TextColumn::make('Group: Chronic Respiratory Diseases'),
                ],
                $chronicRespiratoryColumns
            ))
        // return $table
        //     // ->recordTitleAttribute('fbs_result')
        //     // ->columns([
        //     //     Tables\Columns\TextColumn::make('fbs_result'),
        //     // ])
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
