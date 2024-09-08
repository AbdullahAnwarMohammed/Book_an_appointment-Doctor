<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*    $table->string("start_work");
            $table->string("morning_or_night");
            $table->string("working_hours")->default(0);;
            $table->string("patient_minutes")->default(0);
            $table->string("break");
            $table->boolean("type_work")->default(1);
            $table->integer("number_of_patients")->default(0);
            */
        Setting::create([
            'start_work' => '10:00', 
            'morning_or_night' => 'Morning', 
            'working_hours' => '10', 
            'patient_minutes' => '15', 
            'break' => [0], 
            'type_work' => '1', 
            'number_of_patients' => '40', 
        ]);
    }
}
