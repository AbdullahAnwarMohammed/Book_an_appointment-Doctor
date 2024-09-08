<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Employee;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Termwind\Components\Raw;

class AuthController extends Controller
{
    public function createPatient(Request $request)
    {
        return view("frontend.auth.login_patient");
    }
    public function createPatientAction(Request $request)
    {

        $request->validate([
            'phone' => 'required',
            'cid' => 'required',
        ]);

        // Attempt to find the patient by phone and CID
        $patient = Patient::where('phone', $request->phone)
            ->where('cid', $request->cid)
            ->first();

        if ($patient) {
            Auth::guard('patient')->login($patient);
            return redirect()->route('frontend.home')->with('Success', 'تم تسجيل الدخول بنجاح');
        } else {
            return back()->withErrors(['phone' => 'يوجد خطأ فى البيانات']);
        }
    }


    public function createDashboard()
    {
        return view("frontend.auth.login_dashboard");
    }

    public function createDashboardAction(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required',
        ]);

        // Attempt to find the patient by phone and CID
        $Employee = Employee::where('phone', $request->name)
            ->first();
        if ($Employee && Hash::check($request->password, $Employee->password)) {
            // Manually log in the patient
            Auth::guard('employee')->login($Employee);
            return redirect()->route("employee.dashboard");
        }




        // Attempt to find the patient by phone and CID
        $doctor = Doctor::where('email', $request->name)
            ->first();
        if ($doctor && Hash::check($request->password, $doctor->password)) {
            // Manually log in the patient
            Auth::guard('doctor')->login($doctor);
            return redirect()->route("doctor.dashboard");
        }

        return back()->withErrors(['phone' => 'يوجد خطأ فى البيانات']);
    }


    public function LogoutDoctorEmployee(Request $request)
    {
        if (Auth::guard('doctor')->check()) {
            Auth::guard('doctor')->logout();
        }

        if (Auth::guard('employee')->check()) {
            Auth::guard('employee')->logout();
        }

        // Invalidate the session and regenerate the CSRF token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('frontend.home')->with('Success', 'تم تسجيل الخروج بنجاح');;
    }
    public function PatientLogout(Request $request)
    {


        Auth::guard('patient')->logout();

        // Invalidate the session and regenerate the CSRF token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('frontend.home')->with('Success', 'تم تسجيل الخروج بنجاح');;
    }
}
