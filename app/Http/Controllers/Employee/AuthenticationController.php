<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    public function formLogin()
    {
        return view("employee.auth.login");
    }
   
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if (Auth::guard('employee')->attempt(['phone' => $request->email, 'password' => $request->password])) {
            return redirect()->intended(route('employee.dashboard'));
        }

        return back()->withErrors([
            'email' => 'يوجد خطأ فى البيانات',
        ])->onlyInput('');

    }

    public function logout()
    {

        Auth::guard('employee')->logout();
        return redirect()->route("employee.login");
    }
}
