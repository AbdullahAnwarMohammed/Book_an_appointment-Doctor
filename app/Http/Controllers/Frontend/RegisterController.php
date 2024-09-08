<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function stepOne()
    {
        return view('frontend.register.register-step-one');
    }


    public function extractBirthDate($nationalId) {
        // استخراج القرن
        $centuryDigit = substr($nationalId, 0, 1);
        
        // تحديد القرن بناءً على الرقم الأول
        if ($centuryDigit == '2') {
            $century = 1900;
        } elseif ($centuryDigit == '3') {
            $century = 2000;
        } else {
            return null; // رقم غير صحيح
        }
        
        // استخراج السنة والشهر واليوم
        $year = $century + intval(substr($nationalId, 1, 2));
        $month = intval(substr($nationalId, 3, 2));
        $day = intval(substr($nationalId, 5, 2));
        
        // تكوين التاريخ
        return \Carbon\Carbon::createFromDate($year, $month, $day);
    }

    public function stepOneAction(Request $request)
    {

      

       
        Patient::create([
            'name' => $request->name,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'cid' => $request->cid,
            'city' => $request->city,
            'height' => $request->height,
            'weight' => $request->weight,
            'marital_status' => $request->marital_status,
            'date_of_birth' => $request->date_of_birth
        ]);

        return redirect()->back()->with('Success', 'تم فتح ملف بنجاح');
    }


    public function stepTwo()
    {
        return view('frontend.register.register-step-two');
    }
}
