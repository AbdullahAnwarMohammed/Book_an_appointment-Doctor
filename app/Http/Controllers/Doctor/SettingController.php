<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $Setting = Setting::first();
        if (!$Setting) {
            $Setting = [];
        }
        return view("doctor.settings.index", compact('Setting'));
    }

    public function save(Request $request)
    {

        $validated = $request->validate([
            'start_work' => 'required|date_format:H:i',
            'morning_or_night' => 'required',
            'working_hours' => 'required|numeric',
            'patient_minutes' => 'required|numeric|lt:60',
            'end_register'  => 'nullable|after:start_register'
        ]);




        Setting::updateOrCreate(
            [
                'id' => 1
            ],
            [
                'start_work' => $request->start_work,
                'morning_or_night' => $request->morning_or_night,
                'working_hours' => $request->working_hours,
                'patient_minutes' => $request->patient_minutes,
                'break' => $request->break,
                'type_work' => $request->type_work,
                'number_of_patients' => $request->number_of_patients,
                'cid_number' => $request->number_cid,
                'reset_register' => $request->reset_register,
                'start_register' => $request->start_register,
                'end_register' => $request->end_register,
                'default_money' => $request->default_money,
            ]
        );

        return redirect()->back()->with('Success', 'تم تعديل البيانات بنجاح');
    }
}
