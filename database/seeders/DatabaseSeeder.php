<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\Models\User;
use DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        $user = User::factory()->create([
            'name' => 'Admin',
           // 'unit_id' => 1,
            'email' => 'admin@example.com',
        
        ]);

        User::factory()->create([
            'name' => 'User',
            'email' => 'user@example.com',
        ]);

        $role = Role::create(['name' => 'Admin']);
        $user->assignRole($role);
        //$permission = Permission::create(['name' => 'edit']);

        // if(!DB::table('philippine_barangays')->count()) {
        //     DB::unprepared(file_get_contents(__DIR__ . '/sql/philippine_barangays.sql'));
        // }
        // if(!DB::table('philippine_cities')->count()) {
        //     DB::unprepared(file_get_contents(__DIR__ . '/sql/philippine_cities.sql'));
        // }
        // if(!DB::table('philippine_provinces')->count()) {
        //     DB::unprepared(file_get_contents(__DIR__ . '/sql/philippine_provinces.sql'));
        // }
        // if(!DB::table('philippine_regions')->count()) {
        //     DB::unprepared(file_get_contents(__DIR__ . '/sql/philippine_regions.sql'));
        // }

       
        $this->call(PermissionSeeder::class);
        $this->call(PrefixSeeder::class);
        $this->call(SuffixSeeder::class);
        $this->call(SexSeeder::class);
        $this->call(CivilStatusSeeder::class);
        $this->call(EducationalAttainmentSeeder::class);
        $this->call(EducationalStatusSeeder::class);
        $this->call(ReligionSeeder::class);
        $this->call(YesNoSeeder::class);
        $this->call(BloodTypeSeeder::class);
        $this->call(CountrySeeder::class);
        $this->call(RegionsSeeder::class);
        $this->call(ProvinceSeeder::class);
        $this->call(MunicipalitySeeder::class);
        $this->call(BarangaysSeeder::class);
        $this->call(FamilyMembersSeeder::class);
        $this->call(AttendantSeeder::class);
        $this->call(HiredSeeder::class);
        $this->call(EmployementStatusPersonelSeeder::class);
        $this->call(BMISeeder::class);
        $this->call(PastMedicalHistorySeeder::class);
        $this->call(FamilyHistorySeeder::class);
        $this->call(FacilitySeeder::class);

 
     

        // if(!DB::table('prefixes')->count()) {
        //     DB::unprepared(file_get_contents(__DIR__ . '/ref/prefixes.csv'));
        // }


      
        
    }
}
