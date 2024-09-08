<?php

use App\Models\Alhajz;
use App\Models\Image;
use App\Models\Setting;
use Carbon\Carbon;

if (!function_exists('generalSetting')) {
    function generalSetting()
    {
        return Setting::first();
    }
}

if (!function_exists('patients_register_today')) {
    function patients_register_today($status)
    {

        return  Alhajz::whereDate('register_days', Carbon::today())
            ->where('status', $status)
            ->latest()
            ->first();
    }
}



if (!function_exists('count_registers_today')) {
    function count_registers_today()
    {

        return  Alhajz::whereDate('register_days', Carbon::today())
            ->where('status','!=',1 )
            ->count();
    }
}

if (!function_exists('waiting_items')) {
    function waiting_items()
    {
        return  Alhajz::whereDate('register_days', Carbon::today())
            ->where('status', 3)
            ->get();
    }
}

if (!function_exists('reservations_numbers')) {
    function reservations_numbers($date)
    {
        return  Alhajz::whereDate('register_days', $date)
            ->pluck('number')->toArray();
    }
}

if (!function_exists('Images')) {
    function Images() {
        return Image::first();
    }
}
