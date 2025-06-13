<?php

namespace App\Filament\User\Resources\ConsultationResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class CervicalcancerRelationManager extends RelationManager
{
    protected static string $relationship = 'cervicalcancer';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('risk_assessment')
                ->options([
                    'at risk' => 'at risk',
                    'not at risk' => 'Not at risk',      
                ]),
                Select::make('given_counseling')
                ->options([
                    'yes' => 'yes',
                    'no' => 'no',      
                ]),
                Select::make('type_screening')
                ->options([
                    'V-VIA' => 'V-VIA',
                    'P-Pap Smear' => 'P-Pap Smear',
                    'H-HPV' =>'H-HPV'     
                ]),
                
                Select::make('result')
                ->options([
                    'VN-VIA Negative' => 'VN-VIA Negative',
                    'VNE-VIA Negative Electropion' => 'VNE-VIA Negative Electropion',
                    'PN-Pap Smear Normal' => 'PN-Pap Smear Normal',
                    'HPV-Negative' => 'HPV-Negative',
                    'VP-VIA Positive' =>  'VP-VIA Positive',
                    'PA-Pap Smear Abnormal' => 'PA-Pap Smear Abnormal',
                    'HPV + what type' => 'HPV + what type',
                    'VS-VIA Suspicious Cancer' => 'VS-VIA Suspicious Cancer',
                    'PS-Pap Smear Suspicious Cancer' => 'PS-Pap Smear Suspicious Cancer',
                    'HPV Suspicious or Malignant' => 'HPV Suspicious or Malignant',
                ]), 
                
                Select::make('treatment_management')
                ->options([
                    'Referral' => 'Referral',
                    'Cryotherapy'=> 'Cryotherapy',
                    'Thermal Abiation' =>'Thermal Abiation',
                    'Excisional Treatment/surgery' => 'Excisional Treatment/surgery',
                    'colposcopy' => 'colposcopy',
                    'chemoradiation' => 'chemoradiation',
                    'surgery' => 'surgery',
                    'palliative care' => 'palliative care',
                ]),

                DatePicker::make('return_schedule'),
                TextInput::make('remarks')->label('Clinical Breast Examination')


                   
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('risk_assessment')
            ->columns([
                Tables\Columns\TextColumn::make('risk_assessment'),
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
