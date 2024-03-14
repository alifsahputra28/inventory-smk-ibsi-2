<?php

namespace Database\Seeders;

use App\Models\LaboratoryRoom;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class LaboratorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       LaboratoryRoom::create([
        'laboratory_number'     => 'LAB-001',
        'name'                  => 'Laboratory RPL',
        'pic'                  => 'Alif1',
       ]);
       LaboratoryRoom::create([
        'laboratory_number'     => 'LAB-002',
        'name'                  => 'Laboratory Akuntansi',
        'pic'                  => 'Alif2',
       ]);
       LaboratoryRoom::create([
        'laboratory_number'     => 'LAB-003',
        'name'                  => 'Laboratory Administrasi Perkantoran',
        'pic'                  => 'Alif3',
       ]);
       LaboratoryRoom::create([
        'laboratory_number'     => 'LAB-004',
        'name'                  => 'Laboratory Pemasaran',
        'pic'                  => 'Alif4',
       ]);


       $permissions = [
        'Lab RPL',
        'Lab Akuntansi',
        'Lab Administrasi Perkantoran',
        'Lab Pemasaran',
     ];
     
     foreach ($permissions as $permission) {
          Permission::create(['name' => $permission]);
     }
    }
}
