<?php

namespace App\Livewire\Frontend;

use App\Models\Patient;
use GuzzleHttp\Psr7\Request;
use Livewire\Component;

class StepOneForm extends Component
{
    public $date_of_birth,$cid,$name,$phone,$gender,$height,$weight,$city,$marital_status;
    public $message = false,$cid_err=true;
    public function render()
    {
     
        if(strlen($this->cid) >= 7 && is_numeric($this->cid) && ($this->cid[0] == 2 || $this->cid[0] == 3))
        {
                $this->date_of_birth = $this->extractBirthDate($this->cid);
             if(!$this->date_of_birth)
             {
                $this->date_of_birth  = null;
                $this->cid_err=false;
             }else{
                $this->date_of_birth=$this->date_of_birth->format("Y-m-d");
                $this->cid_err=true;
             }
        }else{
            $this->date_of_birth  = null;
        }
        return view('livewire.frontend.step-one-form');
    }

    public function save()
    {
        $this->validate([
            'name' => 'required',
            'cid' => 'required|digits:' . generalSetting()['cid_number'] . '|unique:patients,cid',
            'phone' => 'required|digits:11|numeric|unique:patients,phone',
            'gender' => 'required',
            'height' => 'numeric|nullable',
            'weight' => 'numeric|nullable',
            'date_of_birth' => 'required'
        ], [
            'required' => 'هذا الحقل اجباري',
            'unique' => 'تم استخدام الرقم من قبل',
            'phone.digits' => 'استخدم رقم هاتف صحيح',
            'numeric' => 'يجب استخدم رقم',
            'cid.digits' => 'يجب استخدام '. generalSetting()['cid_number'] .' رقم'
        ]);

        Patient::create([
            'name' => $this->name,
            'gender' => $this->gender,
            'phone' => $this->phone,
            'cid' => $this->cid,
            'city' => $this->city,
            'height' => $this->height,
            'weight' => $this->weight,
            'marital_status' => $this->marital_status,
            'date_of_birth' => $this->date_of_birth
        ]);
        $this->reset_value();
        $this->message = true;
    }

    public function reset_value()
    {
         $this->name = '';
        $this->gender= '';
         $this->phone= '';
         $this->cid= '';
        $this->city= '';
       $this->height= '';
         $this->weight= '';
        $this->marital_status= '';
        $this->date_of_birth= '';

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
        
        if (!checkdate($month, $day, $year)) {
        return false;
        } 
        // تكوين التاريخ
        return \Carbon\Carbon::createFromDate($year, $month, $day);
    }


}
