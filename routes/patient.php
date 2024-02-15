<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;
use App\Models\Patient;

Route::get('/patient-route', function () {
    return 'This is a patient route!';
    
});
Route::get('/patients',[PatientController::class,'index'])->name('patients');
Route::get('/patients/{id}',[PatientController::class,'show'])
->name('show');
Route::post('/pateints',[PatientController::class,'store'])->name('store');
Route::put('/pateints/{id}/update',[PatientController::class,'update'])->name('update');
Route::put('/pateints/{id}/delete',[PatientController::class,'destroy'])->name('destroy');
