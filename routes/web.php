<?php

use App\Http\Controllers\Frontend\AuthController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\RegisterController;
use Illuminate\Support\Facades\Route;




Route::group(['as' => 'frontend.'], function () {
    Route::get("/", [HomeController::class, 'index'])->name("home");

    Route::middleware('guest:patient')->group(function(){
        Route::get("/register/step-one",[RegisterController::class,'stepOne'])->name("register.stepOne");
        Route::post("/register/step-one",[RegisterController::class,'stepOneAction'])->name("register.stepOne.action");
    });

    Route::get("/register/step-two",[RegisterController::class,'stepTwo'])->name("register.stepTwo");
    Route::post("/register/step-two",[RegisterController::class,'stepTwoAction'])->name("register.stepTwo.action");



    // get modal info waiting 
    Route::post("/waiting",[HomeController::class,'waitingModal'])->name("waiting.modal");


    // تسجيل الدخول
    Route::middleware('is_login')->group(function(){
        Route::get("pateint/auth",[AuthController::class,'createPatient'])->name("auth.create.patient");
        Route::get("controller/auth",[AuthController::class,'createDashboard'])->name("auth.create.dashboard");
        
        Route::post("pateint/auth/action",[AuthController::class,'createPatientAction'])->name("auth.create.patient.action");
        Route::post("controller/auth/action",[AuthController::class,'createDashboardAction'])->name("auth.create.dashboard.action");
    });

    // تسجيل خروج الادمن او الموظف
    Route::post("logout/doctor/employee",[AuthController::class,'LogoutDoctorEmployee'])->name("auth.logout.doctor.employee");





});
