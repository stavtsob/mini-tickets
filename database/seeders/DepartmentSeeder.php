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
        Department::updateOrCreate(['code'=>'call_center','title'=>'CALL CENTER']);
        Department::updateOrCreate(['code'=>'social_services_department','title'=>'SOCIAL SERVICES']);
        Department::updateOrCreate(['code'=>'it_department','title'=>'IT']);
        Department::updateOrCreate(['code'=>'pr_communication_media','title'=>'PR|COMMUNICATION-MEDIA']);
    }
}
