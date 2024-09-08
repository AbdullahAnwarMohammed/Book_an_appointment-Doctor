<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileDoctorController extends Controller
{
    public function index()
    {
        return view("doctor.profile.index");
    }

    public function update(Request $request)
    {
        if($request->password)
        {
            $data['password'] = Hash::make($request->password);
            $data['show_password'] = $request->password;
            
        }
        $data['name'] = $request->name;
        $data['email'] = $request->email;


        Doctor::where('id',auth()->guard('doctor')->user()->id)
        ->update($data);

        return redirect()->back()->with('Success','تم تعديل البيانات بنجاح');
        
    }
}
