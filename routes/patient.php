<?php

use App\Http\Controllers\Frontend\AuthController;
use App\Http\Controllers\Patient\HomeController;
use Illuminate\Support\Facades\Route;


Route::middleware('Authenticate')->group(function(){
    Route::get("/",[HomeController::class,'index'])->name("home");
    Route::post("/logout",[AuthController::class,'PatientLogout'])->name("logout");
});

