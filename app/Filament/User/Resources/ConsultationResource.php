<?php

namespace App\Filament\User\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Consultation;
use Filament\Resources\Resource;
use Illuminate\Support\HtmlString;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\DateTimePicker;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\User\Resources\ConsultationResource\Pages;
use App\Filament\User\Resources\ConsultationResource\RelationManagers;
use App\Filament\User\Resources\ConsultationResource\RelationManagers\DiagnosisRelationManager;
use App\Filament\User\Resources\ConsultationResource\RelationManagers\ManagementRelationManager;
use App\Filament\User\Resources\ConsultationResource\RelationManagers\VitalsignsRelationManager;
use App\Filament\User\Resources\ConsultationResource\RelationManagers\NcdRiskFactorRelationManager;
use App\Filament\User\Resources\ConsultationResource\RelationManagers\RiskscreeningRelationManager;
use App\Filament\User\Resources\ConsultationResource\RelationManagers\CervicalcancerRelationManager;
use App\Filament\User\Resources\ConsultationResource\RelationManagers\FamilyhistoriesRelationManager;
use App\Filament\User\Resources\ConsultationResource\RelationManagers\PastmedicalhistoriesRelationManager;


class ConsultationResource extends Resource
{
    protected static ?string $model = Consultation::class;
    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Select::make('nature_visit')
                ->label('Nature of Visit')
                ->options([
                    'NEW CONSULTATION' => 'NEW CONSULTATION',
                    'FOLLOW-UP VISIT' => 'FOLLOW-UP VISIT',
                    'NEW ADMISSION' => 'NEW ADMISSION'
                ]),
                Select::make('consultation_type')
                ->label('Type of Consultation')
                ->options([
                    'GENERAL' => 'GENERAL',
                ]),
                DateTimePicker::make('consultation_date'),
              

                TextInput::make('patient_height')
                ->numeric()
                ->live()
                ->inputMode('decimal')
                ->label('Weight in Kilogram')
                ->afterStateUpdated(function (Set $set,Get $get,$state) {
                    $bmi = 0;
                    $classification = 'unclassified';
                    $weight = $get('patient_weight');
                    $height = $get('patient_height');
                    
            
                    if ($weight && $height) {
                        $heightInMeters = $height / 100; // Convert height to meters
                        $bmi = $weight / ($heightInMeters * $heightInMeters); // Calculate BMI using the formula
                        $bmi = round($bmi, 2); // Round BMI value to 2 decimal places
                        $set('bmi', $bmi); // Store BMI value in the form data
                    }
            
                    // Construct the HTML string to represent the BMI
                    if ($bmi == 0) {
                        $html = 'Add weight and height to compute your BMI and wait until 24 hours for the result to show';
                    } else {

                        if ($bmi < 18.5) {
                            $classification = "Underweight";
                        } elseif ($bmi <= 24.0) {
                            $classification = "Normal";
                        } elseif ($bmi <= 28.0) {
                            $classification = "Slightly overweight";
                        } elseif ($bmi <= 35.0) {
                            $classification = "Overweight";
                        } else {
                            $classification = "Obese";
                        }
             
                         
                    }

                    $set('classification',$classification);
                    $set('bmi',$bmi);
                  
                }),

            
                TextInput::make('patient_weight')
                ->numeric()
                ->live()
                ->inputMode('decimal')
                ->label('Height in Centimetre')
                ->afterStateUpdated(function (Set $set,Get $get,$state) {
                        $bmi = 0;
                        $classification = 'unclassified';
                        $weight = $get('patient_weight');
                        $height = $get('patient_height');
                        
                
                        if ($weight && $height) {
                            $heightInMeters = $height / 100; // Convert height to meters
                            $bmi = $weight / ($heightInMeters * $heightInMeters); // Calculate BMI using the formula
                            $bmi = round($bmi, 2); // Round BMI value to 2 decimal places
                            $set('bmi', $bmi); // Store BMI value in the form data
                        }
                
                        // Construct the HTML string to represent the BMI
                        if ($bmi == 0) {
                            $html = 'Add weight and height to compute your BMI and wait until 24 hours for the result to show';
                        } else {

                            if ($bmi < 18.5) {
                                $classification = "Underweight";
                            } elseif ($bmi <= 24.0) {
                                $classification = "Normal";
                            } elseif ($bmi <= 28.0) {
                                $classification = "Slightly overweight";
                            } elseif ($bmi <= 35.0) {
                                $classification = "Overweight";
                            } else {
                                $classification = "Obese";
                            }
                
                             
                        }

                        $set('classification',$classification);
                        $set('bmi',$bmi);
                      
                    }),


                    TextInput::make('bmi')
                    ->numeric()
                    ->readOnly()
                    ->inputMode('decimal')
                    ->label('BMI'),


                    TextInput::make('classification')
                    ->readOnly()
                    ->inputMode('decimal')
                    ->label('Classification'),

            
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) {
                $parentId = request()->get('patient_id');
                return $query->where('patient_id', $parentId);
            })
            ->columns([
                TextColumn::make('nature_visit')
                ->label('Consultations'),
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
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            FamilyhistoriesRelationManager::class,
            PastmedicalhistoriesRelationManager::class,
            VitalsignsRelationManager::class,
            NcdRiskFactorRelationManager::class,
            RiskscreeningRelationManager::class,
            CervicalcancerRelationManager::class,
            ManagementRelationManager::class,            
            DiagnosisRelationManager::class
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListConsultations::route('/'),
            'create' => Pages\CreateConsultation::route('/create'),
            'edit' => Pages\EditConsultation::route('/{record}/edit'),
        ];
    }    
}
