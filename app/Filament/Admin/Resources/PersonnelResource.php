<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\PersonnelResource\Pages;
use App\Filament\Admin\Resources\PersonnelResource\RelationManagers;
use App\Models\Personnel;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\Reference\Attendant;
use App\Models\Reference\Sex;
use App\Models\Reference\Hired;
use App\Models\Reference\EmploymentStatusPersonnel;
use App\Models\Reference\YesNo;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Fieldset;
use Filament\Support\RawJs;
use Filament\Tables\Actions\ActionGroup;
use Filament\Support\Enums\ActionSize;
use Filament\Notifications\Notification;


class PersonnelResource extends Resource
{
    protected static ?string $model = Personnel::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
               
                Card::make()->schema([

                    Fieldset::make('Demographics')
                    ->schema([

                        Forms\Components\Select::make('ref_attendant')
                        ->required()
                        ->label('Position')
                        ->searchable()
                        ->options(Attendant::orderBy('attendant_desc')->pluck('attendant_desc','attendant_code')->toArray())
                        ->live()
                        ->afterStateUpdated(function (Forms\Set $set) {
                            $set('personnel_license_no', null);
                            $set('personnel_ptr_no', null);
                            $set('s2Lic_number', null);
                        }), 

                        Forms\Components\TextInput::make('personnel_lname')
                        ->label('Last Name')
                        ->required()
                        ->maxLength(255),
    
                        Forms\Components\TextInput::make('personnel_fname')
                        ->label('First Name')
                        ->required()
                        ->maxLength(255),
    
                        Forms\Components\TextInput::make('personnel_mname')
                        ->label('Middle Name')
                        ->required()
                        ->maxLength(255),
    
    
                        Forms\Components\Select::make('sex_code')
                        ->label('Sex')
                        ->required()
                        ->options(Sex::pluck('sex_desc','sex_code')->toArray()),
    
                        Forms\Components\DatePicker::make('personnel_birthdate')
                        ->label('Birthdate')
                        ->required(),



                    ])->columns(3),

                    Fieldset::make('License')
                    ->schema([              
                 

                        Forms\Components\TextInput::make('personnel_license_no')
                        ->label('PRC License Number')
                        ->mask('9999999')
                        ->visible(fn($record, $get) => in_array($get('ref_attendant'), [2, 5, 13, 1]))
                        ->required(fn($get) => in_array($get('ref_attendant'), [2, 5, 13, 1]))
                        ->maxLength(7),
    
                        Forms\Components\TextInput::make('personnel_ptr_no')
                        ->label('PTR Number')
                        ->mask('999999999')
                        ->visible(fn($record, $get) => in_array($get('ref_attendant'), [2,1]))
                        ->required(fn($get) => in_array($get('ref_attendant'), [2,1]))
                        ->maxLength(9),

    
                        Forms\Components\TextInput::make('s2Lic_number')
                        ->label('S2 License Number')
                        ->mask('999999999-9999-99')
                        ->visible(fn($record, $get) => in_array($get('ref_attendant'), [2,1]))
                        ->required(fn($get) => in_array($get('ref_attendant'), [2,1]))
                        ->maxLength(17),
    
                        Forms\Components\TextInput::make('personnel_philhealth')
                        ->label('PHIC Number')
                        ->mask('99-999999999-9')
                        ->maxLength(14),
    
                        Forms\Components\TextInput::make('phic_accreditation_no')
                        ->label('PHIC Accreditation code')
                        ->mask('9999-9999999-9')
                        ->maxLength(14),
    
                        Forms\Components\TextInput::make('personnel_TIN')
                        ->label('TIN')
                        ->mask('999-999-999')
                        ->maxLength(11),

                    ])->columns(3),

                    Fieldset::make('Employement')
                    ->schema([             

                        Forms\Components\Select::make('hired_code')
                        ->required()
                        ->label('Hired By')
                        ->options(Hired::pluck('hired_desc','hired_code')->toArray()),
    
    
                        Forms\Components\Select::make('personnel_status_code')
                        ->required()
                        ->label('Employment Status')
                        ->options(EmploymentStatusPersonnel::pluck('personnel_status_desc','personnel_status_code')->toArray()),
    
                        Forms\Components\Select::make('personnel_active')
                        ->required()
                        ->label('Active in Service')
                        ->options(YesNo::pluck('yes_no_desc','yes_no_code')->toArray()),
    
                        Forms\Components\Select::make('current_user_login')
                        ->required()
                        ->label('Current User')
                        ->options(YesNo::pluck('yes_no_desc','yes_no_code')->toArray()),
    


                   ])->columns(4)

             ])->columns(1),
                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('position.attendant_desc')->label('POSITION')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('personnel_license_no')->label('PRC LICENSE NUMBER')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('personnel_lname')->label('LAST NAME')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('personnel_fname')->label('FIRST NAME')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('personnel_mname')->label('MIDDLE NAME')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('personnel_TIN')->label('TIN')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('yesno.yes_no_desc')->label('ACTIVE IN SERVICE')->searchable()->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make()->successNotification(
                        Notification::make()
                             ->success()
                             ->title('Personnel deleted')
                             ->body('The personnel has been deleted successfully.'),
                     )
                ])
                ->button()
                ->size(ActionSize::Small)
                ->label('Actions')
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
            'index' => Pages\ListPersonnels::route('/'),
            'create' => Pages\CreatePersonnel::route('/create'),
            'edit' => Pages\EditPersonnel::route('/{record}/edit'),
        ];
    }    
}
