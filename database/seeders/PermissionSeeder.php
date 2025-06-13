<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;
use App\Models\FundSource;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Permission::create(['name' => 'User View']);
        Permission::create(['name' => 'User Create']);
        Permission::create(['name' => 'User Update']);
        Permission::create(['name' => 'User Delete']);

        Permission::create(['name' => 'Role View']);
        Permission::create(['name' => 'Role Create']);
        Permission::create(['name' => 'Role Update']);
        Permission::create(['name' => 'Role Delete']);

        Permission::create(['name' => 'Permission View']);
        Permission::create(['name' => 'Permission Create']);
        Permission::create(['name' => 'Permission Update']);
        Permission::create(['name' => 'Permission Delete']);

        Permission::create(['name' => 'NHFR View']);
        Permission::create(['name' => 'NHFR Create']);
        Permission::create(['name' => 'NHFR Update']);
        Permission::create(['name' => 'NHFR Delete']);

        Permission::create(['name' => 'Personnel View']);
        Permission::create(['name' => 'Personnel Create']);
        Permission::create(['name' => 'Personnel Update']);
        Permission::create(['name' => 'Personnel Delete']);

       
    
    }
}
