<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Group;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Employee = Employee::create([
            'name' => 'Employee',
            'phone' => '01012881643',
            'password' => Hash::make('123456'),
            'show_password' => '123456'
        ]);

        $groups = ['حضور','انتظار','غياب'];
        foreach($groups as $group)
        {
            Group::create([
                'name' => $group
            ]);
        }
    }
}
