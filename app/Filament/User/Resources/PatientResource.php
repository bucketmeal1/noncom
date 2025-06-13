<?php

namespace App\Filament\User\Resources;
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
use Closure;





class PatientResource extends Resource
{
    protected static ?string $model = Patient::class;
    protected static ?int $navigationSort = 1;

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

    public static function getTableQuery(): Builder
    {

        $national_health_facility_registries_id = auth()->user()->national_health_facility_registries_id;

        return Patient::query()->select('patients.*', 'users.national_health_facility_registries_id')->join('users', 'patients.user_id', '=', 'users.id')
                  ->where('users.national_health_facility_registries_id', $national_health_facility_registries_id);
         
    }

    public static function table(Table $table): Table
    {
       
        return $table
        ->query(self::getTableQuery())
        // ->modifyQueryUsing(function (Builder $query) {
        //     $query->join('users', 'patients.user_id', '=', 'users.id')
        //           ->where('users.national_health_facility_registries_id', auth()->user()->national_health_facility_registries_id);
        //         })
        ->columns([
            TextColumn::make('full_name')
            ->label('Full Name')
            ->getStateUsing(function ($record) {
                return strtoupper($record->full_name); // Using the accessor
            })
            ->searchable([
                'lastname',
                'firstname',
                'middlename',
            ])
            ->sortable(),
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

            ->recordUrl(
                fn (Patient $record): string => route('filament.user.resources.patients.edit', ['record' => $record->id]),
                shouldOpenInNewTab: true
            )

            ->filters([
               
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    //Tables\Actions\ViewAction::make(),
                    Tables\Actions\Action::make('Request')
                    ->label('Create Consultation')                    
                     //->hidden(fn ($record) => $record->status !== 0)
                     ->icon('heroicon-o-pencil-square')
                     ->form([
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
                        ->label('height in Centimeter')
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
        
        
                            TextInput::make('bmi')
                            ->numeric()
                            ->readOnly()
                            ->inputMode('decimal')
                            ->label('BMI'),
        
        
                            TextInput::make('classification')
                            ->readOnly()
                            ->inputMode('decimal')
                            ->label('Classification'),
                     ])
                     ->action(function (array $data, Patient $record) {
                    


                        Consultation::Create(
                           
                            [
                                'patient_id' => $record->id,
                                'nature_visit' => $data['nature_visit'],
                                'consultation_type' => $data['consultation_type'],
                                'consultation_date' => $data['consultation_date'],
                                'patient_height' => $data['patient_height'],
                                'patient_weight' => $data['patient_weight'],
                                'bmi' =>$data['bmi'],
                                'classification' =>$data['classification']
                            ]
                        );

                        // $consultation = Consultation::where('patient_id', $record->id)->first();

                      

                        // if ($consultation) {
                        //     $consultation->nature_visit = $data['nature_visit'];
                        //     $consultation->consultation_type = $data['consultation_type'];
                        //     $consultation->consultation_date = $data['consultation_date'];
                        //     $consultation->patient_height = $data['patient_height'];
                        //     $consultation->patient_weight = $data['patient_weight'];
                        //     $consultation->save();
                        // }else{

                        //     $consultation = New Consultation;
                        //     $consultation->patient_id = $record->id;
                        //     $consultation->nature_visit = $data['nature_visit'];
                        //     $consultation->consultation_type = $data['consultation_type'];
                        //     $consultation->consultation_date = $data['consultation_date'];
                        //     $consultation->patient_height = $data['patient_height'];
                        //     $consultation->patient_weight = $data['patient_weight'];
                        //     $consultation->save();
                        // }


                        
                    }),
                 
                    Tables\Actions\Action::make('view')
                    ->label('View Consultation List')
                    ->icon('heroicon-o-eye')
                    ->url(fn (Patient $record) => route('filament.user.resources.consultations.index', ['patient_id' => $record->id])),
                
                        
                ]) 
           
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
