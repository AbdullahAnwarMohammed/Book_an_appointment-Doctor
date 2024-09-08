<?php

use App\Http\Controllers\Doctor\AuthenticationController;
use App\Http\Controllers\Doctor\DashboardController;
use App\Http\Controllers\Doctor\EmployeeController;
use App\Http\Controllers\Doctor\ExportController;
use App\Http\Controllers\Doctor\NewsController;
use App\Http\Controllers\Doctor\ProfileDoctorController;
use App\Http\Controllers\Doctor\ReasonController;
use App\Http\Controllers\Doctor\SettingController;
use App\Http\Controllers\Doctor\UploadImageController;
use Illuminate\Support\Facades\Route;


Route::middleware('is_login')->group(function(){
    Route::get("/login",[AuthenticationController::class,'formLogin'])->name('login');
    Route::post("/login",[AuthenticationController::class,'login'])->name('login');
});

Route::middleware('Authenticate')->group(function(){
    Route::get("/",[DashboardController::class,'index'])->name('dashboard');

    Route::get("/settings",[SettingController::class,'index'])->name('settings');
    Route::post("/settings/save",[SettingController::class,'save'])->name('settings.save');

    // اسباب الحجوزات
    Route::post('reasons/update-order',[ReasonController::class,'updateOrder'])->name('reasons.updateOrder');
    Route::resource("/reasons",ReasonController::class);

    // شريط الاخبار
    Route::post('news/update-order',[NewsController::class,'updateOrder'])->name('news.updateOrder');
    Route::resource("/news",NewsController::class);

    // الموظفون
    Route::resource('employees',EmployeeController::class);

    // رفع الصور
    Route::get("/upload/images",[UploadImageController::class,'index'])->name('upload.image');
    Route::post("/upload/image",[UploadImageController::class,'upload'])->name('upload.image.post');
    Route::get("image/delete/{name}",[UploadImageController::class,'destory'])->name("image.destory");

    // البيانات الاساسية
    Route::get('profile',[ProfileDoctorController::class,'index'])->name('profile');
    Route::post('profile',[ProfileDoctorController::class,'update'])->name('profile');

    //قاعدة البيانات
    Route::get("export",[ExportController::class,'database'])->name('export');
    Route::get("export/all",[ExportController::class,'AllDatabase'])->name('export.all');
    Route::post("import",[ExportController::class,'storeDatabase'])->name('import');
});
