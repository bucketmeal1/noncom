<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\NationalHealthFacilityRegistryResource\Pages;
use App\Filament\Admin\Resources\NationalHealthFacilityRegistryResource\RelationManagers;
use App\Models\NationalHealthFacilityRegistry;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Components\Card;
use App\Models\Reference\Barangay;
use App\Models\Reference\Municipality;
use App\Models\Reference\Province;
use App\Models\Reference\Region;
use Filament\Forms\Get;
use Filament\Forms\Set;


class NationalHealthFacilityRegistryResource extends Resource
{
    protected static ?string $model = NationalHealthFacilityRegistry::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Manage';
    

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Card::make()->schema([
               
                    Forms\Components\TextInput::make('health_facility_code'),//->readOnly(),
                    Forms\Components\TextInput::make('health_facility_code_short'),//->readOnly(),
                    Forms\Components\TextInput::make('facility_name'),
                
                    Forms\Components\Select::make('facility_major_type')
                    ->searchDebounce(500)
                    ->searchable()
                    ->options(NationalHealthFacilityRegistry::distinct('facility_major_type')->pluck('facility_major_type', 'facility_major_type')
                    ->toArray()),

                    Forms\Components\Select::make('health_facility_type')
                    ->searchDebounce(500)
                    ->searchable()
                    ->options(NationalHealthFacilityRegistry::distinct('health_facility_type')->pluck('health_facility_type', 'health_facility_type')
                    ->toArray()),

                    Forms\Components\Select::make('ownership_major_classification')
                    ->searchDebounce(500)
                    ->searchable()
                    ->options(NationalHealthFacilityRegistry::whereNotNull('ownership_major_classification')->distinct('ownership_major_classification')->pluck('ownership_major_classification', 'ownership_major_classification')
                    ->toArray()),

                    Forms\Components\Select::make('ownership_sub_classification_for_government_facilities')
                    ->searchDebounce(500)
                    ->searchable()
                    ->options(NationalHealthFacilityRegistry::whereNotNull('ownership_sub_classification_for_government_facilities')->distinct('ownership_sub_classification_for_government_facilities')->pluck('ownership_sub_classification_for_government_facilities', 'ownership_sub_classification_for_government_facilities')
                    ->toArray()),
          
                  
                    Forms\Components\Select::make('ownership_sub_classification_for_private_facilities')
                    ->searchDebounce(500)
                    ->searchable()
                    ->options(NationalHealthFacilityRegistry::whereNotNull('ownership_sub_classification_for_private_facilities')->distinct('ownership_sub_classification_for_private_facilities')->pluck('ownership_sub_classification_for_private_facilities', 'ownership_sub_classification_for_private_facilities')
                    ->toArray()),
          
                 
                    Forms\Components\TextInput::make('street_name_and_number'),
                    Forms\Components\TextInput::make('building_name_and_number'),


                    // Forms\Components\Placeholder::make('')
                    // ->label('')
                    //     ->live()
                    //      ->disableLabel()
                    //         ->content(function (Get $get, Set $set) {
                               
                    //             $set('region_name',null);
                    //             $set('province_name',null);
                    //             $set('municipality_name',null);
                    //             $set('barangay_name',null);

                    //             if($get('region_psgc')){
                    //                 $region = Region::where('region_code',$get('region_psgc'))->first();
                    //                 $set('region_name', $region->regname);
                    //                 $set('region_psgc', $region->regcode);
                    //             }

                    //             if($get('province_psgc')){
                    //                 $province = Province::where('province_code',$get('province_psgc'))->first();
                    //                 $set('province_name', $province->provname);
                    //                 $set('province_psgc', $province->regcode);
                    //             }

                    //             if($get('municipality_psgc')){
                    //                 $municipality = Municipality::where('city_municipality_code',$get('municipality_psgc'))->first();
                    //                 $set('municipality_name', $municipality->city_municipality_description);
                    //                 $set('municipality_psgc', $municipality->regcode);
                    //             }

                    //             if($get('barangay_psgc')){
                    //                 $barangay = Barangay::where('barangay_code',$get('barangay_psgc'))->first();
                    //                 $set('barangay_name', $barangay->barangay_description);
                    //                 $set('barangay_psgc', $barangay->barangay_code);
                    //             }
                                
                              
                    // }),


                    Forms\Components\Select::make('region_psgc')
                    ->label('Region name')
                    ->searchDebounce(500)
                    ->searchable()
                    ->options(Region::whereNotNull('regname')->distinct('regname')->pluck('regname', 'regcode')
                    ->toArray())
                    ->live(),
                
                    Forms\Components\Select::make('province_psgc')
                    ->label('Province name')
                    ->searchDebounce(500)
                    ->searchable()
                    ->options(fn ($get) => Province::where('regcode', $get('region_psgc'))->whereNotNull('provname')->distinct('provname')->pluck('provname', 'provcode')
                    ->toArray())
                    ->live(),

                    Forms\Components\Select::make('municipality_psgc')
                    ->label('Municipality name')
                    ->searchDebounce(500)
                    ->searchable()
                    ->options(fn ($get) => Municipality::where('provcode', $get('province_psgc'))->whereNotNull('cityname')->distinct('cityname')->pluck('cityname', 'citycode')
                    ->toArray())
                    ->live(),

                    Forms\Components\Select::make('barangay_psgc')
                    ->label('Barangay name')
                    ->searchDebounce(500)
                    ->searchable()
                    ->options(fn ($get) => Barangay::where('citycode', $get('municipality_psgc'))->whereNotNull('bgyname')->distinct('bgyname')->pluck('bgyname', 'bgycode')
                    ->toArray())
                    ->live(),
            

                    // Forms\Components\TextInput::make('region_name'),
                    // Forms\Components\TextInput::make('province_name'),
                    // Forms\Components\TextInput::make('municipality_name'),
                    // Forms\Components\TextInput::make('barangay_name'),

                    // Forms\Components\TextInput::make('region_psgc'),
                    // Forms\Components\TextInput::make('province_psgc'),
                    // Forms\Components\TextInput::make('municipality_psgc'),
                    // Forms\Components\TextInput::make('barangay_psgc'),


                    Forms\Components\TextInput::make('zip_code')
                    ->numeric(),
                    Forms\Components\TextInput::make('landline_number'),
                    Forms\Components\TextInput::make('landline_number2'),
                    Forms\Components\TextInput::make('fax_number'),
                    Forms\Components\TextInput::make('email_address'),
                    Forms\Components\TextInput::make('alternate_email_address'),
                    Forms\Components\TextInput::make('official_website'),
                    Forms\Components\TextInput::make('service_capability'),
                    Forms\Components\TextInput::make('bed_capacity')
                    ->numeric()
                    ->default(0),
                 

                    Forms\Components\Select::make('licensing_status')
                    ->searchDebounce(500)
                    ->searchable()
                    ->options(NationalHealthFacilityRegistry::whereNotNull('licensing_status')->distinct('licensing_status')->pluck('licensing_status', 'licensing_status')
                    ->toArray()),

                    Forms\Components\DatePicker::make('license_validity_date')->format('m/d/Y')

                ])
            ]);
    }

    public static function table(Table $table): Table
    {
       
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('health_facility_code')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('health_facility_code_short')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('facility_name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('facility_major_type')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('health_facility_type')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('ownership_major_classification')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('ownership_sub_classification_for_government_facilities')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('ownership_sub_classification_for_private_facilities')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('street_name_and_number')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('building_name_and_number')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('region_name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('region_psgc')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('province_name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('province_psgc')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('municipality_name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('municipality_psgc')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('barangay_name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('barangay_psgc')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('zip_code')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('landline_number')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('landline_number2')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('fax_number')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('email_address')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('alternate_email_address')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('official_website')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('service_capability')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('bed_capacity')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('licensing_status')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('license_validity_date')->searchable()->sortable(),


            ])
            ->filters([

              

                SelectFilter::make('health_facility_type')
                ->label('Health Facility Type')
                ->searchable()
                ->options(fn () => NationalHealthFacilityRegistry::pluck('health_facility_type', 'health_facility_type')),

                SelectFilter::make('ownership_major_classification')
                ->label('Ownership Major Classification')
                ->searchable()
                ->options(fn () => NationalHealthFacilityRegistry::pluck('ownership_major_classification', 'ownership_major_classification')),


                SelectFilter::make('ownership_major_classification')
                ->label('Ownership Major Classification')
                ->searchable()
                ->options(fn () => NationalHealthFacilityRegistry::pluck('ownership_major_classification', 'ownership_major_classification')),

                SelectFilter::make('licensing_status')
                ->label('Licensing Status')
                ->searchable()
                ->options(fn () => NationalHealthFacilityRegistry::whereNotNull('licensing_status')->distinct()->pluck('licensing_status', 'licensing_status')),


                SelectFilter::make('province_name')
                ->label('Province Name')
                ->searchable()
                ->options(fn () => NationalHealthFacilityRegistry::distinct()->pluck('province_name', 'province_name')),

                SelectFilter::make('municipality_name')
                ->label('Municipality Name')
                ->searchable()
                ->options(fn () => NationalHealthFacilityRegistry::distinct()->pluck('municipality_name', 'municipality_name')),

    
                SelectFilter::make('barangay_name')
                ->label('Barangay Name')
                ->searchable()
                ->options(fn () => NationalHealthFacilityRegistry::whereNotNull('barangay_name')->pluck('barangay_name', 'barangay_name')),

               
               
           

             ])
            ->actions([
                Tables\Actions\EditAction::make(),
               
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            
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
            'index' => Pages\ListNationalHealthFacilityRegistries::route('/'),
            'create' => Pages\CreateNationalHealthFacilityRegistry::route('/create'),
            'edit' => Pages\EditNationalHealthFacilityRegistry::route('/{record}/edit'),
        ];
    }    
}
