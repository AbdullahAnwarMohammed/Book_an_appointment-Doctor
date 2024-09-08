<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupPateint extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    // رقم الحجز
    public function numberPatient($idPatient,$date)
    {
        return Alhajz::where('patient_id', $idPatient)
        ->whereDate('register_days', $date)
        ->first(); // This returns null if no record is found
    }
}
