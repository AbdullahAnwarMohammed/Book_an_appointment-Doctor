<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    public function formLogin()
    {
        return view("doctor.auth.login");
    }
   
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('doctor')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->intended(route('doctor.dashboard'));
        }

        return back()->withErrors([
            'email' => 'لم يتم العثور على البريد',
        ])->onlyInput('');

    }

    public function logout()
    {

        Auth::guard('doctor')->logout();
        return redirect()->route("doctor.login");
    }
}