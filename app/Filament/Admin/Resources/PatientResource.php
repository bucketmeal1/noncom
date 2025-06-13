<?php

namespace App\Filament\Admin\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Region;
use App\Models\Patient;
use Filament\Forms\Get;
use Filament\Forms\Set;
use App\Models\Barangay;
use App\Models\Province;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Consultation;
use App\Models\Municipality;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\HtmlString;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\ActionGroup;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use App\Filament\User\Resources\PatientResource\Pages;
use Illuminate\Support\Collection;
use App\Filament\Admin\Resources\PatientResource\RelationManagers;

class PatientResource extends Resource
{

    
    protected static ?string $model = Patient::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('lastname')->required(),
                TextInput::make('firstname')->required(),
                TextInput::make('middlename')->required(),
                DatePicker::make ('birthdate')->required(),
                Select::make('civil_status')
                ->label('Civil Status')
                ->options([
                    'Single' => 'Single',
                    'Married' => 'Married',
                    'Widowed'=> 'Widowed',
                ]),
                TextInput::make('contact')
                ->label('Contact Number'),
                TextInput::make('pwd_id')
                ->label('Person With Disability ID'),
                Select::make('gender')
                ->label('Sex')
                ->options([
                    'Male' => 'Male',
                    'Female' => 'Female',
                ])->required(),
               
            
               
            
                // Placeholder::make('')
                // ->label('')
                // ->live()
                // ->hiddenLabel()
                // ->content(function (Get $get,Set $set){
                //     $weight = $get('weight');
                //     $height = $get('height');
                //     $bmi = $weight * $height; // computation bahala ka sa buhay mo.
                //     $set('bmi',$bmi);
                // }),
                Hidden::make('bmi')
                ->label('BMI '),
                Select::make('regcode')
                ->label('Region')
                ->options(Region::query()->pluck('regname', 'regcode'))
                ->searchable()
                ->live()
                ->required(),
                Select::make('provcode')
                ->label('Province')
                ->options(fn (Get $get): Collection => Province::query()
                ->where('regcode', $get('regcode')) 
                ->pluck('provname', 'provcode'))
                ->searchable()
                ->preload()
                ->live()->required(),
              
            Select::make('citycode')
                ->label('Municipality')
                ->options(fn (Get $get): Collection => Municipality::query()
                ->where('provcode', $get('provcode'))
                ->pluck('cityname', 'citycode'))
                ->searchable()
                ->live()->required(),
            Select::make('bgycode')
                ->label('Barangay')
                ->options(fn (Get $get): Collection => Barangay::query()
                ->where('citycode', $get('citycode'))
                ->pluck('bgyname', 'bgycode'))
                ->searchable()
                ->live()->required(),
            TextInput::make('house_number')       
            ]);
            
    }

    public static function table(Table $table): Table
    {
        return $table
            
                ->columns([
                    // TextColumn::make('full_name')
                    // ->label('Full Name')
                    // ->getStateUsing(function ($record) {
                    //     return strtoupper($record->full_name); // Using the accessor
                    // })
                    // ->searchable([
                    //     'lastname',
                    //     'firstname',
                    //     'middlename',
                    // ])
                    // ->sortable(),

                        
                        TextColumn::make('birthdate')->label('Date of Birth')->dateTime('m/d/Y')->searchable()->sortable(),
                        TextColumn::make('civil_status')->label('Civil Status'),
                        // TextColumn::make('contact')->label('Contact Number'),
                        // TextColumn::make('pwd')->label('Persons With Disability'),
                        // TextColumn::make('pwd_id')->label('Enter PWD ID'),
                        // TextColumn::make('gender')->label('Sex')->searchable()->sortable(),
        
                        TextColumn::make('regions.regname')->label('Region')->searchable()->sortable(),
                        TextColumn::make('provinces.provname')->label('Province')->searchable()->sortable(),
                        TextColumn::make('municipalities.cityname')->label('Municipality')->searchable()->sortable(),
                        TextColumn::make('barangay.bgyname')->label('Barangay')->searchable()->sortable(),
                        // TextColumn::make('regcode')->label('Region')->searchable()->sortable(),
                        // TextColumn::make('provcode')->label('Province')->searchable()->sortable(),
                        // TextColumn::make('citycode')->label('Municipality')->searchable()->sortable(),
                        // TextColumn::make('bgycode')->label('Barangay')->searchable()->sortable(),
                        // TextColumn::make('house_number')->label('House #')->searchable()->sortable(),
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
            //
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPatients::route('/'),
            'create' => Pages\CreatePatient::route('/create'),
            'edit' => Pages\EditPatient::route('/{record}/edit'),
        ];
    }    
}
