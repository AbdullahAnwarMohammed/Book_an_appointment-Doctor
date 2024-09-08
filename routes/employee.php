<?php

use App\Http\Controllers\Employee\AuthenticationController;
use App\Http\Controllers\Employee\DashboardController;
use App\Http\Controllers\Employee\RegisterTodayController;
use Illuminate\Support\Facades\Route;


Route::middleware('is_login')->group(function(){
    Route::get("/login",[AuthenticationController::class,'formLogin'])->name('login');
    Route::post("/login",[AuthenticationController::class,'login'])->name('login');
});

Route::middleware('Authenticate')->group(function(){
    Route::get("/",[DashboardController::class,'index'])->name('dashboard');

    Route::get("/customers",[DashboardController::class,'customers'])->name('dashboard.customers');
    Route::post("/customer/modal",[DashboardController::class,'customerModal'])->name('dashboard.customer.modal');
    // حجوزات اليوم
    Route::view("/register-today","employee.register.today")->name('register.today');
    Route::view("/register-all","employee.register.all")->name('register.all');
});


