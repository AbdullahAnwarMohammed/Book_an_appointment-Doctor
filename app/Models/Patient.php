<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Patient extends Authenticatable
{
    use HasFactory;
    protected $guarded = [];

    public function alhajzs()
    {
        return $this->hasMany(Alhajz::class)->orderBy('created_at', 'desc');;
    }
    public function LastRegister()
    {
        return Alhajz::where('patient_id',$this->id)->latest()->first();
    }

    public function getAge()
    {
        return Carbon::parse($this->date_of_birth)->age;

    }

    // حجز واحد
    public function alhajz($id,$date)
    {
      return Alhajz::where('patient_id',$id)
      ->whereDate('register_days',$date)
      ->first();
    }
}

