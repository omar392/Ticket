<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Department::create([
            'name_ar' => 'تكنولوجيا المعلومات',
            'name_en' => 'Information Technology',
        ]);
        Department::create([
            'name_ar' => 'المالية',
            'name_en' => 'Financial',
        ]);

    }
}
